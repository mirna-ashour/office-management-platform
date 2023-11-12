<?php 
    include_once 'header.php';
    include 'controllers/ministryController.php';
?>

<header> 
    <link href='stylesheets/form.css' rel='stylesheet' type='text/css'>
</header>

<div class = "row">
  <div class="col-md-3 col-12"></div>
    <div class= "col-md-6 col-12">
        <div class="card boxes">
            <div class="card-header add">
                <center><b>Add a decision</b></center>
            </div>
            <form method="post" action="addDecision.php" enctype="multipart/form-data">
                <div class="card-body form-add">
                <form class= "form" action="addDecision.php" method="post">
                    <?php if(count($errors)>0): ?>
                        <div class="form-group">
                            <center><label class="alert alert-danger col-12"><?php foreach( $errors as $error) {echo $error . "</br>"; }?></label></center>
                        </div>
                    <?php endif; ?>
                    <?php if($success == true): ?>
                        <div class="form-group">
                            <center><label class="alert alert-success col-12"><?php echo 'Decision was succesfully added.'; ?></label></center>
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="name">Task name: </label>
                        <input type="text" class="form-control" name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="descrip">Description:</label>
                        <textarea class="form-control" name="descrip" rows="5" placeholder="Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="ministries">Additional ministries:</label>
                        <select multiple="multiple" class="form-control" name="ministries[]">
                        <?php
                            $ministries = $connect->query("SELECT * from ministries");
                            foreach($ministries as $ministry)
                            {
                            echo "<option value=\"" .$ministry['ministryID']. "\">" .$ministry['ministryName']. "</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tags">Tag(s):</label>
                        <select multiple="multiple" class="form-control" name="tags[]">
                        <?php
                            $tags = $connect->query("SELECT * from tags");
                            foreach($tags as $tag)
                            {
                            echo "<option value=\"" .$tag['tagID']. "\">" .$tag['tagName']. "</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="attach">Attachment: </label>
                        <input type="file" class="form-control-file" name="attach">
                    </div><br>
                    <div class="form-group" col-12>
                        <button type="submit" name="add" class="btn submit">Add</button>
                    </div>
                </form>
                </div>
            </form>
        </div><br>
    </div>
    <div class="col-md-3 col-12"></div>
</div>

<?php 
    include 'footer.php';
?>