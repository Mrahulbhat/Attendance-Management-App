<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/Home.png">
    <title>Login | Attendance Record</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap" rel="stylesheet">
    <style>
        /* Your CSS styles here */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background-image: url(images/123.png);
    background-size:cover;
    margin: 0;
    font-family: "Patua One", serif;
    letter-spacing: 1.2px;
    font-weight: 400;
    font-style: normal;
    color: white;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #0d865a;
    position: fixed;
    top: 0;
    height: 9vh;
    width: 100%;
}

li {
    margin-right: 10px;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    font-weight: 300;
    font-size: 24px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #253237;
}

.active {
    background-color: #04AA6D;
}

.heading {
    margin-top: 32vh;
    margin-left: 110px;
}

h1 {
    font-size: 67px;
    letter-spacing: 3px;
}

.button,
button {
    font-size: 19px;
    align-items: center;
    background-color: #253237;
    padding: 10px 35px;
    margin-left: 110px;
    border-radius: 15px;
    border: 3px solid #253237;
    color: white;
    margin-top: -20px;
    text-decoration: none;
    font-weight: bold;
    margin-bottom: 20px;
}

.button:hover,
button:hover {
    transition: 1ms;
    background-color: #08583a;
    border: 3px solid #04AA6D;
}

.loginform {
    margin-top: 170px;
    padding: 10px;
    border: 1px solid white;
    border-radius: 10px;
    background-color: #0d865a;
    line-height: 30px;
    margin-right: 460px;
    margin-left: 520px;
}

label{
    font-size: 20px;
    margin-left: 50px;
    margin-bottom: 8px;
}
input {
    margin-left: 50px;
    padding: 5px;
    width: 250px;
    margin-bottom: 12px;

}

h2 {
    text-align: center;
    font-size: 30px;
    margin-top: 10px;
    margin-bottom: 20px;
}
</style>
</head>
<body>
<ul>
  <li><a href="#home" style="float: inline-start;margin-left: 10px; ">Home</a></li>
  <li><a href="#contact" style="float: inline-start" >Contact</a></li>
  <li><a href="admin.php" style="float: inline-end; margin-right: 35px;">Admin</a></li>
</ul>
<style>
    span{
        color: red;
        font-size: 18px;
        text-align: center;
    }
</style>
<?php
session_start(); // Start the session

if($_SERVER['REQUEST_METHOD']=="POST"){
    $servername='localhost';
    $username='root';
    $spass='';
    $db_name='attendance';

    $conn=mysqli_connect($servername,$username,$spass,$db_name);

    if(!$conn) {
        die("Error". mysqli_connect_error());
    }

    $usn = $_POST['usn'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM users WHERE usn = ? AND `password` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $usn, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Set session variables
        $_SESSION['usn'] = $usn;
        $_SESSION['name'] = $row['name']; 

        header("Location: student.php");
        exit(); 
    } else {
        // Login failed
        echo "<script><span>'Incorrect ID or Password'</span></script>";
    }
}
?>

<div class="loginform">
    <form action="Login.php" method="post">
        <h2>Login</h2>
        <label for="usn">USN</label><br>
        <input type="text" name="usn" id="usn" placeholder="Enter USN"><br>
        <label for="password">Password</label><br>
        <input type="password" name="password" placeholder="Enter Password"><br><br>
        <button type="submit">Login</button>
    </form>
    <span></span>
</div>  

</body>
</html>
