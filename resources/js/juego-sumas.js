// Variables del juego
let score = 0;
let streak = 0;
let lives = 3;
let currentAnswer = 0;
let gameActive = true;
let flowersInGame = [];
let lastFlowerX = null;
let difficulty = 1;
const FLOWERS_TO_WIN = 10;
const FLOWER_IMAGES = [
    window.FLOWER_ROSE_PATHS[0],
    window.FLOWER_ROSE_PATHS[1],
    window.FLOWER_ROSE_PATHS[2]
];

// Temporizador
let timerInterval = null;
let timeElapsed = 0; // segundos transcurridos

// Variables para guardar progreso
let operationsResolved = 0; // Contador de operaciones resueltas
let totalClicks = 0; // Contador de clicks totales durante el juego

// Funciones para leer cookies (escritas por Laravel)
function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

// Guardar datos del juego (Laravel guarda las cookies)
function saveGameData(completed) {
    saveToDatabase(completed);
}

// Guardar en base de datos (Laravel crea las cookies)
async function saveToDatabase(completed) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    console.log('CSRF Token encontrado:', csrfToken ? 'Sí' : 'No');
    
    if (!csrfToken) {
        console.error('No se encontró el CSRF token');
        return;
    }
    
    const dataToSend = {
        juego: 'sumas',
        puntuacion: score,
        tiempo_seg: timeElapsed,
        vidas: lives,
        racha: streak,
        operaciones_resueltas: operationsResolved,
        helps_clicks: totalClicks,
        errores: 3 - lives, // Vidas perdidas
        completado: completed
    };
    
    console.log('Enviando datos:', dataToSend);
    
    try {
        const url = window.SAVE_PARTIDA_URL || '/partida/save';
        console.log('URL de guardado:', url);
        
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
        
        console.log('Respuesta status:', response.status);
        
        const data = await response.json();
        console.log('Respuesta del servidor:', data);
        
        if (response.ok) {
            console.log('✅ Partida guardada en BD');
            console.log('Cookies actuales:', document.cookie);
        } else {
            console.error('❌ Error al guardar:', data);
        }
    } catch (error) {
        console.error('❌ Error en la petición:', error);
    }
}

// Inicializar juego
function initGame() {
    score = 0;
    streak = 0;
    lives = 3;
    difficulty = 1;
    gameActive = true;
    flowersInGame = [];
    timeElapsed = 0; // reinicia el tiempo
    operationsResolved = 0; // reinicia operaciones resueltas
    totalClicks = 0; // reinicia contador de clicks

    // Limpiar área de juego
    document.getElementById('game-area').innerHTML = '';

    updateUI();
    updateTimerUI();
    generateOperation();
    startFlowerSpawn();
    startTimer();
}

// Actualizar UI del temporizador (ahora suma tiempo)
function updateTimerUI() {
    const timerSpan = document.getElementById('timer');
    if (!timerSpan) return;
    const min = Math.floor(timeElapsed / 60).toString().padStart(2, '0');
    const sec = (timeElapsed % 60).toString().padStart(2, '0');
    timerSpan.textContent = `${min}:${sec}`;
}

// Iniciar temporizador (ahora suma tiempo)
function startTimer() {
    if (timerInterval) clearInterval(timerInterval);
    updateTimerUI();
    timerInterval = setInterval(() => {
        if (!gameActive) {
            clearInterval(timerInterval);
            return;
        }
        timeElapsed++;
        updateTimerUI();
    }, 1000);
}

// Actualizar UI
function updateUI() {
    document.getElementById('score').textContent = score;
    document.getElementById('streak').textContent = streak;
    
    // Actualizar vidas
    const livesContainer = document.getElementById('lives');
    livesContainer.innerHTML = '';
    for (let i = 0; i < lives; i++) {
        const heart = document.createElement('span');
        heart.textContent = '❤️';
        livesContainer.appendChild(heart);
    }
}

