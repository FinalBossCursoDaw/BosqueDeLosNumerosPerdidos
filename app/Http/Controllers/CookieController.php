<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partida;
use App\Models\Sesion;
use App\Models\Juego;
use App\Models\Fecha;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CookieController extends Controller
{
    /**
     * Guardar partida desde cookies a la base de datos
     */
    public function savePartida(Request $request)
    {
        \Log::info('Datos recibidos (raw)', ['all' => $request->all(), 'json' => $request->json()->all()]);
        
        $validated = $request->validate([
            'juego' => 'required|string|in:sumas,puente-logica',
            'puntuacion' => 'nullable|integer',
            'tiempo_seg' => 'nullable|integer',
            'vidas' => 'nullable|integer',
            'racha' => 'nullable|integer',
            'errores' => 'nullable|integer',
            'operaciones_resueltas' => 'nullable|integer',
            'helps_clicks' => 'nullable|integer',
            'completado' => 'nullable|boolean',
            'auto_save' => 'nullable|boolean'
        ]);

        try {
            DB::beginTransaction();
            
            \Log::info('Guardando partida', ['data' => $validated, 'user_id' => Auth::id()]);

            // Obtener o crear juego
            $nombreJuego = $validated['juego'] === 'sumas' ? 'El Bosque de las Sumas' : 'Puente de la Lógica';
            $juego = Juego::firstOrCreate(
                ['nombre' => $nombreJuego],
                ['descripcion' => 'Juego de ' . $nombreJuego]
            );

            // Crear o verificar fecha
            $fechaHoy = date('Y-m-d');
            Fecha::firstOrCreate(['fecha' => $fechaHoy]);

            // Crear sesión con datos del juego
            $sesion = Sesion::create([
                'level_reached' => 1,
                'n_attemps' => 1,
                'errors' => $validated['errores'] ?? 0,
                'helps_clicks' => $validated['helps_clicks'] ?? 0,
                'date_time' => now()
            ]);

            // Crear partida
            $partida = Partida::create([
                'id_usuario' => Auth::id(),
                'id_juego' => $juego->id_juego,
                'fecha' => $fechaHoy,
                'id_sesion' => $sesion->id_sesion,
                'puntuacion' => $validated['puntuacion'] ?? 0,
                'tiempo_seg' => $validated['tiempo_seg'] ?? 0
            ]);

            DB::commit();
            
            \Log::info('Partida guardada exitosamente', ['partida_id' => $partida->id_partida]);

            // Crear cookies desde Laravel
            $response = response()->json([
                'success' => true,
                'message' => 'Partida guardada correctamente',
                'data' => $partida
            ], 201);

            // Guardar cookies según el tipo de juego
            if ($validated['juego'] === 'sumas') {
                // Guardar datos actuales de la partida
                $response->cookie('sumas_last_score', $validated['puntuacion'], 525600, '/', null, false, false); // 1 año
                $response->cookie('sumas_last_time', $validated['tiempo_seg'], 525600, '/', null, false, false);
                $response->cookie('sumas_last_lives', $validated['vidas'] ?? 0, 525600, '/', null, false, false);
                $response->cookie('sumas_last_streak', $validated['racha'] ?? 0, 525600, '/', null, false, false);
                $response->cookie('sumas_last_operations', $validated['operaciones_resueltas'] ?? 0, 525600, '/', null, false, false);
                $response->cookie('sumas_last_completed', $validated['completado'] ?? false, 525600, '/', null, false, false);
                
                // Actualizar mejor puntuación si corresponde (solo si está completado)
                $bestScore = $request->cookie('sumas_best_score');
                if ($validated['completado'] && (!$bestScore || $validated['puntuacion'] > $bestScore)) {
                    $response->cookie('sumas_best_score', $validated['puntuacion'], 525600, '/', null, false, false);
                    $response->cookie('sumas_best_time', $validated['tiempo_seg'], 525600, '/', null, false, false);
                }
                
                // Guardar historial (solo si no es auto-save o si está completado)
                if (!($validated['auto_save'] ?? false) || ($validated['completado'] ?? false)) {
                    $history = $request->cookie('sumas_history');
                    $history = $history ? json_decode($history, true) : [];
                    array_unshift($history, [
                        'score' => $validated['puntuacion'],
                        'time' => $validated['tiempo_seg'],
                        'lives' => $validated['vidas'] ?? 0,
                        'streak' => $validated['racha'] ?? 0,
                        'operations' => $validated['operaciones_resueltas'] ?? 0,
                        'completed' => $validated['completado'] ?? false,
                        'date' => now()->toISOString()
                    ]);
                    if (count($history) > 5) {
                        $history = array_slice($history, 0, 5);
                    }
                    $response->cookie('sumas_history', json_encode($history), 525600, '/', null, false, false);
                }
                
            } else {
                // Puente de la lógica
                $response->cookie('puente_last_time', $validated['tiempo_seg'], 525600, '/', null, false, false);
                $response->cookie('puente_last_errors', $validated['errores'] ?? 0, 525600, '/', null, false, false);
                $response->cookie('puente_last_completed', $validated['completado'] ?? false, 525600, '/', null, false, false);
                
                // Actualizar mejor tiempo si corresponde
                $bestTime = $request->cookie('puente_best_time');
                if ($validated['completado'] && (!$bestTime || $validated['tiempo_seg'] < $bestTime)) {
                    $response->cookie('puente_best_time', $validated['tiempo_seg'], 525600, '/', null, false, false);
                    $response->cookie('puente_best_errors', $validated['errores'] ?? 0, 525600, '/', null, false, false);
                }
                
                // Guardar historial
                $history = $request->cookie('puente_history');
                $history = $history ? json_decode($history, true) : [];
                array_unshift($history, [
                    'time' => $validated['tiempo_seg'],
                    'errors' => $validated['errores'] ?? 0,
                    'stage' => 3,
                    'completed' => $validated['completado'] ?? false,
                    'date' => now()->toISOString()
                ]);
                if (count($history) > 5) {
                    $history = array_slice($history, 0, 5);
                }
                $response->cookie('puente_history', json_encode($history), 525600, '/', null, false, false);
            }

            return $response;

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar partida: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener datos del juego de sumas desde cookies
     */
    public function getSumasData(Request $request)
    {
        return response()->json([
            'last_score' => $request->cookie('sumas_last_score'),
            'last_time' => $request->cookie('sumas_last_time'),
            'last_completed' => $request->cookie('sumas_last_completed'),
            'best_score' => $request->cookie('sumas_best_score'),
            'best_time' => $request->cookie('sumas_best_time'),
            'history' => $request->cookie('sumas_history') ? json_decode($request->cookie('sumas_history')) : []
        ]);
    }

    /**
     * Obtener datos del puente de la lógica desde cookies
     */
    public function getPuenteData(Request $request)
    {
        return response()->json([
            'last_time' => $request->cookie('puente_last_time'),
            'last_errors' => $request->cookie('puente_last_errors'),
            'last_completed' => $request->cookie('puente_last_completed'),
            'best_time' => $request->cookie('puente_best_time'),
            'best_errors' => $request->cookie('puente_best_errors'),
            'history' => $request->cookie('puente_history') ? json_decode($request->cookie('puente_history')) : []
        ]);
    }

    /**
     * Obtener todos los datos de cookies
     */
    public function getAllData(Request $request)
    {
        return response()->json([
            'sumas' => [
                'last_score' => $request->cookie('sumas_last_score'),
                'last_time' => $request->cookie('sumas_last_time'),
                'last_completed' => $request->cookie('sumas_last_completed'),
                'best_score' => $request->cookie('sumas_best_score'),
                'best_time' => $request->cookie('sumas_best_time'),
                'history' => $request->cookie('sumas_history') ? json_decode($request->cookie('sumas_history')) : []
            ],
            'puente' => [
                'last_time' => $request->cookie('puente_last_time'),
                'last_errors' => $request->cookie('puente_last_errors'),
                'last_completed' => $request->cookie('puente_last_completed'),
                'best_time' => $request->cookie('puente_best_time'),
                'best_errors' => $request->cookie('puente_best_errors'),
                'history' => $request->cookie('puente_history') ? json_decode($request->cookie('puente_history')) : []
            ]
        ]);
    }

    /**
     * Obtener partidas del usuario desde la base de datos
     */
    public function getPartidas(Request $request)
    {
        $partidas = Partida::with(['juego', 'sesion'])
            ->where('id_usuario', Auth::id())
            ->orderBy('fecha', 'desc')
            ->orderBy('id_partida', 'desc')
            ->limit(10)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $partidas
        ]);
    }
}
