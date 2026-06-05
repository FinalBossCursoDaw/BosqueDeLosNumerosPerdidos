# Resumen técnico del proyecto

## Nombre del proyecto

**El Bosque de los Números Perdidos**

---

## Descripción general

El Bosque de los Números Perdidos es una aplicación web educativa desarrollada con Laravel, Blade, PHP, JavaScript, HTML y CSS.

El objetivo del proyecto es crear una experiencia interactiva en la que el usuario pueda practicar conceptos matemáticos y lógicos mediante minijuegos ambientados en un entorno de fantasía.

La aplicación incluye páginas informativas, autenticación de usuarios, minijuegos, guardado de partidas y uso de cookies para almacenar información del progreso.

---

## Tecnologías utilizadas

* PHP
* Laravel
* Blade
* JavaScript
* HTML
* CSS
* Tailwind CSS
* Vite
* SQLite
* Composer
* NPM

---

## Funcionalidades principales

El proyecto permite:

* Ver una página principal o landing page.
* Consultar la historia del juego.
* Registrar usuarios.
* Iniciar sesión.
* Cerrar sesión.
* Acceder a minijuegos educativos.
* Guardar partidas.
* Consultar partidas del usuario.
* Guardar información de progreso mediante cookies.

---

## Minijuegos del proyecto

### El Bosque de las Sumas

Minijuego matemático basado en operaciones de suma.

El usuario debe resolver operaciones y seleccionar la respuesta correcta.
El juego controla puntuación, vidas, racha, tiempo y operaciones resueltas.

Archivos principales:

```txt
resources/views/juego-sumas.blade.php
resources/js/juego-sumas.js
```

---

### Puente de la Lógica

Minijuego basado en secuencias lógicas.

El usuario debe ordenar elementos siguiendo una lógica concreta.
El juego controla fases, errores, tiempo y resultado final.

Archivos principales:

```txt
resources/views/puente-logica.blade.php
resources/js/puente-logica.js
```

---

## Estructura principal del proyecto

```txt
BosqueDeLosNumerosPerdidos/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AuthController.php
│   │       ├── CookieController.php
│   │       └── LandingController.php
│   └── Models/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   ├── css/
│   └── imagenes/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
│   └── web.php
├── composer.json
├── package.json
└── README.md
```

---

## Controladores principales

### LandingController

Se encarga de cargar las vistas principales de la aplicación.

Ejemplos:

* Landing page.
* Historia.
* Login.
* Registro.
* Juegos.

---

### AuthController

Se encarga de la autenticación de usuarios.

Funciones principales:

* Login.
* Registro.
* Logout.

---

### CookieController

Se encarga de guardar y recuperar información relacionada con partidas y progreso del usuario.

Funciones principales:

* Guardar partidas.
* Guardar datos en cookies.
* Recuperar datos guardados.
* Consultar partidas del usuario.

---

## Base de datos

El proyecto utiliza SQLite en local.

Tablas principales:

* Usuarios.
* Juegos.
* Sesiones.
* Fechas.
* Partidas.

La base de datos permite guardar usuarios, juegos y resultados de partidas.

---

## Instalación básica

Para instalar dependencias de PHP:

```bash
composer install
```

Para instalar dependencias de Node:

```bash
npm install
```

Para crear el archivo de entorno:

```bash
cp .env.example .env
```

Para generar la clave de Laravel:

```bash
php artisan key:generate
```

Para ejecutar migraciones:

```bash
php artisan migrate
```

Para levantar Laravel:

```bash
php artisan serve
```

Para ejecutar Vite:

```bash
npm run dev
```

---

## Seguridad

El proyecto utiliza mecanismos propios de Laravel, como:

* Validación de formularios.
* Hash de contraseñas.
* Protección CSRF.
* Middleware de autenticación.
* Rutas protegidas para usuarios autenticados.

---

## Documentación

El proyecto dispone de documentación en la Wiki de GitHub.

Además, este documento resume las partes técnicas principales del proyecto para facilitar su revisión y defensa.

---

## Posibles mejoras futuras

Algunas mejoras que se podrían añadir son:

* Ranking de puntuaciones.
* Panel de usuario con estadísticas.
* Más minijuegos.
* Mejora del diseño responsive.
* Sistema de roles.
* Tests para controladores principales.

---

## Autores

Proyecto desarrollado como práctica educativa de inicio de curso.

Autores:

* Víctor Calvo
* Adrià Gómez
