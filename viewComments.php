<?php 
    include_once 'header.php';
    include 'controllers/ministryController.php';
?>

<style>
  .delete {
      float:right;
  }

  .user {
      color: #9f130f;
      font-size: 105%;
      font-weight: bold;
  }
  
  .heading {
      font-weight: bold;
  }

  .submit {
     //float:right;
  }
  
  .comment-box{
    background-color;
    border-radius: 20px;
  }

</style>

<div class="row">   
  <div class= "col-12 col-md-1"></div>
  <div class= "col-12 col-md-10">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
            <th>Decision Name</th>
            <th>Description</th>
            <th>Status</th>
            <th>Tags</th>
            <th>Start date</th>
            <th>End date</th>
            <th>Attachment</th>
        </tr>
      </thead>
        <tbody>
            <?php
                $table = $connect->query("SELECT decisions.*, d2m.*, ministries.* from d2m join ministries on d2m.ministryID=ministries.ministryID 
                join decisions on decisions.decisionID=d2m.decisionID where d2m.decisionID=".$_GET['decisionID']);
                $display = $table->fetch_assoc();
            ?>
            <tr>
                <td><?php echo $display['decisionName']; ?></td>
                <td><?php echo $display['decisionContent'];?></td>
                <td>
                    <?php 
                        switch($display['status']){
                            case 0:
                                echo 'Pending';
                            break;
                            case 1:
                                echo 'Completed';
                            break;
                            case 2:
                                echo 'Cancelled';
                            break;
                        }
                    ?>
                </td>
                <td>
                    <?php 
                        $tags = $connect->query("SELECT decisions.decisionID, d2t.*, tags.* from d2t join tags on d2t.tagID=tags.tagID 
                        join decisions on decisions.decisionID=d2t.decisionID where d2t.decisionID=".$display['decisionID']);
                        if($tags->num_rows > 0){
                            foreach($tags as $tag)
                            {
                                echo $tag['tagName'] . " ";
                            } 
                        }
                        else{
                            echo "-";
                        }  
                    ?>
                </td>
                <td><?php echo substr($display['dateStart'], 0, 10);?></td>
                <td><?php if($display['dateEnd'] != NULL) {echo $display['dateEnd'];} else {echo "-";}?></td>
                <td>
                    <?php 
                        if($display['pdfAttach']!=NULL)
                        {
                            echo "<i class=\"fas fa-file-alt\"></i>". " ";
                            echo '<a download href="files/' .$display['pdfAttach'] . '" >' . substr($display['pdfAttach'], 20) . '</a>'; 
                        }
                        else{
                            echo 'No attachment.';
                        }
                    
                    ?>
                </td>
            </tr>
        </tbody>   
    </table>  
  </div>
  <div class= "col-12 col-md-1"></div>
</div><br>
<div class="row">
  <div class="col-12 col-md-1"></div>
  <div class="col-12 col-md-10 comment-box"><br>
    <h5 class ="heading">Comments:</h5><br>
    <form method="post" action="viewComments.php?decisionID=<?php echo $_GET['decisionID']; ?>" enctype="multipart/form-data">
        <?php if(count($errorsC)>0): ?>
            <div class="form-group">
                <center><label class="alert alert-danger col-12"><?php foreach( $errorsC as $error) {echo $error; }?></label></center>
            </div>
        <?php endif; ?>
        <?php if($successC == true): ?>
            <div class="form-group">
                <center><label class="alert alert-success col-12"><?php echo 'Comment was succesfully posted.'; ?></label></center>
            </div>
        <?php endif; ?>
        
        <div class="form-group">
            <textarea class="form-control" name="comment" rows="4" placeholder="Comment"></textarea>
        </div>
        <div class="form-group">
            <input type="file" class="form-control-file upload" name="file"></input>
        </div>
        <div class="form-group">
            <button class="btn btn-success submit" name="submit">Post</button>
        </div>
    <table class="table com">
      <tbody>
        <?php
            $comments = $connect->query("SELECT * FROM comments WHERE decisionID=".$_GET['decisionID']);
            foreach($comments as $comment):
        ?>
        <tr>
            <td>
              <?php 
                echo "<span class=\"user\">". $comment['user'] . "</span>" . "   [" . $comment['date'] ."]". "</br></br>"; 
                echo $comment['commentContent'];
                echo "<input type=\"hidden\" name=\"commentID\" value=\"" . $comment['commentID'] ."\"></input>";
                if($comment['pdfAttach']!=NULL)
                {
                    echo '</br></br>';
                    echo "<i class=\"fas fa-file-alt\"></i>". " ";
                    echo '<a download href="files/' . $comment['pdfAttach'] . '" >' . substr($comment['pdfAttach'], 20) . '</a>'; 
                }
              ?>
            </td>
            <td>
              <?php if($comment['user']!= "Admin" || $_SESSION["access"]==1): ?>
                <button class="btn btn-danger delete" name="delete" >Delete</button>
              <?php endif; ?>
            </td> 
        </tr>
        <?php endforeach; ?>
     </form>
    </table><br><br>
  </div>
  <div class="col-12 col-md-1"></div>
</div>


<?php 
    include 'footer.php';
?>