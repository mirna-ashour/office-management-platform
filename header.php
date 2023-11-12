<html>

  <head>
    <?php 
      include_once 'connect.php';
      include 'controllers/loginController.php';
      include 'global.php';
    ?>
    <link href='stylesheets/header.css' rel='stylesheet' type='text/css'>

    <?php 
      //check for existing session
      if(!isset($_SESSION["access"])) {
        header("Location: index.php");
      }else if ($_SERVER['PHP_SELF']=='/index.php'){
        header("Location: home.php");
      }
    ?>
  </head>

  <body>
  <header>
    <nav class="navbar navbar-expand navbar-fixed-top menu">
      <b><a class="navbar-brand" href="home.php">MOFNE</a></b>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php if($_SESSION["access"] == "1"): ?>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
              <a class="nav-link" href="home.php">Decisions<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Edit
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="addUser.php">Add User</a>
              <a class="dropdown-item" href="editUser.php">Edit User</a>
              <a class="dropdown-item" href="editTags.php">Edit Tags</a>
            </div>
          </li>
        </ul>
        <?php endif; ?>
        
      </div>
      <form class="form-inline my-2 my-lg-0 float-right" method= "post" action="header.php">
          <button class="btn btn-outline-light my-2 my-sm-0" type="submit" name="logout">Logout</button>
        </form>
    </nav>
  </header><br>

  <div class="container-fluid">