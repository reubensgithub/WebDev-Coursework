<?php
        session_start();
        include_once 'includes/connect.php';
        if (isset($_SESSION['username'])) {
                $_SESSION['loggedin'] = "true";
        }
?>
<!DOCTYPE html>
<html>

<head>
        <title> Homepage </title>
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
        color: #FFFFFF;
}

.bg{
    background-color: #c7c7c7;
    box-shadow: 5px 5px;
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

.login {
        background-color: #c7c7c7;
        color: black;
        text-align: center;
        height: 300px;
        width: 300px;
        box-shadow: 5px 5px;
        margin: auto;
}

</style>

<div class="navbar">
        <a class="active" name="home" href="/index.php">Home</a>
        <a class="right" name="tetris" href="/tetris.php">Play Tetris</a>
        <a class = "right" name="leaderboard" href="/leaderboard.php">Leaderboard</a>
</div>
</head>

<body>
<?php
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confpassword = $_POST['confpassword'];
        $dispscores = $_POST['dispscores'];

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        if ($confpassword != $password) {  // if password and confpassword don't match
                header ("Location: register.php");
                echo "Passwords do not match.";
                exit();
        }
        if (isset($username)) {
                if ($dispscores == NULL) {
                        header ("Location: register.php"); // checks if the user has inputted a display option.
                        echo "Display input required.";
                        exit();
                }
        }

        if($connect->connect_error){
                die("Connection unsuccessful:" .$connect->connect_error);
        }
        else{
                $query = $connect->prepare("INSERT into Users(UserName, FirstName, LastName, Password, Display) VALUES (?, ?, ?, ?, ?)");
                $query->bind_param("ssssi", $username, $fname, $lname, $password, $dispscores);
                $query->execute();
                $query->close();
        }
?>

<div class="main bg">
        <?php
                if ($_SESSION['loggedin'] == "true") {
        ?>
        <h1> Welcome to Tetris </h1>
        <a href="/tetris.php" target="_parent"><button>Click here to play</button></a>
        <?php } else if(!isset($_SESSION['loggedin'])) {
        ?>
        <p> Have an account? Log in below: </p>
        <div class="login">
                <form method="POST">
                        <label for="loginusername">Username:</label><br>
                        <input type="text" id="loginusername" placeholder="username"name="loginusername"><br>
                        <label for="loginpassword">Password:</label><br>
                        <input type="password" id="loginpassword" name="loginpassword"><br>
                        <input type="submit" value="Submit">
                </form>
        </div>
        <p> Don't have an account? <a href="/register.php">Register now</a></p>
        <?php } ?>
        <?php
        if (isset($_POST['loginusername']) && isset($_POST['loginpassword'])) {
                $loginusername = $_POST['loginusername'];
                $loginpassword = $_POST['loginpassword'];
                if (empty($loginusername)) {
                        echo "Enter a username. ";
                }
                else if (empty($loginpassword)) {
                        echo "Enter a password. ";
                }
                $passcheck = "SELECT * FROM Users WHERE UserName='$loginusername' AND Password='$loginpassword'";
                $result = $connect->query($passcheck);
                
                $row = $result->fetch_assoc();
                if($row['UserName'] === $loginusername && $row['Password'] === $loginpassword) {
                        $_SESSION['username'] = $row['UserName'];
                        header("Location: index.php");
                        session_write_close();
                        exit();
                }
        }
        ?>
</div>
</body>
</html>