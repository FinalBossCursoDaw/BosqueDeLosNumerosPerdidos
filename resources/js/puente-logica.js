// Lógica del juego Puente de la Lógica
const STONE_COUNT = 9;

let correctOrder = [];
let stones = [];
// Estado de color de cada piedra: 'normal', 'green', 'red'
let stoneStates = [];
let errorCount = 0; // Contador de errores
let timerInterval = null;
let timeElapsed = 0;
let gameActive = false;
let orderDescending = false; // false: 1->9, true: 9->1
let stage = 1;

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
    if (completed) {
        saveToDatabase(completed);
    }
}

// Guardar en base de datos (Laravel crea las cookies)
async function saveToDatabase(completed) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    console.log('CSRF Token encontrado:', csrfToken ? 'Sí' : 'No');
    
    if (!csrfToken) {
        console.error('No se encontró el CSRF token');
        return;
    }
    
    // Calcular puntuación (menos tiempo y errores = mejor)
    const puntuacion = Math.max(0, 1000 - (timeElapsed * 5) - (errorCount * 10));
    
    const dataToSend = {
        juego: 'puente-logica',
        puntuacion: puntuacion,
        tiempo_seg: timeElapsed,
        errores: errorCount || 0,
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

function shuffle(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

function renderStones() {
    const row = document.getElementById('stones-row');
    row.innerHTML = '';
    stones.forEach((num, idx) => {
        const stone = document.createElement('div');
        stone.className = 'stone-draggable relative w-[70px] h-[70px] flex items-center justify-center select-none';
        stone.setAttribute('draggable', 'true');
        stone.setAttribute('data-idx', idx);

        // Imagen de la piedra según su estado
        const img = document.createElement('img');
        let imgSrc = '';
        if (stoneStates[idx] === 'green') {
            imgSrc = window.GREEN_STONE_IMAGE_PATH;
        } else if (stoneStates[idx] === 'red') {
            imgSrc = window.RED_STONE_IMAGE_PATH;
        } else {
            imgSrc = window.STONE_IMAGE_PATHS && window.STONE_IMAGE_PATHS[num] ? window.STONE_IMAGE_PATHS[num] : window.STONE_IMAGE_PATHS[1];
        }
        img.src = imgSrc;
        img.alt = 'Piedra';
        img.className = 'absolute inset-0 w-full h-full object-contain pointer-events-none';
        img.draggable = false;
        stone.appendChild(img);

        // Número encima
        const numSpan = document.createElement('span');
        numSpan.textContent = num;
        numSpan.className = 'relative z-10 text-3xl font-black text-[#333] drop-shadow-lg';
        stone.appendChild(numSpan);

        stone.addEventListener('dragstart', onDragStart);
        stone.addEventListener('dragover', onDragOver);
        stone.addEventListener('drop', onDrop);
        stone.addEventListener('dragend', onDragEnd);
        row.appendChild(stone);
    });
}

let dragSrcIdx = null;
function onDragStart(e) {
    dragSrcIdx = +this.getAttribute('data-idx');
    this.classList.add('dragging');
    e.dataTransfer.effectAllowed = 'move';
}
function onDragOver(e) {
    e.preventDefault();
    e.dataTransfer.dropEffect = 'move';
}
function onDrop(e) {
    e.preventDefault();
    const targetIdx = +this.getAttribute('data-idx');
    if (dragSrcIdx !== null && dragSrcIdx !== targetIdx) {
        [stones[dragSrcIdx], stones[targetIdx]] = [stones[targetIdx], stones[dragSrcIdx]];
        // También intercambiar el estado de color de las piedras
        [stoneStates[dragSrcIdx], stoneStates[targetIdx]] = [stoneStates[targetIdx], stoneStates[dragSrcIdx]];
        renderStones();
    }
    dragSrcIdx = null;
}
function onDragEnd() {
    this.classList.remove('dragging');
}

function checkOrder() {
    const row = document.getElementById('stones-row');
    let allCorrect = true;
    let wrongCount = 0;
    // Actualizar el estado de color de cada piedra
    stones.forEach((num, idx) => {
        if (num !== correctOrder[idx]) {
            stoneStates[idx] = 'red';
            if (row.children[idx]) row.children[idx].classList.add('stone-wrong');
            allCorrect = false;
            wrongCount += 1;
        } else {
            stoneStates[idx] = 'green';
            if (row.children[idx]) row.children[idx].classList.remove('stone-wrong');
        }
    });
    renderStones();
    const msg = document.getElementById('result-message');
    msg.classList.remove('result-success', 'result-error');
    if (allCorrect) {
        msg.classList.add('result-success');
        if (stage === 3) {
            finishGame();
            return;
        }
        msg.textContent = '¡La abeja cruza el puente!';
        setTimeout(() => {
            msg.textContent = '';
            if (stage < 3) stage += 1;
            showStageMessage(stage);
            restartGame(false, true);
        }, 2000);
    } else {
        msg.classList.add('result-error');
        msg.textContent = '¡Ánimo! Ajusta las piedras rojas y sigue el camino brillante.';
        errorCount += wrongCount;
        updateErrorUI();
    }
}

// Actualizar UI de errores
function updateErrorUI() {
    const errorSpan = document.getElementById('error-count');
    if (errorSpan) {
        errorSpan.textContent = errorCount;
    }
}
function updateTimerUI() {
    const timerSpan = document.getElementById('timer');
    if (!timerSpan) return;
    const min = Math.floor(timeElapsed / 60).toString().padStart(2, '0');
    const sec = (timeElapsed % 60).toString().padStart(2, '0');
    timerSpan.textContent = `${min}:${sec}`;
}
function stopTimer() {
    if (timerInterval) {
        clearInterval(timerInterval);
        timerInterval = null;
    }
}
function startTimer() {
    stopTimer();
    gameActive = true;
    updateTimerUI();
    timerInterval = setInterval(() => {
        if (!gameActive) {
            stopTimer();
            return;
        }
        timeElapsed++;
        updateTimerUI();
    }, 1000);
}
function resetTimer() {
    timeElapsed = 0;
    updateTimerUI();
}

function buildCorrectOrder() {
    correctOrder = [];
    if (stage === 1) {
        for (let i = 1; i <= STONE_COUNT; i++) correctOrder.push(i);
    } else if (stage === 2) {
        for (let i = STONE_COUNT; i >= 1; i--) correctOrder.push(i);
    } else {
        for (let i = 2; i <= 18; i += 2) correctOrder.push(i);
    }
}

function updateInstructionText() {
    const dirSpan = document.getElementById('order-direction');
    if (!dirSpan) return;
    if (stage === 1) {
        dirSpan.textContent = 'DEL 1 AL 9';
    } else if (stage === 2) {
        dirSpan.textContent = 'DEL 9 AL 1';
    } else {
        dirSpan.textContent = 'DEL 2 AL 18 (DE 2 EN 2)';
    }
}

function updateStageUI() {
    const stageSpan = document.getElementById('stage-display');
    if (stageSpan) {
        stageSpan.textContent = `${stage}/3`;
    }
}

function setStageConfig() {
    if (stage < 1) stage = 1;
    if (stage > 3) stage = 3;
    orderDescending = stage === 2;
}

function showStageMessage(nextStage) {
    const stageBox = document.getElementById('stage-message');
    if (!stageBox) return;
    let text = '';
    if (nextStage === 2) {
        text = '¡Etapa 2! Ahora ordena las piedras del 9 al 1.';
    } else if (nextStage === 3) {
        text = '¡Etapa final! Ordena de 2 en 2 desde el 2 al 18.';
    } else {
        text = 'Nueva etapa';
    }
    stageBox.textContent = text;
    stageBox.classList.remove('stage-toast-show');
    void stageBox.offsetWidth; // reflow to reiniciar animación
    stageBox.classList.add('stage-toast-show');
}

function finishGame() {
    gameActive = false;
    stopTimer();
    updateStageUI();
    saveGameData(true); // Guardar en cookies
    const msg = document.getElementById('result-message');
    if (msg) {
        msg.classList.remove('result-error');
        msg.classList.add('result-success');
        msg.textContent = '¡Has completado todas las etapas!';
    }
    const timeSpan = document.getElementById('victory-time');
    if (timeSpan) {
        const min = Math.floor(timeElapsed / 60).toString().padStart(2, '0');
        const sec = (timeElapsed % 60).toString().padStart(2, '0');
        timeSpan.textContent = `${min}:${sec}`;
    }
    const victoryModal = document.getElementById('victory-modal');
    if (victoryModal) {
        victoryModal.classList.remove('hidden');
    }
    const checkBtn = document.getElementById('check-btn');
    if (checkBtn) {
        checkBtn.setAttribute('disabled', 'true');
        checkBtn.classList.add('opacity-60', 'cursor-not-allowed');
    }
}

function restartGame(resetStage = false, keepTimer = false) {
    if (resetStage) {
        stage = 1;
        errorCount = 0;
        timeElapsed = 0;
    }
    setStageConfig();
    buildCorrectOrder();
    stones = shuffle([...correctOrder]);
    // Inicializar todas las piedras como 'normal'
    stoneStates = Array(STONE_COUNT).fill('normal');
    if (keepTimer) {
        updateTimerUI();
    } else {
        resetTimer();
    }
    startTimer();
    renderStones();
    document.getElementById('result-message').textContent = '';
    updateInstructionText();
    updateStageUI();
    updateErrorUI();
    const victoryModal = document.getElementById('victory-modal');
    if (victoryModal) {
        victoryModal.classList.add('hidden');
    }
    const checkBtn = document.getElementById('check-btn');
    if (checkBtn) {
        checkBtn.removeAttribute('disabled');
        checkBtn.classList.remove('opacity-60', 'cursor-not-allowed');
    }
}

window.restartGame = restartGame;

document.addEventListener('DOMContentLoaded', function() {
    try {
        if (!localStorage.getItem('sumasCompleted')) {
            const lockedModal = document.getElementById('locked-modal');
            const goBtn = document.getElementById('locked-go');
            if (lockedModal) lockedModal.classList.remove('hidden');
            if (goBtn) {
                goBtn.addEventListener('click', () => {
                    const redirectUrl = window.SUMAS_GAME_URL || '/juego-sumas';
                    window.location.href = redirectUrl;
                });
            } else {
                const redirectUrl = window.SUMAS_GAME_URL || '/juego-sumas';
                window.location.href = redirectUrl;
            }
            return;
        }
    } catch (e) {
        // If storage fails, allow access
    }
    restartGame(true);
    document.getElementById('check-btn').addEventListener('click', checkOrder);
    const victoryRestart = document.getElementById('victory-restart');
    if (victoryRestart) {
        victoryRestart.addEventListener('click', () => restartGame(true));
    }
});
