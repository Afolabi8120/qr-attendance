<?php require('../core/validate/login.php'); ?>
<!DOCTYPE html>
<html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="camera/asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
   </head>
   <body>
      <div class="container-fluid">
         <h2 class="mt-3 mb-3 text-center h1">Administrator Login</h2>
         <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 mt-3">
              <?php
                echo SuccessMessage();
                echo ErrorMessage();
              ?>
               <div class="card">
                <div class="card-header text-center">
                  <h2>Login Here</h2>
                </div>
                <div class="card-body">
                  <form method="POST">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" name="password" class="form-control" placeholder="**********">
                    </div>
                    <div class="form-group">
                      <input type="submit" name="btnLogin" class="btn btn-md btn-primary" value="Login">
                      <a href="../" class="btn btn-md btn-danger">Back</a>
                    </div>
                  </form>
                </div>
               </div>
            </div>
            <div class="col-md-3"></div>
         </div>
      </div>

      <script src="../asset/jquery/jquery.min.js"></script>
      <script src="../asset/js/bootstrap.bundle.min.js"></script>
   </body>
</html>