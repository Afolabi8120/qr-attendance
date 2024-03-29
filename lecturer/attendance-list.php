<?php 
   require('../core/validate/user.php'); 

   if(isset($_SESSION['lecturer']) AND !empty($_SESSION['lecturer'])){
        
      $course_code = $_GET['id'];  
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
   <title>Add Student</title>
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
                        <h1 class="m-0"><span class="fa fa-user"></span> Attendance List</h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="#">Home</a></li>
                           <li class="breadcrumb-item active">Attendance List</li>
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
						</i> Attendance List for <?= strtoupper($course_code); ?></i>
                     </div>
                     <br>
                     <div class="col-md-12 mt-3">
                        <table id="example1" class="table table-bordered">
                           <thead>
                              <tr>
                                 <th>S/N</th>
                                 <th>Course Code</th>
                                 <th>Session</th>
                                 <th>Semester</th>
                                 <th>Date</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php 
                                 $i = 1; 
                                 #var_dump($user->getAttendanceByDate($getUser->id));exit();
                                 foreach($user->getAttendanceByDate($getUser->id,$course_code) as $getattendance): ?>
                              <tr>
                                 <td><?= $i++; ?></td>
                                 <td><?= strtoupper($getattendance[1]); ?></td>
                                 <td><?= $getattendance[2]; ?></td>
                                 <td><?= $getattendance[3]; ?></td>
                                 <td><?= $getattendance[4]; ?></td>
                                 <td class="text-center">
                                       <a href="view-attendance?course_code=<?= $getattendance[1]; ?>&session=<?= $getattendance[2]; ?>&semester=<?= $getattendance[3]; ?>&_date=<?= $getattendance[4]; ?>" class="btn btn-info btn-sm mb-2">View Attendance</a>
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