<?php
// Let's get started with sql
echo "Verifying that this shit works";
$servername = "localhost";
$username = "juan-ap";
$password = "apache";
$database = 'simple_php';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
echo "we are checking";
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "connection success!";
$user = "test3";
$pass = "test3";
$sql = "SELECT * from Users WHERE username=\"" . $user . "\"";
echo "not ran the first query";
$result = mysqli_query($conn, $sql);
echo "<br>ran the first query";

$sql = "INSERT INTO Users (username, password) VALUES ('".$user."', '".$pass."')";
if (mysqli_num_rows($result) == 0) {
  mysqli_query($conn, $sql);
  echo "New record created successfully";
} else {
  echo "there was an error!";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>Welcome to the test site</h1>
</body>

</html>