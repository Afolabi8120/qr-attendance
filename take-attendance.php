<?php require('core/init.php'); ?>
<!DOCTYPE html>
<html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="camera/asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="asset/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="camera/asset/css/style.css">
      <link rel="stylesheet" type="text/css" href="camera/asset/css/style1.css">
      <style>
         body {
            background-image: url('image/bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            color: white;
         }
         .camera{
         width: 80%;
         border-radius:10px;
         border: 15px solid black;
         border-style: outset;
         box-shadow: 0px 1px 2px #eee, 0px 2px 2px #e9e9e9, 0px 3px 2px #ccc, 0px 4px 2px #c9c9c9, 0px 5px 2px #bbb, 0px 6px 2px #b9b9b9, 0px 7px 2px #999, 0px 7px 2px rgba(0, 0, 0, 0.5), 0px 7px 2px rgba(0, 0, 0, 0.1), 0px 7px 2px rgba(0, 0, 0, 0.73), 0px 3px 5px rgba(0, 0, 0, 0.3), 0px 5px 10px rgba(0, 0, 0, 0.37), 0px 10px 10px rgba(0, 0, 0, 0.1), 0px 20px 20px rgba(0, 0, 0, 0.1);
         }

      </style>
      
      <script src="camera/asset/qrcode/vue/vue.min.js"></script>
      
   </head>
   <body>
      <div class="container-fluid">
         <h2 class="mt-3 mb-3 text-center text-white">Student Attendance System Using QR Code</h2>
         <p class="mt-3 mb-3 text-center text-white">(A Case Study of Computer Science Department)</p>
         <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 mt-5">
               <video id="preview" class="camera" width="" autofocus></video>
            </div>
            <div class="col-md-3"></div>


            <div class="col-md-12">
               <form action="insert.php" method="POST" id="myForm" class="form-horizontal">
                  <div class="form-group">
                     <label hidden>QR Code</label>
                     <input class="form-control" type="hidden" name="qrcode" id="text" readonly="">
                  </div>
               </form>
               <?php 
                  if(isset($_SESSION['student'])){ 

                     if($globalclass->selectByOneColumn('matricno','tbluser',$_SESSION['student'])){ 

                        $getStudentDetails = $globalclass->selectByOneColumn('matricno','tbluser',$_SESSION['student']);
                  
               ?>
               <div class="col-md-12">
                        <?php
                           echo ErrorMessage();
                           echo SuccessMessage();
                        ?>
                  <div class="card ">
                     <div class="card-header h3 text-dark text-center bg-dark">Student Information</div>
                     <table class="table table-responsive">
                        <thead class=" text-dark">
                           <tr>
                              <th rowspan="8" ><th>
                           </tr>
                        </thead>
                        <tbody class="fw-bold">
                           <tr class="text-dark">
                              <td>
                                 <center><img class="img-profile m-2" src="image/<?= $getStudentDetails->picture; ?>" width="150px" height="150px"></center>
                              </td>
                              <td rowspan="7" style="font-weight: bold;">
                                 <?= $getStudentDetails->matricno; ?> <br>
                                 <?= strtoupper($getStudentDetails->fullname); ?> <br>
                                 <?= $getStudentDetails->gender; ?> <br>
                                 <?= $getStudentDetails->level; ?> <br>
                                 <?= $getStudentDetails->program; ?> <br>
                                 <?= $getStudentDetails->department; ?> <br>
                                 <?= $getStudentDetails->faculty; ?> <br>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <?php }elseif(!$globalclass->selectByOneColumn('matricno','tbluser',$_SESSION['student'])){ ?>
               <div class="col-md-12">
                  <div class="card">
                     <div class="card-header h3 text-center text-white bg-danger">Invalid Data</div>
                  </div>
               </div>
               <?php  } }
               ?>

<div class="col-md-12 mt-3">
                        <table id="example1" class="table table-bordered">
                           <thead>
                              <tr>
                                 <th>S/N</th>
                                 <th>Picture</th>
                                 <th>Full Name</th>
                                 <th>Date</th>
                                 <th>Time In</th>
                                 <th>Time Out</th>
                              </tr>
                           </thead>
                           <!-- var_dump($user->fetch());exit(); -->
                           <tbody>
                              <?php 
                                 $date = date("d M Y");
                                 $i = 1; 
                                 foreach($user->fetchWhere($date) as $getattendance){ 
                              
                              ?>
                              <tr>
                                 <td><?= $i++; ?></td>
                                 <td><img src="image/<?= $getattendance[11]; ?>" width="40" style="border: 1px solid gray;"></td>
                                 <td><?= strtoupper($getattendance[2]); ?></td>
                                 <td><?= $getattendance[14]; ?></td>
                                 <td><?= $getattendance[15]; ?></td>
                                 <td><?= $getattendance[16]; ?></td>
                              </tr>
                              <?php } ?>
                           </tbody>
                        </table>
                     </div>
            </div>
         </div>
      </div>

      <script src="camera/asset/qrcode/instascan/instascan.min.js"></script>

      <script>
         let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
         Instascan.Camera.getCameras().then(function(cameras) {
           if (cameras.length > 0) {
             scanner.start(cameras[0]);
           } else {
             alert('No cameras found.');
           }

           }).catch(function(e) {
               console.error(e);
           });

         scanner.addListener('scan', function(c) {
            document.getElementById("text").value = c;
            document.forms[0].submit();
      });

      </script>
   </body>
</html>