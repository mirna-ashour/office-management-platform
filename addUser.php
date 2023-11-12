<?php 
    include_once 'header.php';
    include 'controllers/editController.php';      
?>

<header> 
    <link href='stylesheets/form.css' rel='stylesheet' type='text/css'>
</header>

<div class = "row">
  <div class="col-md-3 col-12"></div>
    <div class= "col-md-6 col-12">
        <div class="card boxes">
            <div class="card-header add">
                <center><b>Add a user</b></center>
            </div>
            <div class="card-body form-add">
              <form class= "form" action="addUser.php" method="post">
                <?php if(count($errors)>0): ?>
                    <div class="form-group">
                        <center><label class="alert alert-danger col-12"><?php foreach( $errors as $error) {echo $error . "</br>"; }?></label></center>
                    </div>
                <?php endif; ?>
                <?php if($success == true): ?>
                    <div class="form-group">
                        <center><label class="alert alert-success col-12"><?php echo 'User was succesfully added.'; ?></label></center>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="username">Username: </label>
                    <input type="text" class="form-control" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="name">Name: </label>
                    <input type="text" class="form-control" name="name" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="conPassword">Confirm password:</label>
                    <input type="password" class="form-control" name="conPassword" placeholder="Confirm password">
                </div><br>
                <div class="form-group" col-12>
                    <button type="submit" name="add" class="btn submit">Add</button>
                </div>
              </form>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-12"></div>
</div>

<?php 
    include 'footer.php';
?>