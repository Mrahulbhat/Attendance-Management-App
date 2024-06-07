<?php
session_start(); 

if(!isset($_SESSION['usn'])) {
    header("Location: Login.php");
    exit(); 
}

// Establish database connection
$connection = mysqli_connect("localhost", "root", "", "attendance");

// Check connection
if (mysqli_connect_error()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Retrieve the session variable
$usn = $_SESSION['usn'];

// Query to retrieve the count of attendance records for 'atc' subject
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $sql = "SELECT COUNT(*) AS attendance_count FROM attendance WHERE subject = 'atc' AND usn = '$usn'";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $attendanceCount_atc = $row['attendance_count'];
    } else {
        echo "Error executing query: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Student Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/Home.png">
</head>
<body>
  <style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #04AA6D;
  position: fixed;
  top: 0;
  height: 8vh;
  width: 100%;
}


li a {
  display: block;
  color: white;
  text-align: center;
  font-size: 20px;
  padding: 14px 34px;
  text-decoration: none;
}

li a:hover{
  background-color: #111;
  transition: 0.3s;
}


* {box-sizing: border-box}
body {font-family: "Lato", sans-serif;}

/* Style the tab */

body {margin:0;}


.tab {
  margin-top: 8vh;;
  float: left;
  background-color: #f1f1f1;
  width: 120px;
  height: 300px;
}

/* Style the buttons inside the tab */
.tab button {
  display: block;
  background-color: #444;
  padding: 21.33px 16px;
  width: 100%;
  border:1px solid #253237;
  outline: none;
  color: white;
  text-align: left;
  cursor: pointer;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #04AA6D;
}

/* Create an active/current "tab button" class */
.tab button.active {
  background-color: #04AA6D;
}

/* Style the tab content */
.tabcontent {
  float: left;
  margin-top: 8vh;
  padding: 0px 12px;
  width: 91%;
  border-left: none;
  height: 92VH;
}

</style>
</head>

<ul>
  <li><a href="index.html"style="float:inline-start;">Home</a></li>
  <li><a href="#news"style="float:inline-start;">News</a></li>
  <li><a href="#contact"style="float:inline-start;">Contact</a></li>
  <li><a href="#about" style="float:inline-start;">About</a></li>
  <li><a href="index.html" style="float:inline-end; border-radius:10px;background-color:;margin-right:10px;">Logout</a></li>
</ul>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'overall')" id="defaultOpen">OVERALL</button>
  <button class="tablinks" onclick="openCity(event, 'atc')">ATC</button>
  <button class="tablinks" onclick="openCity(event, 'dbms')">DBMS</button>
  <button class="tablinks" onclick="openCity(event, 'cn')">CN</button>
  <button class="tablinks" onclick="openCity(event, 'pai')">PAI</button>
  <button class="tablinks" onclick="openCity(event, 'rmi')">RMI</button>
  <button class="tablinks" onclick="openCity(event, 'evs')">EVS</button>
  <button class="tablinks" onclick="openCity(event, 'ajs')">AJS LAB</button> 
   <button class="tablinks" onclick="openCity(event, 'dbms_lab')">DBMS LAB</button>


<style>
  h1{
    text-align: center;
  }
table {
  width: 60%;
  border: 2px solid black;
  text-align: center;
  border-collapse: collapse;
}
th{
  border: 1px solid black;
background-color: #04AA6D;
color: white;
font-weight: bold;
}
table, td ,tr{
  border: 1px solid black;
  text-align: center;

  margin-left: 250px;
}

th, td {
  padding: 12px 18px;
  
}

</style>
</div>
<?php
if($_SERVER['REQUEST_METHOD']=="POST")
    {            
        $sql = "SELECT COUNT(*) AS attendance_count FROM attendance WHERE subject = 'atc' AND usn = '$usn'";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $attendanceCount_atc = $row['attendance_count'];
        } else {
            echo "Error executing query: " . mysqli_error($connection);
        }
    }
    ?>

<div id="overall" class="tabcontent">
  <h1>Attendance Dashboard</h1>
  <table border=3>
    <tr>
      <th>SL.No</th>
      <th>Subject Name</th>
      <th>Total Classes</th>
      <th>Present</th>
      <th>Percentage</th>
    </tr>
    <tr>
      <td>1</td>
      <td>ATC</td>
      <td><?php echo isset($attendanceCount_atc) ? $attendanceCount_atc : ''; ?></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td>2</td>
      <td>DBMS</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td>3</td>
      <td>CN</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td>4</td>
      <td>PAI</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
    <td>5</td>
      <td>RMI</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td>6</td>
      <td>EVS</td>

      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
    <td>7</td>

      <td>AJS</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
    <td>8</td>

      <td>DBMS LAB</td>
      <td></td>
      <td></td>
      <td></td>
</tr>
    
  </table>

</div>












<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
   
</body>
</html> 
