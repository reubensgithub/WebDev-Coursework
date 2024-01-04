
const gridWidth = 10;
let grid = document.querySelector('.grid');
let gridCells;

const Lshape = [1, gridWidth + 1, gridWidth*2 + 1, 1+1]; // r shape (FIXED)
const Zshape = [1, gridWidth + 1, gridWidth*2 + 1, gridWidth*2]; // J shape
const Sshape = [1, gridWidth + 1, 1-1, gridWidth + 2]; // s shape (FIXED)
const Tshape = [1, gridWidth + 1, gridWidth, gridWidth + 2]; // t shape (FIXED)
const Oshape = [1, 1+1, gridWidth + 1, gridWidth + 2]; // O shape (FIXED)
const Ishape = [1, gridWidth + 1, gridWidth*2 + 1, gridWidth*3 + 1]; // I shape (FIXED)
const multiplesOfTen = [10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150, 160, 170, 180, 190, 200];
const multiplesOfTenMinusOne = [9, 29, 39, 49, 59, 69, 79, 89, 99, 109, 119, 129, 139, 149, 159, 169, 179, 189, 199];
const multiplesOfTenMinusTwo = [8, 28, 38, 48, 58, 68, 78, 88, 98, 108, 118, 128, 138, 148, 158, 168, 178, 188, 198];
const multiplesOfTenMinusThree = [7, 27, 37, 47, 57, 67, 77, 87, 97, 107, 117, 127, 137, 147, 157, 167, 177, 187, 197];
const multiplesOfTenMinusEight = [2, 21, 32, 42, 52, 62, 72, 82, 92, 102, 112, 122, 132, 142, 152, 162, 172, 182, 192];
const multiplesOfTenMinusNine = [1, 21, 31, 41, 51, 61, 71, 81, 91, 101, 111, 121, 131, 141, 151, 161, 171, 181, 191];

let score = 0;
let currentPos = 4;
const tetrisPieces = [Lshape,Zshape,Sshape,Tshape,Oshape,Ishape];
let randomNum = Math.floor(Math.random()*tetrisPieces.length);
let currentBlock = tetrisPieces[randomNum];

function genDivs() {
    const tetris_grid = document.getElementById("tetris-bg");

    for (let i = 0; i < 200; i++) {

        let innerDiv = document.createElement('div');
        tetris_grid.appendChild(innerDiv);
    }
    for (let i = 0; i < 10; i++) {
        let innerDiv = document.createElement('div');
        innerDiv.classList.add('taken');
        tetris_grid.appendChild(innerDiv);
    }
    gridCells = Array.from(document.querySelectorAll('.grid div'));
}

function genPiece() {
    if (currentBlock == tetrisPieces[0]) {
        currentBlock.forEach(cell => {
            gridCells[currentPos + cell].classList.add('tetrisPieceZero');
        });
    }
    if (currentBlock == tetrisPieces[1]) {
        currentBlock.forEach(cell => {
            gridCells[currentPos + cell].classList.add('tetrisPieceOne');
        });
    }
    if (currentBlock == tetrisPieces[2]) {
        currentBlock.forEach(cell => {
            gridCells[currentPos + cell].classList.add('tetrisPieceTwo');
        });
    }
    if (currentBlock == tetrisPieces[3]) {
        currentBlock.forEach(cell => {
            gridCells[currentPos + cell].classList.add('tetrisPieceThree');
        });
    }
    if (currentBlock == tetrisPieces[4]) {
        currentBlock.forEach(cell => {
            gridCells[currentPos + cell].classList.add('tetrisPieceFour');
        });
    }
    if (currentBlock == tetrisPieces[5]) {
        currentBlock.forEach(cell => {
            gridCells[currentPos + cell].classList.add('tetrisPieceFive');
        });
    }
}

function deletePiece() {
    if (currentBlock == tetrisPieces[0]) {
        currentBlock.forEach(cell => {
            gridCells[currentPos + cell].classList.remove('tetrisPieceZero');
        });
    }
    if (currentBlock == tetrisPieces[1]) {
        currentBlock.forEach(cell => {
            gridCells[currentPos + cell].classList.remove('tetrisPieceOne');
        });
    }
    if (currentBlock == tetrisPieces[2]) {
        currentBlock.forEach(cell => {
            gridCells[currentPos + cell].classList.remove('tetrisPieceTwo');
        });
    }
    if (currentBlock == tetrisPieces[3]) {
        currentBlock.forEach(cell => {
            gridCells[currentPos + cell].classList.remove('tetrisPieceThree');
        });
    }
    if (currentBlock == tetrisPieces[4]) {
        currentBlock.forEach(cell => {
            gridCells[currentPos + cell].classList.remove('tetrisPieceFour');
        });
    }
    if (currentBlock == tetrisPieces[5]) {
        currentBlock.forEach(cell => {
            gridCells[currentPos + cell].classList.remove('tetrisPieceFive');
        });
    }
}

