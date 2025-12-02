//-- Variables --
const frutasDisponibles = ["🍎", "🍓", "🍊", "🍐", "🍒"];
let cantidadCorrecta = 0;
let opciones = [];

//-- DOM Dinámico --
const body = document.body;

// Animaciones
const animacionesDiv = document.createElement("div");
animacionesDiv.id = "animaciones";

const sol = document.createElement("div");
sol.id = "sol";
sol.textContent = "☀️";
animacionesDiv.appendChild(sol);

const nube = document.createElement("div");
nube.id = "nube";
nube.textContent = "☁️";
animacionesDiv.appendChild(nube);

body.appendChild(animacionesDiv);

// Frutas
const frutasDiv = document.createElement("div");
frutasDiv.id = "frutas";
body.appendChild(frutasDiv);

// Botones
const opcionesDiv = document.createElement("div");
opcionesDiv.className = "opciones";
body.appendChild(opcionesDiv);

const botones = [];
for (let i = 0; i < 3; i++){
    const btn = document.createElement("button");
    btn.className = "btn";
    btn.addEventListener("click", () => verificar(i));
    opcionesDiv.appendChild(btn);
    botones.push(btn);
}

// Mensaje
const mensajeDiv = document.createElement("div");
mensajeDiv.id = "mensaje";
body.appendChild(mensajeDiv);

// --- Cookie del juego ---
function setCookie(nombre, valor) {
    const cookieValorJuego = JSON.stringify(valor);
    document.cookie = `${nombre}=${cookieValorJuego}; path=/;`;
}

function getCookie(nombre) {
    const cookies = document.cookie.split("; ");
    for (let c of cookies){
        const [key, value] = c.split("=");
        if (key === nombre) {
            JSON.parse(value);
        }
    }
}

// --- Datos de la partida ---
let partida = getCookie("partida") || { aciertos: 0, errores: 0 };

// -- Funciones del juego --
let frutaActual = "";
function nuevoDesafio(){
    sol.classList.remove("activo");
    nube.classList.remove("activo");

    frutaActual = frutasDisponibles[Math.floor(Math.random() * frutasDisponibles.length)];
    cantidadCorrecta = Math.floor(Math.random() * 5) + 1;

    frutasDiv.textContent = frutaActual.repeat(cantidadCorrecta);
    
    opciones = [
        cantidadCorrecta,
        cantidadCorrecta + 1,
        Math.max(1, cantidadCorrecta -1)
    ].sort(() => Math.random() - 0.5);

    for (let i = 0; i < 3; i++){
        botones[i].textContent = opciones[i];
    }

    mensajeDiv.textContent = "";
    mensajeDiv.className = "";
}

function verificar(indice){
    sol.classList.remove("activo");
    nube.classList.remove("activo");

    if (opciones[indice] === cantidadCorrecta){
        mensajeDiv.textContent = "☀️ ¡Muy bien! ¡Enhorabuena has superado el juego!";
        mensajeDiv.className = "ok";
        sol.classList.add("activo");

        // Guardar acierto antes de borrar la cookie (para mostrarlo)
        partida.aciertos++;
        setCookie("partida", partida); // cookie de sesión

        setTimeout(nuevoDesafio, 1500);
    } else  {
        mensajeDiv.textContent = "☁️ ¡Casi! Te voy a ayudar a contar";
        mensajeDiv.className = "error";
        nube.classList.add("activo");

        // Guardar error
        partida.errores++;
        setCookie("partida", partida, 3600);

        mostrarConteoAyuda();
    }

    mostrarResumenPartida();
}

function mostrarConteoAyuda(){
    let index = 0;

    const interval = setInterval(() => {

        frutasDiv.innerHTML = "";

        for (let i = 0; i < cantidadCorrecta; i++){
            const span = document.createElement("span");
            span.textContent = frutaActual;
            span.style.opacity = i <= index ? "1" : "0.3";
            span.style.fontSize = "60px";
            span.style.margin = "5px";
            frutasDiv.appendChild(span);
        }

        index++;

        if (index > cantidadCorrecta){
            clearInterval(interval);
        }

    }, 300);
}

// --- Mostrar resumen de la partida ---
function mostrarResumenPartida(){
    let resumenDiv = document.getElementById("resumen");
    if(!resumenDiv){
        resumenDiv = document.createElement("div");
        resumenDiv.id = "resumen";
        resumenDiv.style.marginTop = "20px";
        resumenDiv.style.fontSize = "18px";
        body.appendChild(resumenDiv);
    }
    resumenDiv.textContent = `Aciertos: ${partida.aciertos} | Errores: ${partida.errores}`;
}

// --- Iniciar el juego ---
nuevoDesafio();
// --- Mostrar resumen con los datos de la partida ---
mostrarResumenPartida();