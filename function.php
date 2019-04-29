<?php
function redirectTo($url)
{
	$host = $_SERVER['HTTP_HOST'];
	$currentFile = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	header("Location: http://$host/$currentFile/$url");
}

function connect() {
  $bdd = new PDO('mysql:host=localhost;dbname=projet', 'root', '');
       return $bdd;
}



function connection()
{
    $db = mysqli_connect("127.0.0.1", "root", "", "projet");

    if (!$db) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    else
    {
        // echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
    }
    return $db;
}

 ?>
