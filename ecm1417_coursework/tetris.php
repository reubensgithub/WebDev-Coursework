<?php
        session_start();
        if (isset($_SESSION["username"])){ // un-comment once login works.
?>
<!DOCTYPE html>
<head>
<script type="text/javascript" src="tetris.js"></script>
<audio id="audio">
        <source src="tetris.mp3" type="audio/mp3">
</audio>
<title> Tetris </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
        margin: 0;
        font-family: Arial;
        font-weight: bold;
}

.main {
        background-image: url("images/tetris.png");
        background-position: center;
        background-size: 95%;
        background-attachment: fixed;
        background-repeat: no-repeat;
        text-align: center;
}

.button {
        background-color: #c7c7c7;
        border: none;
        color: black;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
}

.pause {
        background-color: red;
}

.resume {
        background-color: green;
}

.scorebox {
        background-color: #c7c7c7;
        position: absolute;
        text-align: center;
        left: 250px;
        bottom: 220px;
        font-size: 24px;
        width: 200px;
        height: 200px;

}

.grid {
        width: 300px;
        height: 600px;
        background-color: #c7c7c7;
        display: flex;
        flex-wrap: wrap;
}

.grid div {
        height: 30px;
        width: 30px;
}

.text {
        color: white;
}

#tetris-bg{
        height: 600px;
        width: 300px;
        position: relative;
        background-color: #c7c7c7;
        box-shadow: 5px 5px;
        left: 618px;
        background-image: url("images/tetris-grid-bg.png");
        background-size: initial;
        background-repeat: no-repeat;
}

.tetrisPieceZero {
        background-color: #78F72F;
}
.tetrisPieceOne {
        background-color: yellow;
}
.tetrisPieceTwo {
        background-color: blue;
}
.tetrisPieceThree {
        background-color: green;
}
.tetrisPieceFour {
        background-color: pink;
}
.tetrisPieceFive {
        background-color: purple;
}

.navbar {
        overflow: hidden;
        background-color: #007AFF;
}

.navbar a {
        float:left;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        margin: 0;
        font-family: Arial;
        font-weight: bold;
        font-size: 12px;
}

.navbar a:hover {
        background-color: #ddd;
        color: black;
}

.navbar a.active {
        background-color: #302929;
        color: white;
}

.navbar a.right {
        float:right;
}

</style>

<div class="navbar">
        <a name="home" href="/index.php">Home</a>
        <a class="active right" name="tetris" href="/tetris.php">Play Tetris</a>
        <a class = "right" name="leaderboard" href="/leaderboard.php">Leaderboard</a>
</div>
</head>
<body onload="genDivs();">
<div class="main">
        <p> Welcome to tetris </p>
        <div class="scorebox">Score: <span id="tetris_score"></span></div>
        <h1 class="text"><span id="end"></span></h1>
        <button class="button" onclick="playAudio();genPiece();automoveTimer=setInterval(automovePiece, 1000); style.display = 'none'">Start the game</button>
        <button class="button pause" onclick="clearInterval(automoveTimer);">Pause</button>
        <button class="button resume" onclick="genPiece();automoveTimer=setInterval(automovePiece, 1000);">Resume</button>
        <form action="leaderboard.php" method="POST">
                <label for="score">Submit score:</label>
                <input type="hidden" id="score" name="score" value=tetris_score>
                <input type="submit" value="Submit">
        </form>
        <div class="grid" id="tetris-bg">
        </div>
</div>
</body>
</html>
<?php
} else {
       header("Location: index.php");
       session_write_close();
       exit();
} ?>