//-- Variables --
const frutasDisponibles = ["🍎", "🍓", "🍊", "🍐", "🍒"];
let cantidadCorrecta = 0;
let opciones = [];

//-- Datos de la partida --
let partida = {
    aciertos: 0,
    errores: 0,
    racha: 0,
    mejorRacha: 0,
    totalJugadas: 0
};

//-- DOM Dinámico --
const body = document.body;

// Contenedor principal - EXACTO AL PROTOTIPO
const gameContainer = document.createElement("div");
gameContainer.className = "game-container";
body.appendChild(gameContainer);

// Título EXACTO como el prototipo (dos líneas)
const tituloContainer = document.createElement("div");
tituloContainer.className = "titulo-container";
tituloContainer.innerHTML = `
    <h1 class="titulo-principal">VALLE DE LAS<br>FRUTAS ENCANTADAS</h1>
`;
gameContainer.appendChild(tituloContainer);

// Pregunta EXACTA como el prototipo (tres líneas)
const preguntaContainer = document.createElement("div");
preguntaContainer.className = "pregunta-container";
const preguntaDiv = document.createElement("div");
preguntaDiv.className = "pregunta";
preguntaDiv.innerHTML = "¿QUÉ NÚMERO<br>REPRESENTA ESTE<br>GRUPO?";
preguntaContainer.appendChild(preguntaDiv);
gameContainer.appendChild(preguntaContainer);

// Frutas container
const frutasContainer = document.createElement("div");
frutasContainer.className = "frutas-container";
frutasContainer.id = "frutas-container";
gameContainer.appendChild(frutasContainer);

// Botones container
const botonesContainer = document.createElement("div");
botonesContainer.className = "botones-container";
gameContainer.appendChild(botonesContainer);

// Crear 3 botones como en el prototipo (con números 4, 5, 6 inicialmente)
const botones = [];
for (let i = 0; i < 3; i++) {
    const btn = document.createElement("button");
    btn.className = "btn-opcion";
    btn.addEventListener("click", () => verificar(i));
    botonesContainer.appendChild(btn);
    botones.push(btn);
}

// Mensaje container
const mensajeContainer = document.createElement("div");
mensajeContainer.className = "mensaje-container";
gameContainer.appendChild(mensajeContainer);

const mensajeDiv = document.createElement("div");
mensajeDiv.className = "mensaje";
mensajeDiv.id = "mensaje";
mensajeContainer.appendChild(mensajeDiv);

// Animaciones container
const animacionesContainer = document.createElement("div");
animacionesContainer.className = "animaciones-container";
animacionesContainer.id = "animaciones";

const sol = document.createElement("div");
sol.className = "sol-animacion";
sol.textContent = "☀️";
animacionesContainer.appendChild(sol);

const nube = document.createElement("div");
nube.className = "nube-animacion";
nube.textContent = "☁️";
animacionesContainer.appendChild(nube);

gameContainer.appendChild(animacionesContainer);

// --- FUNCIONES DE COOKIES Y BASE DE DATOS ---

function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) {
            const valor = c.substring(nameEQ.length, c.length);
            try {
                return JSON.parse(decodeURIComponent(valor));
            } catch (e) {
                return valor;
            }
        }
    }
    return null;
}

function setCookie(name, value, days = 7) {
    const d = new Date();
    d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
    const expires = "expires=" + d.toUTCString();
    const valorCodificado = encodeURIComponent(JSON.stringify(value));
    document.cookie = name + "=" + valorCodificado + ";" + expires + ";path=/";
}

function guardarPartidaEnCookies() {
    setCookie('partida_frutas', partida, 7);
}

function cargarPartidaDesdeCookies() {
    const cookieData = getCookie('partida_frutas');
    if (cookieData) {
        partida = { ...partida, ...cookieData };
    }
}

async function saveToDatabase(completed) {
    guardarPartidaEnCookies();

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    if (!csrfToken) {
        console.error('No se encontró el CSRF token');
        return;
    }

    const dataToSend = {
        juego: 'frutas_encantadas',
        puntuacion: partida.aciertos * 10,
        tiempo_seg: 0,
        vidas: 3,
        racha: partida.racha,
        operaciones_resueltas: partida.aciertos,
        helps_clicks: partida.errores,
        errores: partida.errores,
        completado: completed,
        mejor_racha: partida.mejorRacha,
        total_jugadas: partida.totalJugadas
    };

    try {
        const url = window.SAVE_PARTIDA_URL || '/partida/save';

        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            credentials: 'same-origin',
            body: JSON.stringify(dataToSend)
        });

        if (response.ok) {
            console.log('✅ Partida guardada en BD');
        }
    } catch (error) {
        console.error('❌ Error en la petición:', error);
    }
}

// --- FUNCIONES DEL JUEGO ---

let frutaActual = "";