function automovePiece() {
    deletePiece();
    currentPos += gridWidth;
    genPiece();
    stopFalling();
    endGame();
}

function stopFalling() {
    if (currentBlock.some(cell => gridCells[currentPos + cell + gridWidth].classList.contains('taken'))) {
        currentBlock.forEach(cell => gridCells[currentPos + cell].classList.add('taken'))
        randomNum = Math.floor(Math.random()*tetrisPieces.length);
        currentBlock = tetrisPieces[randomNum];
        currentPos = 4;
        score += 1;
        genPiece();
        document.getElementById("tetris_score").innerHTML = score;
        occupied();
    }
}

function moveLeft() {
    let leftFunction = function(event) {
        if (event.code === 'ArrowLeft') {
            if (currentBlock == tetrisPieces[1] || currentBlock == tetrisPieces[2] || currentBlock == tetrisPieces[3]) {
                if (multiplesOfTen.includes(currentPos)) {
                    deletePiece();
                    genPiece();
                    stopFalling();
                    return;
                }
                else {
                    deletePiece();
                    currentPos -= 1;
                    genPiece();
                    stopFalling();
                    return;
                }
            }
            if (multiplesOfTenMinusOne.includes(currentPos)) {
                deletePiece();
                genPiece();
                stopFalling();
                return;
            }
            else {
                deletePiece();
                currentPos -= 1;
                genPiece();
                stopFalling();
                return;
            }
        }
    }
    document.addEventListener("keydown", leftFunction);
}

function moveRight() {
    let rightFunction = function(event) {
        if (event.code === 'ArrowRight') {
            if (currentBlock == tetrisPieces[0] || currentBlock == tetrisPieces[2] || 
                currentBlock == tetrisPieces[3] || currentBlock == tetrisPieces[4]) {
                if (multiplesOfTenMinusThree.includes(currentPos)) {
                    deletePiece();
                    genPiece();
                    stopFalling();
                    return;
                }
                else {
                    deletePiece();
                    currentPos += 1;
                    genPiece();
                    stopFalling();
                    return;
                }
            }
            if (multiplesOfTenMinusTwo.includes(currentPos)) {
                deletePiece();
                genPiece();
                stopFalling();
                return;
            }
            else {
                deletePiece();
                currentPos += 1;
                genPiece();
                stopFalling();
                return;
            }
        }
    }
    document.addEventListener("keydown", rightFunction);
}

function moveDown() {
    let downFunction = function(event) {
        if (event.code === 'ArrowDown') {
            deletePiece();
            currentPos += gridWidth;
            genPiece();
            stopFalling();
        }
    }
    document.addEventListener("keydown", downFunction);
}

function occupied() {
    let gridCells = Array.from(document.querySelectorAll('.grid div'));
    for (let i = 0; i < 200; i += gridWidth) {
        let gridRows = [i, i+1, i+2, i+3, i+4, i+5, i+6, i+7, i+8, i+9];

        if(gridRows.every(index => gridCells[index].classList.contains('taken'))) {
            score += 10;
            gridRows.forEach(index => {
                gridCells[index].classList.remove('taken');
                gridCells[index].classList.remove('tetrisPieceZero');
                gridCells[index].classList.remove('tetrisPieceOne');
                gridCells[index].classList.remove('tetrisPieceTwo');
                gridCells[index].classList.remove('tetrisPieceThree');
                gridCells[index].classList.remove('tetrisPieceFour');
                gridCells[index].classList.remove('tetrisPieceFive');

            })
            const squaresRemoved = gridCells.splice(i, gridWidth);
            gridCells = squaresRemoved.concat(gridCells);
            gridCells.forEach(cell => grid.appendChild(cell))
            }
    }
}

function playAudio() {
    let audio = document.getElementById("audio");
    audio.play();
}

function endGame() {
    if (currentBlock.some(index => gridCells[currentPos + index].classList.contains('taken'))) {
        let currentScore = document.getElementById("tetris_score");
        document.getElementById("tetris_score").innerHTML = currentScore;
        document.getElementById("end").innerHTML = "GAME OVER";
        document.removeEventListener("keydown", leftFunction);
        document.removeEventListener("keydown", rightFunction);
        document.removeEventListener("keydown", downFunction);
        clearInterval(automoveTimer);
    }
}

moveLeft();
moveRight();
moveDown();
automovePiece();
