<!-- This is the main login page -->
<?php
    session_start();
    //starting the sql server
    $servername = "localhost";
$username = "juan-ap";
$password = "apache";
$database = 'simple_php';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
    
    //define the defaults
    $errorDisplay = false;
    $ErrorTxt = "";

    // handles which form to use
    if(array_key_exists('login', $_POST)) {
        login($conn);
    }
    else if(array_key_exists('register', $_POST)) {
        
        register($conn);
    }
    function redirect($url) {
        header('Location: ' . $url);
    }
    //pass the file
    function register($conn) {
        global $errorDisplay, $ErrorTxt;
        $errorDisplay = true;
        $user = $password = "";
        
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = $_POST["newUser"];
            $password = $_POST["newPassword"];
            $sql = "SELECT * from Users WHERE username=\"" . $user . "\"";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0) {
                $ErrorTxt = "You cannot use that username!";
            }
            else {
                $data[$user] = $password;
                $sql = "INSERT INTO Users (username, password) VALUES ('".$user."', '".$password."')";
                mysqli_query($conn, $sql);
                $ErrorTxt = "your account has been made successfully!";
                $errorDisplay = false;
            }
        }
    }

    function login($conn) {
        $user = $password = "";
        global $errorDisplay, $ErrorTxt;
        //only works when the server sends the form to itself
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = $_POST["user"];
            $password = $_POST["password"];
        
    
            // check that the login exists
            //check the password
            $sql = "SELECT * from Users WHERE username=\"" . $user . "\" AND password='".$password."'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0) {
                //if($password == $data[$user]) {
                    
                    $_SESSION["user"] = $user;
                    redirect("logged.php");
                //}
                
            }
            $ErrorTxt = "Your supplied information is incorrect!";
            $errorDisplay = true;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h1>Please login using the form below</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="text" name="user" id="user-text" placeholder="Username" >
        <input type="password" name="password" id="password-text" placeholder="password">
        <input type="submit" name="login" value="Login">
    </form>
    <?php if($errorDisplay) { ?>
        <div class="error">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input type="text" name="newUser" id="user-text" placeholder="Username" >
                <input type="password" name="newPassword" id="password-text" placeholder="password">
                <input type="submit" name="register" value="Register">
            </form>
        </div>
        <?php } ?>
        <span class="error" ><?php echo $ErrorTxt; ?></span>
</body>
</html>