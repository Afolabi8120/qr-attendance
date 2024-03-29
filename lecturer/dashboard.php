<?php 
   
   require('../core/init.php'); 

   if(isset($_SESSION['lecturer']) AND !empty($_SESSION['lecturer'])){
        
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
   <title>Dashboard</title>
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
      <div class="content-wrapper">
         <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6">
                     <h1 class="m-0"><span class="fa fa-tachometer-alt"></span> Dashboard</h1>
                  </div>
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <section class="content">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-xl-6 col-md-6 col-12">
                     <div class="card">
                        <div class="card-body ">
                           <div class="d-flex justify-content-between p-md-1">
                              <div class="d-flex flex-row">
                                 <div class="align-self-center">
                                    <i class="fa fa-users text-color fa-3x me-4"></i>
                                 </div>
                                 <div>
                                    <h4 class="txt">Students</h4>
                                    <p class="mb-4 txt">Number of Students</p>
                                 </div>
                              </div>
                              <div class="align-self-center">
                                 <h2 class="h1 mb-4"><?= $user->countByOneColumn('tbluser','usertype','Student'); ?></h2>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-6 col-md-6 col-12">
                     <div class="card">
                        <div class="card-body ">
                           <div class="d-flex justify-content-between p-md-1">
                              <div class="d-flex flex-row">
                                 <div class="align-self-center">
                                    <i class="fa fa-book text-color fa-3x me-4"></i>
                                 </div>
                                 <div>
                                    <h4 class="txt">Attendance</h4>
                                    <p class="mb-4 txt">Total No. of Attendance</p>
                                 </div>
                              </div>
                              <div class="align-self-center">
                                 <h2 class="h1 mb-4"><?= $globalclass->count('tblattendance'); ?></h2>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="container-fluid">
                  <div class="card card-info">
                     <div class="card-header" style="background-color:green;">
                        <h5>All Student List</h5>
                     </div>
                     <br>
                     <div class="col-md-12 mt-3">
                        <table id="example1" class="table table-bordered">
                           <thead>
                              <tr>
                                 <th>S/N</th>
                                 <th>Matric No</th>
                                 <th>Full Name</th>
                                 <th>Profile</th>
                                 <th>Contact No</th>
                                 <th>Email</th>
                                 <th>Account</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $i = 1; foreach($user->selectWhere('tbluser','usertype','Student') as $getstudent): ?>
                              <tr>
                                 <td><?= $i++; ?></td>
                                 <td><?= $getstudent->matricno; ?></td>
                                 <td><?= strtoupper($getstudent->fullname); ?></td>
                                 <td><img src="../image/<?= $getstudent->picture; ?>" width="40" style="border: 1px solid gray;"></td>
                                 <td><?= $getstudent->phone; ?></td>
                                 <td><?= $getstudent->email; ?></td>
                                 <td>
                                       <?php if($getstudent->status == 'Active'): ?>
                                          <span class="badge bg-success">Active</span>
                                       <?php elseif($getstudent->status == 'In-active'): ?>
                                          <span class="badge bg-danger">Inactive</span>
                                       <?php endif; ?>
                                 </td>
                              </tr>
                              <?php endforeach; ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               </div>

            </div>
         </section>
      </div>
   </div>
   <!-- jQuery -->
   <script src="../asset/jquery/jquery.min.js"></script>
   <script src="../asset/js/adminlte.js"></script>
</body>

</html>