<?php 
    include_once 'header.php';
    include 'controllers/editController.php';
?>

<header>
  <link href='stylesheets/home.css' rel='stylesheet' type='text/css'>
</header>
  
<style>
  .del {
    float:right;
  }

  .change{
    float:left;
    background-color:#4c5657; 
    border: none;
  }
</style>

<div class = "row">
  <?php 
    $results = $connect->query("SELECT * FROM ministries");
    foreach($results as $ministry):
    $account = $connect->query("SELECT username FROM accounts WHERE ID=".$ministry['ministryID']);
    $username = $account->fetch_assoc();
  ?>
  <div class="col-12">
    <div class="card boxes">
      <form method="post" action="editUser.php">
        <div class="card-header ministry-name">
          <b><?php echo $ministry['ministryName']; ?></b>
        </div>
        <div class="card-body">
          <!-- <b><p class="card-title"><span style="color: #907f61"></span> 
            <?php 
              //echo $latest["decisionName"]; 
            ?>
          </p></b> -->
          <p class="card-text">
            <?php 
              echo "Name:</br>";
              echo "<input type=\"text\" name=\"name\" value=\"". $ministry['ministryName'] ."\"></input>";
              echo "<input type=\"hidden\" name=\"ministryID\" value=\"". $ministry['ministryID'] ."\"></input>";
            ?>
          </p>
          <p class="card-text">
            <?php 
              echo "Username:</br> ";
              echo "<input type=\"text\" name=\"username\" value=\"". $username['username'] ."\"></input>";
            ?>
          </p>
          <div class="form-group">
            <button class="btn btn-primary change" name="change">Change</button>
            <button class="btn btn-danger del" name="delete">Delete</button>
          </div>
        </div>
      </form>
    </div><br>
  </div><br>
  <?php endforeach; ?>
</div>

<?php 
    include 'footer.php';
?>