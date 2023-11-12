<?php 
    include_once 'header.php';
?>

<style>
    .title {
        font-weight: bold;
        //text-align: center;
        color: #4c5657;
        padding: 1%;
    }

    .bg{
        background-color: #c3b8a5;
    }
    .new {
        background-color: #9f130f;
        color: white;
        float: right;
    }

    .new:hover{
        background-color: #9ba0ab;
    }

    .link{
        color: #907f61;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="col-12 bg">
            <h4 class= "title">
                <?php 
                    $name = $connect->query("SELECT ministryName from ministries WHERE ministryID = ".$_GET['ministryID']); 
                    $ministry = $name->fetch_assoc();
                    echo $ministry['ministryName'];
                ?>
            </h4>
        </div>
        <?php if($_SESSION["access"]==1):?>
            <a href="addDecision.php?ministryID=<?php echo $_GET['ministryID'];?>"class="btn new" type="submit" name="new">Add decision</a><br>
        <?php endif; ?>
        <table class="table table-striped table-bordered nowrap" id='example'>
            <thead>
                <tr>
                    <th>Decision Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Tags</th>
                    <th>Start date</th>
                    <th>Attachment</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $table = $connect->query("SELECT decisions.*, d2m.*, ministries.* from d2m join ministries on d2m.ministryID=ministries.ministryID 
                    join decisions on decisions.decisionID=d2m.decisionID where d2m.ministryID=".$_GET['ministryID']);
                    foreach($table as $decision):
                ?>
                <tr>
                    <td><a class = "link" href ="viewComments.php?decisionID=<?php echo $decision['decisionID'];?>"><?php echo $decision['decisionName'];?></a></td>
                    <td><?php echo $decision['decisionContent'];?></td>
                    <td>
                        <?php 
                            switch($decision['status']){
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
                            join decisions on decisions.decisionID=d2t.decisionID where d2t.decisionID=".$decision['decisionID']);
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
                    <td><?php echo substr($decision['dateStart'], 0, 10);?></td>
                    <td>
                        <?php 
                         if($decision['pdfAttach']!=NULL)
                         {
                             echo '</br></br>';
                             echo "<i class=\"fas fa-file-alt\"></i>". " ";
                             echo '<a download href="files/' .$decision['pdfAttach'] . '" >' . substr($decision['pdfAttach'], 20) . '</a>'; 
                         }
                         else{
                             echo 'No attachment.';
                         }
                        
                        ?>
                    </td>
                </tr>
                    <?php endforeach; ?>
            </tbody>   
        </table><br>
    </div> 
</div>

<?php 
    include 'footer.php';
?>