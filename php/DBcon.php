<?php

    function printError(string $err){
        echo "<h1>The following error occured</h1>
        <p>{$err}</p>"; // prints the error message
    }

    $dbhandler = null; // makes the variable exist so it can be used globally

    try{
        $dbhandler = new PDO("mysql:host=mysql;dbname=Morningstar;charset=utf8", "root", "qwerty"); // Connect to the database
    }catch(Exception $ex){
        printError($ex); // Catch any error and prints it
    }

    if($dbhandler){ // If the connection to the database is successful
        try{
        $stmt = $dbhandler->prepare("SELECT * FROM `employee`"); // prepare the query
        $stmt->execute(); // execute the query
    }catch(Exception $ex){
            printError($ex); // Catch any error and prints it
        }
    }
?>