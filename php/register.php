<?php
    include "DBcon.php"; //Connection to database

    $error = array(); //Array to hold errors

    function form(){

        // Use globals to access outside variables
        global $dbhandler;
        global $error;  

        // Get data from the form and sanitize it
        $employee = filter_input(INPUT_POST, "employee", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $passwordd = filter_input(INPUT_POST, "passwordd", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // checks for errors and if so then add them to $error array
        if(empty($employee)){
            $error[] = "please add a employee id";
        }
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
        if(!empty($error)){
        foreach($error as $errors){
            echo "<div>$errors</div>"; //prints each error in a div
            }
        }else{
            if($dbhandler) {
            try {
                $stmt = $dbhandler ->prepare("INSERT INTO employee (`employee_id`, `firstName`, `lastName`, `username`, `passwordd`)
            VALUES (:employee, :firstname, :lastname, :username, :passwordd)"); // prepare the que
            
                $stmt->bindParam(":employee", $employee, PDO::PARAM_STR);
                $stmt->bindParam(":firstname", $firstname, PDO::PARAM_STR);
                $stmt->bindParam(":lastname", $lastname, PDO::PARAM_STR);
                $stmt->bindParam(":username", $username, PDO::PARAM_STR);
                $stmt->bindParam(":passwordd", $passwordd, PDO::PARAM_STR); // binds the self made variables to the prepared statement (columns in database)

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
    <link rel="stylesheet" href="register.css">
</head>
<body> 

    <h1>Register Page</h1>

    <form action="register.php" method="POST">
        <div class="reg">
            <div>
                <label for="employee">Employee</label>
                <input type="text" id="employee" name="employee">
            </div>  
            <div>
                <label for="firstname">First name</label>
                <input type="text" id="firstname" name="firstname">
            </div>
            <div>
                <label for="lastname">Last name</label>
                <input type="text" id="lastname" name="lastname">
            </div>  
            <div>
                <label for="username">Username</label>
                <input type="text" id="username" name="username">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="passwordd">
            </div>
            <div>
                <input type="submit" value="Add User">
            </div>
            <div>
                <button><a href="morningstarWebsite.php" class="back">Back to Morningstar website</a></button>
            </div>
        </div>
    </form>
    
</body>
</html>