<header>
  <?php 
    include_once 'header.php'; 
  ?>
  <link href='stylesheets/home.css' rel='stylesheet' type='text/css'>
</header>

<div class="container-fluid">
<div class = "row">
  <?php 
    $results = $connect->query("SELECT * from ministries");
    foreach($results as $ministry):
  ?>
  <div class="col-12 col-md-3">
    <div class="card boxes">
      <div class="card-header ministry-name">
        <b><?php echo $ministry['ministryName']; ?></b>
      </div>
      <div class="card-body">
        <b><p class="card-title"><span style="color: #907f61">Details: </span> </p></b>
        <?php 
          $p = $connect->query("SELECT decisions.decisionID, decisions.status, d2m.*, ministries.* from d2m join ministries on d2m.ministryID=ministries.ministryID 
          join decisions on decisions.decisionID=d2m.decisionID where d2m.ministryID= '".$ministry['ministryID']."' AND decisions.status = 0");
          $pending = $p->num_rows;
          $c = $connect->query("SELECT decisions.decisionID, decisions.status, d2m.*, ministries.* from d2m join ministries on d2m.ministryID=ministries.ministryID 
          join decisions on decisions.decisionID=d2m.decisionID where d2m.ministryID= '".$ministry['ministryID']."' AND decisions.status = 1");
          $complete = $c->num_rows;
          $x = $connect->query("SELECT decisions.decisionID, decisions.status, d2m.*, ministries.* from d2m join ministries on d2m.ministryID=ministries.ministryID 
          join decisions on decisions.decisionID=d2m.decisionID where d2m.ministryID= '".$ministry['ministryID']."' AND decisions.status = 2");
          $cancelled = $x->num_rows;
        ?>
        <p class="card-text">
          <?php 
            echo '- ' . $pending . ' pending </br>';
            echo '- ' . $complete . ' complete </br>';
            echo '- ' . $cancelled . ' cancelled';
          ?>
        </p>
        <a href="viewMinistry.php?ministryID=<?php echo $ministry['ministryID']; ?>" class="btn btn-primary more">View</a>
      </div>
    </div><br>
  </div>
  <?php endforeach; ?>
</div>
</div>

<?php 
  include 'footer.php';
?>
  