// Generar operación
function generateOperation() {
    const num1 = Math.floor(Math.random() * 10) + 1;
    const num2 = Math.floor(Math.random() * 10) + 1;
    currentAnswer = num1 + num2;
    document.getElementById('operation').textContent = `${num1} + ${num2} = ?`;
}

// Crear flor
function createFlower(isCorrect) {
    if (!gameActive) return;

    const flower = document.createElement('div');
    flower.className = 'flower';

    const number = isCorrect ? currentAnswer : generateWrongAnswer();
    const imgSrc = FLOWER_IMAGES[Math.floor(Math.random() * FLOWER_IMAGES.length)];
    const size = 80 + Math.random() * 40;
    let startX, attempts = 0;
    const minDistance = 120; // px
    do {
        startX = Math.random() * (window.innerWidth - 120) + 10;
        attempts++;
    } while (lastFlowerX !== null && Math.abs(startX - lastFlowerX) < minDistance && attempts < 10);
    lastFlowerX = startX;
    const fallDuration = Math.max(5.5, 9 - difficulty * 0.5); // Más lento: duración base aumentada

    flower.style.left = startX + 'px';
    flower.style.width = size + 'px';
    flower.style.height = size + 'px';
    flower.style.position = 'absolute';
    flower.style.cursor = 'pointer';
    flower.style.userSelect = 'none';
    flower.style.display = 'flex';
    flower.style.alignItems = 'center';
    flower.style.justifyContent = 'center';
    flower.style.flexDirection = 'column';

    flower.innerHTML = `
        <img src="${imgSrc}" alt="Rosa" style="width: 100%; height: 100%; object-fit: contain; pointer-events: none; display: block;">
        <div class="flower-number" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 2.2rem; font-weight: bold; color: #5A3516; text-shadow: 2px 2px 0 #FED32C, -2px -2px 0 #FED32C; pointer-events: none;">${number}</div>
    `;

    flower.dataset.number = number;
    flower.dataset.isCorrect = isCorrect;
    flower.style.animation = `fall ${fallDuration}s linear forwards`;

    flower.addEventListener('click', () => {
        flower.clicked = true;
        handleFlowerClick(flower);
    });

    document.getElementById('game-area').appendChild(flower);
    flowersInGame.push(flower);

    // Eliminar flor cuando termine la animación
    setTimeout(() => {
        if (
            flower.parentElement &&
            flower.dataset.isCorrect === 'true' &&
            gameActive &&
            !flower.clicked
        ) {
            loseLife();
        }
        removeFlower(flower);
    }, fallDuration * 1000);
}

// Generar respuesta incorrecta
function generateWrongAnswer() {
    let wrong;
    do {
        wrong = currentAnswer + (Math.floor(Math.random() * 11) - 5);
    } while (wrong === currentAnswer || wrong < 0 || wrong > 20);
    return wrong;
}

// Manejar clic en flor
function handleFlowerClick(flower) {
    if (!gameActive) return;
    
    totalClicks++; // Incrementar contador de clicks
    const number = parseInt(flower.dataset.number);
    if (number === currentAnswer) {
        // Respuesta correcta
        score += 10 + (streak * 2);
        streak++;
        operationsResolved++; // Incrementar operaciones resueltas
        showFeedback('¡Genial!', '#4CAF50');
        removeFlower(flower);

        // Eliminar todas las flores correctas con el resultado anterior
        flowersInGame.slice().forEach(f => {
            if (f !== flower && f.dataset && f.dataset.isCorrect === 'true' && parseInt(f.dataset.number) === number) {
                removeFlower(f);
            }
        });

        // Aumentar dificultad
        if (streak % 5 === 0) {
            difficulty++;
        }

        // Verificar victoria
        if (score >= FLOWERS_TO_WIN * 10) {
            winGame();
        } else {
            generateOperation();
        }
    } else {
        // Respuesta incorrecta
        streak = 0;
        loseLife();
        timeElapsed += 10; // Sumar 10 segundos al equivocarse
        updateTimerUI();
        showFeedback('¡Ups!', '#E91E63');
        removeFlower(flower);
    }
    updateUI();
}

