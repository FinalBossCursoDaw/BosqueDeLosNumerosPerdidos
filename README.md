# El Bosque de los Números Perdidos

## Descripción del proyecto

**El Bosque de los Números Perdidos** es una aplicación web educativa desarrollada con Laravel, Blade, JavaScript, HTML y CSS.

El objetivo del proyecto es crear una experiencia interactiva para que los usuarios puedan practicar conceptos matemáticos y lógicos mediante minijuegos ambientados en un mundo de fantasía.

La aplicación incluye una página principal, una sección de historia, sistema de registro e inicio de sesión, juegos interactivos y guardado de partidas mediante base de datos y cookies.

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

La aplicación permite:

* Visualizar una landing page con la presentación del juego.
* Acceder a una página de historia del mundo del bosque.
* Registrar nuevos usuarios.
* Iniciar sesión y cerrar sesión.
* Jugar a minijuegos educativos.
* Guardar datos de partida.
* Guardar información de progreso mediante cookies.
* Consultar partidas guardadas del usuario autenticado.

---

## Minijuegos incluidos

### El Bosque de las Sumas

Juego matemático en el que el usuario debe resolver operaciones de suma.

Funcionamiento principal:

* Se muestra una operación de suma.
* Caen flores con diferentes números.
* El usuario debe hacer clic en la flor que contiene la respuesta correcta.
* El juego controla puntuación, vidas, racha, tiempo y operaciones resueltas.
* El progreso se guarda automáticamente cada cierto tiempo.
* Al finalizar, se guardan los resultados de la partida.

Archivo JavaScript principal:

```txt
resources/js/juego-sumas.js
```

Vista principal:

```txt
resources/views/juego-sumas.blade.php
```

---

### Puente de la Lógica

Juego de lógica en el que el usuario debe ordenar piedras siguiendo una secuencia.

Funcionamiento principal:

* El usuario debe colocar números en el orden correcto.
* El juego tiene varias fases.
* Se controla el número de errores.
* Se mide el tiempo empleado.
* Al completar el juego se guarda la partida.

Archivo JavaScript principal:

```txt
resources/js/puente-logica.js
```

Vista principal:

```txt
resources/views/puente-logica.blade.php
```

---

## Estructura del proyecto

```txt
BosqueDeLosNumerosPerdidos/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AuthController.php
│   │       ├── CookieController.php
│   │       └── LandingController.php
│   └── Models/
│       ├── Fecha.php
│       ├── Juego.php
│       ├── Partida.php
│       ├── Sesion.php
│       ├── User.php
│       └── Usuario.php
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   ├── css/
│   └── imagenes/
├── resources/
│   ├── css/
│   ├── js/
│   │   ├── juego-sumas.js
│   │   └── puente-logica.js
│   └── views/
│       ├── landing.blade.php
│       ├── historia.blade.php
│       ├── login.blade.php
│       ├── register.blade.php
│       ├── juego-sumas.blade.php
│       └── puente-logica.blade.php
├── routes/
│   └── web.php
├── composer.json
├── package.json
└── README.md
```

---

## Controladores principales

### LandingController

Controlador encargado de cargar las vistas principales de la aplicación.

Rutas asociadas:

* Página principal.
* Historia.
* Login.
* Registro.
* Juego de sumas.
* Puente de la lógica.

Archivo:

```txt
app/Http/Controllers/LandingController.php
```

---

### AuthController

Controlador encargado de la autenticación.

Funciones principales:

* Procesar inicio de sesión.
* Registrar nuevos usuarios.
* Cerrar sesión.

Archivo:

```txt
app/Http/Controllers/AuthController.php
```

---

### CookieController

Controlador encargado de guardar y recuperar datos de partidas.

Funciones principales:

* Guardar partidas en la base de datos.
* Crear y actualizar cookies del juego de sumas.
* Crear y actualizar cookies del puente de la lógica.
* Recuperar datos guardados.
* Consultar las últimas partidas del usuario.

Archivo:

```txt
app/Http/Controllers/CookieController.php
```

---

## Modelos principales

### Usuario

Representa los usuarios registrados en la aplicación.

Tabla asociada:

```txt
Usuarios
```

---

### Juego

Representa los juegos disponibles en la aplicación.

Tabla asociada:

```txt
Juegos
```

---

### Sesion

Representa una sesión de juego.

Tabla asociada:

```txt
Sesiones
```

---

### Fecha

Representa la fecha en la que se realiza una partida.

Tabla asociada:

```txt
Fechas
```

---

### Partida

