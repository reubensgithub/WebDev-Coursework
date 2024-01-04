<?php
        session_start();
        include_once 'includes/connect.php';
?>

<!DOCTYPE html>
<html>
<head>
<title> Register </title>
<style>
.register{
        background-color: #c7c7c7;
        box-shadow: 5px 5px;
}
.center{
        margin: auto;
        position: center;
        text-align: center;
        width: 500px;
}

</style>
</head>
<body>
<div class="register center">
    <form action="index.php" method="POST">
        <label for="fname">First name:</label><br>
        <input type="text" id="fname" name="fname"><br>
        <label for="lname">Last name:</label><br>
        <input type="text" id="lname" name="lname"><br><br>
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" placeholder="Username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" placeholder="Password"name="password"><br>
        <label for="confpassword">Confirm Password:</label><br>
        <input type="password" id="confpassword" placeholder="Confirm Password"name="confpassword"><br>
        <p>Display Scores on leaderboard?:</p>
        <input type="radio" id="yes" name="dispscores" value="yes">
        <label for="yes">Yes</label><br>
        <input type="radio" id="no" name="dispscores" value="no">
        <label for="no">No</label><br><br>
        <button type="submit" name="submit"> Submit </button>
    </form>
</div>
</body>
</html>