// Perder vida
function loseLife() {
    if (!gameActive) return;
    
    lives--;
    const livesContainer = document.getElementById('lives');
    livesContainer.style.animation = 'shake 0.5s';
    setTimeout(() => livesContainer.style.animation = '', 500);
    
    updateUI();
    
    if (lives <= 0) {
        gameOver();
    }
}

// Eliminar flor
function removeFlower(flower) {
    if (flower && flower.parentElement) {
        flower.style.transition = 'all 0.3s';
        flower.style.opacity = '0';
        flower.style.transform = 'scale(0)';
        setTimeout(() => {
            if (flower.parentElement) {
                flower.parentElement.removeChild(flower);
            }
        }, 300);
    }
    flowersInGame = flowersInGame.filter(f => f !== flower);
}

// Mostrar feedback
function showFeedback(text, color) {
    const feedback = document.getElementById('feedback');
    feedback.textContent = text;
    feedback.style.color = color;
    feedback.classList.remove('hidden');
    feedback.style.animation = 'pulse-success 0.6s ease-in-out';
    
    setTimeout(() => {
        feedback.classList.add('hidden');
    }, 800);
}

// Spawn de flores
function startFlowerSpawn() {
    const spawnFlower = () => {
        if (!gameActive) return;
        
        // Spawn de flor correcta
        const correctChance = 0.35 + (difficulty * 0.05);
        if (Math.random() < correctChance) {
            createFlower(true);
        }
        
        // Spawn de flores incorrectas
        const wrongFlowers = Math.floor(Math.random() * 2) + 1;
        for (let i = 0; i < wrongFlowers; i++) {
            setTimeout(() => {
                if (gameActive) createFlower(false);
            }, Math.random() * 600);
        }
        
        // Siguiente spawn
        const nextSpawn = Math.max(1000, 2200 - difficulty * 120);
        setTimeout(spawnFlower, nextSpawn);
    };
    
    spawnFlower();
}

// Ganar juego
function winGame() {
    gameActive = false;
    if (timerInterval) clearInterval(timerInterval);
    saveGameData(true); // Guardar en cookies
    try {
        localStorage.setItem('sumasCompleted', 'true');
    } catch (e) {
        // ignore storage errors
    }
    // Limpiar flores
    flowersInGame.forEach(flower => removeFlower(flower));
    document.getElementById('final-score').textContent = score;
    document.getElementById('victory-modal').classList.remove('hidden');
}

// Game Over
function gameOver() {
    gameActive = false;
    if (timerInterval) clearInterval(timerInterval);
    saveGameData(false); // Guardar en cookies
    // Limpiar flores
    flowersInGame.forEach(flower => removeFlower(flower));
    document.getElementById('gameover-score').textContent = score;
    document.getElementById('gameover-modal').classList.remove('hidden');
}

// Reiniciar juego
window.restartGame = function restartGame() {
    const gameoverModal = document.getElementById('gameover-modal');
    const victoryModal = document.getElementById('victory-modal');
    if (gameoverModal) gameoverModal.classList.add('hidden');
    if (victoryModal) victoryModal.classList.add('hidden');
    flowersInGame.forEach(flower => removeFlower(flower));
    if (timerInterval) clearInterval(timerInterval);
    initGame();
}

// Siguiente nivel
function nextLevel() {
    try {
        localStorage.setItem('sumasCompleted', 'true');
    } catch (e) {
        // ignore storage errors
    }
    const target = window.PUENTE_LOGICA_URL || '/puente-logica';
    window.location.href = target;
}

// Iniciar al cargar
window.addEventListener('DOMContentLoaded', initGame);
