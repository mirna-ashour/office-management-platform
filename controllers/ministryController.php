<?php 

    $success = false;
    $errors = array();
    $errors= [];

    if(isset($_POST['add']))
    {
        $decName = $_POST['name'];
        $descrip = $_POST['descrip'];

        //validation
        if(empty($decName))
        {
            $errors['name'] = "Decision name required.";
        }
        if(empty($descrip))
        {
            $errors['descrip'] = "Description required.";
        }
        if(empty($_POST['ministries']))
        {
            $errors['select1'] = "Ministries required.";
        }
        if(empty($_POST['tags']))
        {
            $errors['select2'] = "Tag(s) required.";
        }
       
        $name="";
        if(isset($_FILES['attach']))
        {
            $targetDir = "C:/xampp/htdocs/files/";
            $dateTime= date("Y-m-d-H-i-s",strtotime("now"));

            $name= $dateTime . "_" . basename($_FILES['attach']['name']); 
            $targetPath = $targetDir . $name;   
            if(move_uploaded_file($_FILES['attach']['tmp_name'], $targetPath)) {  
                $success = true;  
            } else{  
                $errors['file']= "File not uploaded, please try again.";  
            }  
        }

        //if all data is complete
        if(count($errors)==0)
        {
           
            //insert to the DB your task
            $connect->query("INSERT INTO decisions (decisionName, decisionContent) VALUES ('".$decName."', '".$descrip."')");
            $ID=$connect->insert_id; 
            
            foreach ($_POST['ministries'] as $names=>$num)
            {
                $connect->query("INSERT INTO d2m (ministryID, decisionID) VALUES ('".$num."', '".$ID."')");
            }
    
            foreach ($_POST['tags'] as $Atags=>$num)
            {
                $connect->query("INSERT INTO d2t (tagID, decisionID) VALUES ('".$num."', '".$ID."')");
            }

            //link the file to the decision
            if(isset($_FILES['attach']))
            {
                $connect->query("UPDATE decisions set pdfAttach='".$name."' where decisionID=".$ID);
            }
        }
    }
    
    $errorsC =array();
    $errorsC= [];
    $successC =false;

    if(isset($_POST['submit']))
    {
        $comment = $_POST['comment'];

         if(empty($comment))
         {
            $errorsC['comment']='Comment required.';
         }

         $name="";
         if(isset($_FILES['file']))
         {
             $targetDir = "C:/xampp/htdocs/files/";
             $dateTime= date("Y-m-d-H-i-s",strtotime("now"));

             $name= $dateTime . "_" . basename($_FILES['file']['name']);
             $targetPath = $targetDir . $name;   
             if(move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {   
                 $successC=true;
             } else{  
                 $errorsC['file']= "File not uploaded, please try again.";  
             }  
         }

         if(count($errorsC)==0)
         {
            $user;

            if($_SESSION["access"]== 1)
            {
                $user = "Admin";
            }
            else{

                $name = $connect->query("SELECT ministryName FROM ministries WHERE ministryID=".$_SESSION["userID"]);
                $user = $name->fetch_assoc();
            }
            
            $connect->query("INSERT INTO comments (user, commentContent, decisionID) 
            VALUES ('".$user."', '".$comment."', '".$_GET['decisionID']."')");
            $commentID=$connect->insert_id; 

            if(isset($_FILES['file']))
            {
                $connect->query("UPDATE comments SET pdfAttach='".$name."' WHERE commentID=".$commentID);
            }

         }
    }

    if(isset($_POST['delete']))
    {

        try{
            $target=$connect->query("SELECT pdfAttach From comments WHere commentID=".$_POST['commentID']);
            $target=$target->fetch_assoc();
            $path='files/' . $target['pdfAttach'];
            unlink($path);
            $connect->query("DELETE FROM comments WHERE commentID=".$_POST['commentID']);
        }
        catch(exception $e)
        {

        }
       
    }
?>