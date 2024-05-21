<?php require('core/init.php'); ?>
<!DOCTYPE html>
<html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="camera/asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="asset/css/bootstrap.min.css">
      <style>
        body {
            background-image: url('image/bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
      </style>
   </head>
   <body>
      <div class="container-fluid">
         <h2 class="mt-3 mb-3 text-center text-white">Student Attendance System Using QR Code</h2>
         <p class="mt-3 mb-3 text-center text-white">(A Case Study of Computer Science Department)</p>
            <center>
                <!-- <a href="take-attendance" class="btn btn-primary btn-lg mr-2">Take Attendance</a> -->
                <a href="admin/index" class="btn btn-danger btn-lg">Login as Admin</a>
                <a href="lecturer/index" class="btn btn-success btn-lg">Login as Lecturer</a>
            </center>
         
      </div>

      <script src="asset/js/bootstrap.bundle.min.js"></script>
      <script src="asset/jquery/jquery.min.js"></script>
      <script src="camera/asset/qrcode/jquery/jquery-3.4.1.min.js"></script>
   </body>
</html>