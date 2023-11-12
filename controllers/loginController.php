<?php

    session_start();
    
    $errors = array();
    $errors= [];
    if ( isset( $_POST['login'] ) ) 
    {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $result = $connect->query("SELECT * FROM accounts where username='".$username."'");

    if($result->num_rows > 0)
        {
        $user = $result->fetch_assoc();
            if(password_verify($password, $user['password']))
            {
                $result = $connect->query("SELECT ID, access FROM accounts where username='".$username."'");
                $user = $result->fetch_assoc();
                $_SESSION["userID"] = $user['ID'];
                $_SESSION["access"] = $user['access'];
                if($_SESSION["access"] != 1)
                {
                    header('location: viewMinistry.php?ministryID='.$_SESSION["userID"]);
                    exit;
                }
                else{
                    header('location: home.php');
                    exit;
                }
            
            }
            else
            {
                $errors['error']='Invalid username or password.';
            }
        
        
        }
        else
        {
            $errors['error']='Invalid username or password.';
        }
        
    }

    if(isset($_POST['logout']))
    {
        $_SESSION['access'] = null;
        header('location: index.php');
    }
    
?>