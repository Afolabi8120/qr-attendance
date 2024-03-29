<?php 
   require('../core/validate/user.php'); 

   if(isset($_SESSION['lecturer']) AND !empty($_SESSION['lecturer'])){
        
      $course_code = $_GET['course_code'];  
      $session = $_GET['session'];
      $semester = $_GET['semester'];
      $_date = $_GET['_date'];
      $getUser = $globalclass->selectByOneColumn('email','tbluser',$_SESSION['lecturer']);

   }else{
      header('location: ./');
   }

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>View Attendance</title>
   <!-- Font Awesome -->
   <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
   <link rel="stylesheet" href="../asset/css/adminlte.min.css">
   <link rel="stylesheet" href="../asset/tables/datatables-bs4/css/dataTables.bootstrap4.min.css">
   <style type="text/css">
      .txt {
         padding-left: 20px !important;
      }

      .text-color {
         color: rgb(0,166,90);
      }
      ul.nav-sidebar li a i{
         color: rgb(0,166,90);
      }
      li a i{
         color: #fff;
      }
   </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
   <div class="wrapper">
      <nav class="main-header navbar navbar-expand navbar-light elevation-1" style="background-color: green;">
         <?php include('includes/navbar.php'); ?>
      </nav>
      <aside class="main-sidebar sidebar-light-primary ">
         <?php include('includes/sidebar.php'); ?>
      </aside>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6">
                        <h1 class="m-0"><span class="fa fa-user"></span> View Attendance</h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="#">Home</a></li>
                           <li class="breadcrumb-item active"> View Attendance</li>
                        </ol>
                     </div>
                  </div>
               </div>
            </div>
            <section class="content">
               <div class="container-fluid">
                  <?php
                        echo ErrorMessage();
                        echo SuccessMessage();
                     ?>
                  <div class="card card-info">
                     <div class="card-header" style="background-color: green;">
						</i> Student(s) Attendance List for <?= strtoupper($course_code); ?></i>
                     </div>
                     <br>
                     <div class="col-md-12 mt-3">
                        <table id="example1" class="table table-bordered">
                           <thead>
                              <tr>
                                 <th>S/N</th>
                                 <th>Course Code</th>
                                 <th>Matric No</th>
                                 <th>Full Name</th>
                                 <th>Date</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php 
                                 $i = 1; 
                                 #var_dump($user->getAttendanceByDate($getUser->id));exit();
                                 foreach($user->getAttendance($getUser->id,$course_code,$semester,$session,$_date) as $getattendance): 

                                    $getStudentInfo = $globalclass->selectByOneColumn('matricno','tbluser',$getattendance[1]);
                              ?>
                              <tr>
                                 <td><?= $i++; ?></td>
                                 <td><?= strtoupper($getattendance[3]); ?></td>
                                 <td><?= $getattendance[1]; ?></td>
                                 <td><?= ucwords($getStudentInfo->fullname); ?></td>
                                 <td><?= $getattendance[4]; ?></td>
                                 <td class="text-center">
                                       <a href="print-attendance?sid=<?= $getattendance[1]; ?>&course_code=<?= $getattendance[3]; ?>&session=<?= $getattendance[7]; ?>&semester=<?= $getattendance[8]; ?>" class="btn btn-info btn-sm mb-2">Print Attendance</a>
                                 </td>
                              </tr>
                              <?php endforeach; ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
      </div>
      <!-- ./wrapper -->

      <!-- jQuery -->
      <script src="../asset/jquery/jquery.min.js"></script>
      <script src="../asset/js/bootstrap.bundle.min.js"></script>
      <script src="../asset/js/adminlte.js"></script>
      <!-- DataTables  & Plugins -->
      <script src="../asset/tables/datatables/jquery.dataTables.min.js"></script>
      <script src="../asset/tables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
      <script src="../asset/tables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
      <script src="../asset/tables/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
      <script>
         $(function () {
           $("#example1").DataTable();
         });
      </script>
   </body>
</html>