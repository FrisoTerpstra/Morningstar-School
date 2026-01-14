<?php
    include "DBcon.php"; //Connection to database

    $error = array(); //Array to hold errors

    function form(){

        // Use globals to access outside variables
        global $dbhandler;
        global $error;  

        // Get data from the form and sanitize it
        $firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $passwordd = filter_input(INPUT_POST, "passwordd", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // checks for errors and if so then add them to $error array
        if(empty($firstname)){
            $error[] = "please add a first name";
        }
        if(empty($lastname)){
            $error[] = "please add a last name";
        }
        if(empty($username)){
            $error[] = "please add a username";
        }
        if(empty($passwordd)){
            $error[] = "please add a password";
        }
        // check if username already exists
        if(!empty($username)){
            if($dbhandler) {
                try{
                    $chk = $dbhandler->prepare("SELECT 1 FROM employee WHERE username = :username LIMIT 1");
                    $chk->bindParam(":username", $username, PDO::PARAM_STR);
                    $chk->execute();
                    if ($chk->fetch()) {
                        $error[] = "Username already taken";
                            }
                    $chk->closeCursor();
            }catch(Exception $ex){
                printError($ex);
                }
            }
        }
        // Only insert if there are NO errors
        if(empty($error)){
            if($dbhandler) {
                try {
                    $stmt = $dbhandler->prepare("INSERT INTO employee (`firstName`, `lastName`, `username`, `passwordd`)
                    VALUES (:firstname, :lastname, :username, :passwordd)"); // prepare the query
                
                    $stmt->bindParam(":firstname", $firstname, PDO::PARAM_STR);
                    $stmt->bindParam(":lastname", $lastname, PDO::PARAM_STR);
                    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
                    $stmt->bindParam(":passwordd", $passwordd, PDO::PARAM_STR); // bind the password

                $stmt->execute(); // executes the query
                $stmt->closeCursor(); // close the connection to the database

                header("Location: Login.php"); // redirect to login page
                exit(); // exit to make sure no code is run after the redirect
                
            }catch(Exception $ex){
            printError($ex);    //catch any errors and print them using the printError function
                }
            }
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        form(); //call the form function when the form is submitted
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register page</title>
    <link rel="stylesheet" href="../css/register.css">
</head>
<body> 

    <form action="register.php" method="POST">
        <div class="reg">
            <?php 
            if(!empty($error)){
                foreach($error as $errors){
                    echo "<div class='error'>$errors</div>";
                }
            }
            ?>
            
            <div>
                <label for="firstname">First name</label>
                <input type="text" id="firstname" name="firstname" placeholder="John">
            </div>
            <div>
                <label for="lastname">Last name</label>
                <input type="text" id="lastname" name="lastname" placeholder="Stamos">
            </div>  
            <div>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="john123">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="passwordd" placeholder="goodpassword">
            </div>
            <div>
                <input type="submit" value="Add User">
            </div>
            <div>
                <a href="morningstarWebsite.php" class="back" >Back to Morningstar website</a>
            </div>
        </div>
    </form>
    
</body>
</html>