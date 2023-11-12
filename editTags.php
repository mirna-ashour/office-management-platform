<?php 
    include_once 'header.php';
    include 'controllers/editController.php';      
?>

<header> 
    <link href='stylesheets/form.css' rel='stylesheet' type='text/css'>
</header>

<style>
    .form-tag{
        padding: 5%;
    }

    .tag{
        font-size: 105%;
    }
</style>

<div class="row">
  <div class="col-12 col-md-1"></div>
  <div class="col-12 col-md-5">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                <th>Avaliable tags</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $tags = $connect->query("SELECT * FROM tags");
                foreach($tags as $tag):
                ?>
                <tr>
                    <td><?php echo $tag['tagName']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
  </div>
  <div class="col-12 col-md-1"></div>
  <div class="col-12 col-md-4">
    <div class="card">
        <div class="card-header tag">
            <b>Add a new tag</b>
        </div>
        <div class="card-body form-tag">
            <form class= "form" action="editTags.php" method="post">
                <?php if(count($errors)>0): ?>
                    <div class="form-group">
                        <center><label class="alert alert-danger col-12"><?php foreach( $errors as $error) {echo $error . "</br>"; }?></label></center>
                    </div>
                <?php endif; ?>
                <?php if($success == true): ?>
                    <div class="form-group">
                        <center><label class="alert alert-success col-12"><?php echo 'Tags updated.'; ?></label></center>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="tagName">Tag name: </label>
                    <input type="text" class="form-control" name="tagName" placeholder="Tag">
                </div>
                <div class="form-group" col-12>
                    <button type="submit" name="addTag" class="btn submit">Add</button>
                </div>
            </form>
        </div>
    </div> 
 </div>
 <div class="col-12 col-mid-1"></div>
</div>

<?php 
    include 'footer.php';
?>