<?php
        session_start();
        include_once 'includes/connect.php';
        if (isset($_SESSION["username"])){
?>
<!DOCTYPE html>
<head>
<title> Leaderboard </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
        margin: 0;
        font-family: Arial;
        font-weight: bold;
        color: white;
}

.main {
        background-image: url("images/tetris.png");
        background-position: center;
        background-size: 95%;
        background-attachment: fixed;
        background-repeat: no-repeat;
        text-align: center;
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

.leaderboard {
        color: black;
        margin-left: auto;
        margin-right: auto;
        background-color: #c7c7c7;
        box-shadow: 5px 5px;
        border: 1px solid black;
        border-spacing: 2px;
        text-align: center;
        padding: 10px;
}

.table_headers {
        color: white;
        background-color: blue;
}

table td {
        color: black;
}
</style>

<div class="navbar">
        <a name="home" href="/index.php">Home</a>
        <a class="right" name="tetris" href="/tetris.php">Play Tetris</a>
        <a class = "active right" name="leaderboard" href="/leaderboard.php">Leaderboard</a>
</div>
</head>
<body>
<div class="main">
        <table class="leaderboard">
                <tr class="table_headers">
                        <th> Username </th>
                        <th> Score </th>
                </tr>
                <tr>
                        <td>test_data</td>
                        <td>0</td>
                </tr>
                <tr>
                        <td>test_data1</td>
                        <td>1</td>
                </tr>
                <tr>
                        <td>test_data2</td>
                        <td>2</td>
                </tr>
                <tr>
                        <td>test_data3</td>
                        <td>3</td>
                </tr>
                <tr>
                        <td>test_data4</td>
                        <td>4</td>
                </tr>
                <tr>
                        <td>test_data5</td>
                        <td>5</td>
                </tr>
                <tr>
                        <td>test_data6</td>
                        <td>6</td>
                </tr>
                <tr>
                        <td>test_data7</td>
                        <td>7</td>
                </tr>
        <?php
                $currentuser = $_SESSION["username"];
                $score = $_POST['score'];
                $display = "SELECT Display FROM Users WHERE UserName='$currentuser'";
                $result = $connect->query($display);
                $row = $result->fetch_assoc();
                if ($row['Display'] === 1) { // display scores
                        if($connect->connect_error){
                                die("Connection unsuccessful:" .$connect->connect_error);
                        }
                        else{
                                $query = $connect->prepare("INSERT INTO Scores (Username, Score) VALUES (?, ?)");
                                $query->bind_param("si", $currentuser, $score);
                                $query->execute();
                                $query->close();
                        }
                }
        ?>
</div>
</body>
</html>
<?php
} else {
        header("Location: index.php");
        session_write_close();
        exit();
} ?>