<?php 

   require('../core/init.php'); 

   if(isset($_SESSION['lecturer']) AND !empty($_SESSION['lecturer'])){
        
      $getUser = $globalclass->selectByOneColumn('email','tbluser',$_SESSION['lecturer']);

   }else{
      header('location: ./');
   }

   if(isset($_GET['id']) AND !empty($_GET['id'])){
      
      $course_id = $_GET['id'];

      #$user->doubleCheck($table,$column,$value,$column2,$value2);
      $getCourse = $globalclass->selectByOneColumn('id','tblassign_course',$course_id);
      $getCourseData = $globalclass->selectByOneColumn('course_code','tblcourse',$getCourse->course_code);

   }

?>
<!DOCTYPE html>
<html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="../camera/asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../camera/asset/css/style.css">
      <link rel="stylesheet" type="text/css" href="../camera/asset/css/style1.css">
      <style>
         body {
            background-image: url('../image/bg.jpg');
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
         .popup {
             position: fixed;
             top: 0;
             width: 100vw;
             height: 100vh;
             background-color: rgba(0, 0, 0, .3);
             display: grid;
             place-content: center;
             opacity: 0;
             pointer-events: none;
             transition: 200ms ease-in-out opacity;
             color: black;
         }
         .popup-content {
             width: clamp(300px, 90vw, 500px);
             background-color: #fff;
             padding: clamp(1.5rem, 100vw, 3rem);
             box-shadow: 0 0 .5em rgba(0, 0, 0, .5);
             border-radius: .5em;
             opacity: 0;
             transform: translateY(20%);
             transition: 200ms ease-in-out opacity,
                         200ms ease-in-out transform;
             position: relative;
             color: black;
         }
         .popup h1 {
             position: absolute;
             top: 2rem;
             right: 2rem;
             line-height: 1;
             cursor: pointer;
             user-select: none;
         }
         .popup h1:active {
             transform: scale(.9);
         }

         .showPopup {
             opacity: 1;
             transform: translateY(0);
             pointer-events: all;
         }
      </style>
      
      <script src="../camera/asset/qrcode/vue/vue.min.js"></script>
      
   </head>
   <body>
      <a href="courses" class="btn btn-info btn-sm">Go Back</a>
      <div class="container-fluid">
         <h2 class="mt-3 mb-3 text-center text-white">Student Attendance System Using QR Code</h2>
         <p class="mt-3 mb-3 text-center text-white">(A Case Study of Computer Science Department)</p>
         <p class="mt-3 mb-3 text-center text-white">Course Title: <?= strtoupper($getCourseData->course_title); ?></p>
         <p class="mt-3 mb-3 text-center text-white">Course Code: <?= ucwords($getCourseData->course_code); ?></p>
         <p class="mt-3 mb-3 text-center text-white">Session: <?= ucwords($getCourse->session); ?></p>
         

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
                     <input class="form-control" type="hidden" name="course_code" id="course_code" value="<?= $getCourseData->course_code; ?>" readonly="">
                     <input class="form-control" type="hidden" name="lecturer_id" id="lecturer_id" value="<?= $getUser->id; ?>" readonly="">
                     <input class="form-control" type="hidden" name="course_id" id="course_id" value="<?= $_GET['id']; ?>" readonly="">
                     <input class="form-control" type="hidden" name="session" id="session" value="<?= $getCourse->session; ?>" readonly="">
                     <input class="form-control" type="hidden" name="semester" id="semester" value="<?= $getCourse->semester; ?>" readonly="">
                  </div>
               </form>
               <?php 
                  if(isset($_SESSION['student'])){ 

                     if($globalclass->selectByOneColumn('matricno','tbluser',$_SESSION['student'])){ 

                        $getStudentDetails = $globalclass->selectByOneColumn('matricno','tbluser',$_SESSION['student']);
                  
               ?>
               <?php if(isset($getStudentDetails)): ?>
               <div class="popup">
                  <div class="popup-content">
                     <h1>x</h1>
                     <h2 style="text-align: center;">Student Information</h2>
                     <center><img class="img-profile m-2" src="../image/<?= $getStudentDetails->picture; ?>" width="150px" height="150px"></center>
                     <p style="text-align: center;">
                        Matric No: <?= $getStudentDetails->matricno; ?> <br>
                        Full Name: <?= strtoupper($getStudentDetails->fullname); ?> <br>
                        Gender: <?= $getStudentDetails->gender; ?> <br>
                        Level: <?= $getStudentDetails->level; ?> <br>
                        Program: <?= $getStudentDetails->program; ?> <br>
                        Department: <?= $getStudentDetails->department; ?> <br>
                        Faculty: <?= $getStudentDetails->faculty; ?> <br>
                        <span class="badge bg-success text-white">Attendance Marked</span>
                     </p>
                  </div>
               </div>
               <?php endif; ?>
               

               <?php }elseif(!$globalclass->selectByOneColumn('matricno','tbluser',$_SESSION['student'])){ ?>
               <div class="popup">
                  <div class="popup-content">
                     <h1>x</h1>
                     <h2 style="text-align: center;">Student Record Do Not Exist</h2>
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
                                 <th>Time</th>
                              </tr>
                           </thead>
                           <!-- var_dump($user->fetch());exit(); -->
                           <tbody>
                              <?php 
                                 $date = date("d M Y");
                                 $i = 1; 
                                 foreach($user->fetchWhere($getUser->id,$getCourseData->course_code,$date) as $getattendance){ 
                              
                              ?>
                              <tr>
                                 <td><?= $i++; ?></td>
                                 <td><img src="../image/<?= $getattendance[11]; ?>" width="40" style="border: 1px solid gray;"></td>
                                 <td><?= strtoupper($getattendance[2]); ?></td>
                                 <td><?= $getattendance[18]; ?></td>
                                 <td><?= $getattendance[19]; ?></td>
                              </tr>
                              <?php } ?>
                           </tbody>
                        </table>
                     </div>
            </div>
         </div>
      </div>

      <script>
        const popup = document.querySelector('.popup');
        const x = document.querySelector('.popup-content h1')

        window.addEventListener('load', () => {
            popup.classList.add('showPopup');
            popup.childNodes[1].classList.add('showPopup');
        })
        x.addEventListener('click', () => {
            popup.classList.remove('showPopup');
            popup.childNodes[1].classList.remove('showPopup');
        })
      </script>

      <script src="../camera/asset/qrcode/instascan/instascan.min.js"></script>

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