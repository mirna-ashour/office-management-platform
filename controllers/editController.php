<?php 

//add user page 
$errors = array();
$errors= [];
$success = false;

if(isset($_POST['add']))
{
    $username = $_POST['username'];
    $name=$_POST['name'];
    $password = $_POST['password'];
    $conPassword = $_POST['conPassword'];

    if(empty($username))
	{
		$errors['username'] = "Username required.";
    }
    if(empty($name))
	{
		$errors['name'] = "Name required.";
	}
	if(empty($password))
	{
		$errors['password'] = "Password required.";
	}
	if(empty($conPassword))
	{
		$errors['conPassword'] = "Password confirmation required.";
    }
    
    $results = $connect->query("SELECT * FROM accounts where username=".$username);
    //$result = $results->fetch_assoc();
    if($results->num_rows > 0)
    {
        $error['username']= 'Username already exists.';
    }

    if(count($errors)==0)
    {
        if($password == $conPassword)
        {
            $connect->query("INSERT INTO accounts (username, password) 
            VALUES ('".$username."', '".password_hash($password, PASSWORD_DEFAULT)."')");
            $ministryID=$connect->insert_id; 

            $connect->query("INSERT INTO ministries (ministryID, ministryName) VALUES ('".$ministryID."', '".$name."')");

            $success = true;
        }
        else{
            $errors['password']= 'The passwords entered do not match.';
        }
    }
    
}

//edit user page
if(isset($_POST['change']))
{
    if(isset($_POST['name']))
    {
        $name= $_POST['name'];
        $connect->query("UPDATE ministries SET ministryName='".$name."' WHERE ministryID=".$_POST['ministryID']);
    }
    
    if(isset($_POST['username']))
    {
        $username= $_POST['username'];
        $connect->query("UPDATE accounts SET username='".$username."' WHERE ID=".$_POST['ministryID']);
    }
}

if(isset($_POST['delete']))
{
    $connect->query("DELETE FROM ministries WHERE ministryID=".$_POST['ministryID']);
}

//edit tags page
if(isset($_POST['addTag']))
{
    $tag = $_POST['tagName'];
    $connect->query("INSERT INTO tags (tagName) VALUES ('".$tag."')");
}












?>