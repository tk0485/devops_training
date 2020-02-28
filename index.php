<html>
<head>
    <title>Book List</title>
</head>
<body>
<?php
$servername = "173.18.0.2";
$username = "rootuser";
$password = "password";
$database = "test_db";
// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS " . $database;
if ($conn->query($sql) === FALSE) {
    echo "Error creating database: " . $conn->error;
}

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "<br>");
}

//Create Table
$sql = "CREATE TABLE IF NOT EXISTS Books (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50) NOT NULL,
author VARCHAR(50) NOT NULL,
dop date,
description VARCHAR(200) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === FALSE) {
    echo "Error creating table: " . $conn->error . "<br>";
}

if (isset($_POST['name'])) {
   //Insert Book Entry
   $sql = "INSERT INTO Books (name, author, dop, description)
   VALUES ('$_POST[name]', '$_POST[author]', '$_POST[dop]', '$_POST[description]')";
   if ($conn->query($sql) === FALSE) {
       echo "Error: " . $sql . "<br>" . $conn->error;
   } else {
       echo "Book " . $_POST['name'] . " added successfully<br><br>";
   }
}
$sql = "SELECT id, name, author, dop, description, reg_date FROM Books ORDER BY name, author, reg_date ASC";
$result = $conn->query($sql);
?>
</body>
<table border="1">
<?php
echo "<tr><td>ID</td><td>Name</td><td>Author</td><td>Date of Publish</td><td>Description</td></tr>";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["author"]."</td><td>".$row["dop"]."</td><td>".$row["description"]."</td></tr>";
    }
} else {
    echo "0 results found<br>";
}
?>
</table>
<br>
<a href="http://<IP>:83/add.html">Add New Book</a>
</html>
