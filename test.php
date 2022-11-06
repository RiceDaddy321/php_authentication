<?php
    session_start();

    /* Function */
    function doSomething($name, $address) {
        $name = "Jane Doe";
        echo "Hello " . $name . "\n";
    }

    // Class
    class Something {
        public $name;
        public function printName() {
            echo $name;
        }
    };

    // Variables
    $name = "John Doe";
    $name = 'John Doe';
    echo $name;

    $_SESSION["name"] = serialize($name);
    $display = true;
    // Using the class.
    $nameSomething = new Something();
    $nameSomething->name = "Jane Doe";
    echo $nameSomething->name;
    echo $nameSomething->printName();
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
    <?php
    if($display)
    {
        echo "display";
    }
    ?>
</body>
</html>