Representa una partida guardada por un usuario.

Tabla asociada:

```txt
Partidas
```

---

## Base de datos

El proyecto utiliza SQLite en local.

Configuración principal del archivo `.env`:

```env
DB_CONNECTION=sqlite
DB_DATABASE=database.sqlite
```

Tablas principales del proyecto:

* `Usuarios`
* `Juegos`
* `Sesiones`
* `Fechas`
* `Partidas`

La base de datos permite guardar usuarios, juegos, sesiones y resultados de partidas.

---

## Rutas principales

Las rutas están definidas en:

```txt
routes/web.php
```

Rutas públicas:

```txt
GET  /                    Página principal
GET  /historia            Historia del juego
GET  /login               Formulario de login
POST /login               Procesar login
GET  /register            Formulario de registro
POST /register            Procesar registro
POST /logout              Cerrar sesión
GET  /juegos/sumas        Juego El Bosque de las Sumas
GET  /juegos/puente-logica Juego Puente de la Lógica
```

Rutas protegidas por autenticación:

```txt
GET  /cookies/sumas       Obtener cookies del juego de sumas
GET  /cookies/puente      Obtener cookies del puente de la lógica
GET  /cookies/all         Obtener todos los datos guardados en cookies
POST /partida/save        Guardar una partida
GET  /partidas            Obtener partidas del usuario
```

---

## Instalación del proyecto

### 1. Clonar el repositorio

```bash
git clone URL_DEL_REPOSITORIO
cd BosqueDeLosNumerosPerdidos
```

---

### 2. Instalar dependencias de PHP

```bash
composer install
```

---

### 3. Instalar dependencias de Node

```bash
npm install
```

---

### 4. Crear archivo de entorno

```bash
cp .env.example .env
```

En Windows también se puede copiar manualmente `.env.example` y renombrarlo a `.env`.

---

### 5. Generar la clave de Laravel

```bash
php artisan key:generate
```

---

### 6. Crear base de datos SQLite

Crear el archivo:

```txt
database/database.sqlite
```

Después, revisar el `.env`:

```env
DB_CONNECTION=sqlite
DB_DATABASE=database.sqlite
```

---

### 7. Ejecutar migraciones

```bash
php artisan migrate
```

---

### 8. Compilar assets

Para desarrollo:

```bash
npm run dev
```

Para producción:

```bash
npm run build
```

---

### 9. Levantar servidor Laravel

```bash
php artisan serve
```

La aplicación se abrirá normalmente en:

```txt
http://127.0.0.1:8000
```

---

## Comandos útiles

Instalar dependencias PHP:

```bash
composer install
```

Instalar dependencias JS:

```bash
npm install
```

Ejecutar Laravel:

```bash
php artisan serve
```

Ejecutar Vite:

```bash
npm run dev
```

Compilar assets:

```bash
npm run build
```

Ejecutar migraciones:

```bash
php artisan migrate
```

Limpiar caché:

```bash
php artisan optimize:clear
```

---

## Sistema de guardado

El proyecto utiliza dos sistemas para guardar información:

### Base de datos

Se guardan partidas relacionadas con:

* Usuario.
* Juego.
* Fecha.
* Sesión.
* Puntuación.
* Tiempo.

### Cookies

Se utilizan cookies para guardar datos rápidos del progreso del usuario, como:

* Última puntuación.
* Mejor puntuación.
* Mejor tiempo.
* Historial reciente.
* Errores.
* Estado de partida completada.

---

## Seguridad

El proyecto utiliza:

* Validación de formularios en Laravel.
* Hash de contraseñas.
* Sistema de autenticación.
* Protección CSRF en formularios y peticiones POST.
* Rutas protegidas mediante middleware `auth`.

---

## Estado del proyecto

El proyecto está en una fase educativa y funcional.

Actualmente incluye:

* Landing page.
* Historia.
* Login.
* Registro.
* Dos minijuegos.
* Guardado de partidas.
* Uso de cookies.
* Base de datos.
* Documentación en Wiki de GitHub.

---

## Posibles mejoras futuras

* Añadir más niveles o minijuegos.
* Crear un panel de usuario con estadísticas.
* Mostrar ranking de puntuaciones.
* Mejorar la adaptación responsive.
* Añadir sistema de roles completo.
* Mejorar la gestión de partidas guardadas.
* Añadir tests específicos para los controladores principales.

---

## Autores

Proyecto desarrollado como práctica educativa de inicio de curso.

Autores:

* Víctor Calvo
* Adrià Gómez