function nuevoDesafio() {
    // Seleccionar fruta aleatoria
    frutaActual = frutasDisponibles[Math.floor(Math.random() * frutasDisponibles.length)];
    
    // Cantidad aleatoria entre 1 y 5
    cantidadCorrecta = Math.floor(Math.random() * 5) + 1;

    // Limpiar y crear frutas
    frutasContainer.innerHTML = '';

    // Crear las frutas según la cantidad correcta
    for (let i = 0; i < cantidadCorrecta; i++) {
        const frutaSpan = document.createElement("span");
        frutaSpan.className = "fruta-item";
        frutaSpan.textContent = frutaActual;
        frutasContainer.appendChild(frutaSpan);
    }

    // Generar opciones - una correcta y dos incorrectas
    opciones = [
        cantidadCorrecta,
        cantidadCorrecta + 1,
        Math.max(1, cantidadCorrecta - 1)
    ];
    
    // Mezclar aleatoriamente las opciones
    for (let i = opciones.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [opciones[i], opciones[j]] = [opciones[j], opciones[i]];
    }

    // Asignar números a botones
    for (let i = 0; i < 3; i++) {
        botones[i].textContent = opciones[i];
    }

    // Ocultar mensaje y animaciones
    mensajeDiv.textContent = "";
    mensajeDiv.className = "mensaje";
    animacionesContainer.classList.remove("mostrar");
    sol.style.display = "none";
    nube.style.display = "none";

    // Actualizar contador de jugadas
    partida.totalJugadas++;

    // Guardar en cookies
    guardarPartidaEnCookies();
}

function verificar(indice) {
    if (opciones[indice] === cantidadCorrecta) {
        // ACIERTO
        mensajeDiv.innerHTML = "☀️ ¡Muy bien! ¡Sigue así!";
        mensajeDiv.className = "mensaje acierto mostrar";

        animacionesContainer.classList.add("mostrar");
        sol.style.display = "block";
        nube.style.display = "none";

        // Actualizar estadísticas
        partida.aciertos++;
        partida.racha++;
        if (partida.racha > partida.mejorRacha) {
            partida.mejorRacha = partida.racha;
        }

        saveToDatabase(false);

        setTimeout(nuevoDesafio, 1500);
    } else {
        // ERROR
        mensajeDiv.innerHTML = "☁️ ¡Casi! Te ayudo a contar";
        mensajeDiv.className = "mensaje error mostrar";

        animacionesContainer.classList.add("mostrar");
        sol.style.display = "none";
        nube.style.display = "block";

        // Actualizar estadísticas
        partida.errores++;
        partida.racha = 0;

        saveToDatabase(false);

        mostrarConteoAyuda();
    }

    // Guardar en cookies inmediatamente
    guardarPartidaEnCookies();
}

function mostrarConteoAyuda() {
    const frutas = frutasContainer.querySelectorAll('.fruta-item');
    let index = 0;

    const interval = setInterval(() => {
        if (index < frutas.length) {
            // Resaltar la fruta actual
            frutas[index].style.transform = 'scale(1.4)';
            frutas[index].style.filter = 'brightness(1.3)';
            frutas[index].style.transition = 'all 0.3s ease';

            // Restaurar la fruta anterior (si existe)
            if (index > 0) {
                frutas[index - 1].style.transform = 'scale(1)';
                frutas[index - 1].style.filter = 'brightness(1)';
            }

            index++;
        } else {
            // Restaurar todas las frutas al final
            setTimeout(() => {
                frutas.forEach(fruta => {
                    fruta.style.transform = 'scale(1)';
                    fruta.style.filter = 'brightness(1)';
                });
            }, 300);
            
            clearInterval(interval);
            
            // Continuar con nuevo desafío después de un breve delay
            setTimeout(nuevoDesafio, 1500);
        }
    }, 600);
}

// Función para reiniciar el juego
function restartGame(confirmar = false) {
    if (confirmar && !confirm('¿Estás seguro de que quieres reiniciar el juego? Se perderá el progreso actual.')) {
        return;
    }
    
    partida = {
        aciertos: 0,
        errores: 0,
        racha: 0,
        mejorRacha: 0,
        totalJugadas: 0
    };
    
    nuevoDesafio();
    guardarPartidaEnCookies();
    
    // Mostrar mensaje de reinicio
    mensajeDiv.innerHTML = "¡Juego reiniciado!";
    mensajeDiv.className = "mensaje acierto mostrar";
    
    setTimeout(() => {
        mensajeDiv.className = "mensaje";
    }, 2000);
}

// --- INICIAR EL JUEGO ---

document.addEventListener('DOMContentLoaded', () => {
    // Cargar partida guardada
    cargarPartidaDesdeCookies();
    
    // Iniciar primer desafío
    nuevoDesafio();

    // Guardar periódicamente cada 30 segundos
    setInterval(() => {
        guardarPartidaEnCookies();
    }, 30000);

    // Sincronizar con BD cada 60 segundos
    setInterval(() => {
        if (partida.aciertos > 0 || partida.errores > 0) {
            saveToDatabase(false);
        }
    }, 60000);

    // Guardar al cerrar la página
    window.addEventListener('beforeunload', () => {
        saveToDatabase(false);
    });

    // Hacer disponible la función restartGame globalmente
    window.restartGame = restartGame;
});