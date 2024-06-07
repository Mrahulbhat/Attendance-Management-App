<?php
  $connection = mysqli_connect("localhost", "root", "", "attendance");
  if (mysqli_connect_error()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['subject']) && isset($_POST['status'])) {
      $subject = $_POST['subject'];
      $status = $_POST['status'];

      // Loop through each student and insert attendance into database
      $sql = "SELECT `usn` FROM students";
      $result = mysqli_query($connection, $sql);

      if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $usn = $row['usn'];
          // Insert attendance into database
          $sql_insert = "INSERT INTO attendance(usn, subject, status) VALUES ('$usn', '$subject', '$status')";
          mysqli_query($connection, $sql_insert);
        }
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="icon" href="images/Home.png">
    
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
<body>
    
<ul>
    <li><a href="index.html" style="float:inline-start;">Home</a></li>
    <li><a href="#news" style="float:inline-start;">News</a></li>
    <li><a href="#contact" style="float:inline-start;">Contact</a></li>
    <li><a href="#about" style="float:inline-start;">About</a></li>
    <li><a href="index.html" style="float:inline-end; border-radius:10px;margin-right:10px;">Logout</a></li>
</ul>

<h1 style="margin-top: 80px; text-align: center;">Attendance Dashboard</h1>

<div class="updateform">
  <form action="admin.php" method="post">
    <select name="subject" id="subject">
      <option value="atc">ATC</option>
      <option value="dbms">DBMS</option>
      <option value="pai">PAI</option>
      <option value="cn">CN</option>
      <option value="rmi">RMI</option>
      <option value="evs">EVS</option>
      <option value="ajs">AJS</option>
      <option value="dbms_lab">DBMS LAB</option>
    </select>
    <table border="1">
      <tr>
        <th>USN</th>
        <th>NAME</th>
        <th>Attendance</th>
      </tr>
      <?php
        // Retrieve attendance data from the database for the selected subject
        if(isset($_POST['subject'])){
          $subject = $_POST['subject'];
          $sql = "SELECT `usn`, `name` FROM students";
          $result = mysqli_query($connection, $sql);

          if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>".$row['usn']."</td>";
              echo "<td>".$row['name']."</td>";
              echo "<td>";
              echo "<select name='status'>";
              echo "<option value='present'>Present</option>";
              echo "<option value='absent'>Absent</option>";
              echo "</select>";
              echo "</td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='3'>No data available</td></tr>";
          }
        }
      ?>
    </table>
    <input type="submit" value="Submit Attendance">
  </form>
</div>
</body>
</html>
