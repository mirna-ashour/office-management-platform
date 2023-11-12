<html>

<head>
    <?php 
        include_once 'connect.php';
        include 'controllers/loginController.php';
        include 'global.php';
    ?>
  </head>

  <style>
    .box {
        margin-top:25%;
        -webkit-box-shadow: 2px 2px 32px -9px rgba(135,131,135,1);
        -moz-box-shadow: 2px 2px 32px -9px rgba(135,131,135,1);
        box-shadow: 2px 2px 32px -9px rgba(135,131,135,1);
    }

    .form-login {padding: 10% 11%;}

    .login {font-size: 140%;}

    .link {font-size: 80%; color: #a3a3a3;}

    .bg{background-color: #4c5657;}

    .title{padding-top: 0.5%; color:white; font-size:150%;}

  </style>
    
  <body>

    <div class ="container-fluid">
      <div class ="row">
        <div class="col-12 bg">
          <p class="title">MOFNE<span style="color:#d6d6d6">Portal</span></p>
        </div>
      </div>
      <div class = "row">
        <div class = "col-md-4 col-sm-4 cols-xs-12"></div>
        <div class = "col-md-4 col-sm-4 cols-xs-12">
          <div class="card box">
              <div class="card-header login">
                  <center>Login</center>
              </div>
              <div class="card-body form-login">
                <form class= "form-container" action="index.php" method="post">
                  <?php if(count($errors)>0): ?>
                    <div class="form-group">
                      <center><label class="alert alert-danger col-md-12"><?php echo $errors['error']; ?></label></center>
                    </div>
                  <?php endif; ?>
                  <div class="form-group">
                    <label for="email">Username:</label>
                    <input type="text" class="form-control" name="username" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <button type="submit" name="login" class="btn btn-dark btn-block submit">Submit</button>
                    <!-- <a class="link" href="forgot.php"><b>Forgot your password?</b></a> -->
                  </div>
                </form>
              </div>
          </div>
        </div> 
        <div class = "col-md-4 col-sm-4 cols-xs-12"></div>
      </div>
    </div>

  </body



</html>