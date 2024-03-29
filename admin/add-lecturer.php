<?php 
   require('../core/validate/lecturer.php'); 

   if(isset($_SESSION['user']) AND !empty($_SESSION['user'])){
        
      $getUser = $globalclass->selectByOneColumn('email','tbluser',$_SESSION['user']);

   }else{
      header('location: ./');
   }

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Add Lecturer</title>
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
                        <h1 class="m-0"><span class="fa fa-user"></span> Lecturers</h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="#">Home</a></li>
                           <li class="breadcrumb-item active">Lecturer</li>
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

                     <a class="btn btn-sm" href="#" data-toggle="modal"
                        data-target="#add" style="border: 1px solid #ddd;"><i
                        class="fa fa-user-plus"></i> Add Lecturer</a>
                     </div>
                     <br>
                     <div class="col-md-12 mt-3">
                        <table id="example1" class="table table-bordered">
                           <thead>
                              <tr>
                                 <th>S/N</th>
                                 <th>Staff ID</th>
                                 <th>Full Name</th>
                                 <th>Profile</th>
                                 <th>Contact No</th>
                                 <th>Email</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $i = 1; foreach($user->selectWhere('tbluser','usertype','Lecturer') as $getlecturer): ?>
                              <tr>
                                 <td><?= $i++; ?></td>
                                 <td><?= $getlecturer->matricno; ?></td>
                                 <td><?= strtoupper($getlecturer->fullname); ?></td>
                                 <td><img src="../image/<?= $getlecturer->picture; ?>" width="40" style="border: 1px solid gray;"></td>
                                 <td><?= $getlecturer->phone; ?></td>
                                 <td><?= $getlecturer->email; ?></td>
                                 <td>
                                       <?php if($getlecturer->status == 'Active'): ?>
                                          <span class="badge bg-success">Active</span>
                                       <?php elseif($getlecturer->status == 'In-active'): ?>
                                          <span class="badge bg-danger">Inactive</span>
                                       <?php endif; ?>
                                 </td>
                                 <td class="text-center">
                                       <form method="POST">
                                          <input type="hidden" name="user_id" value="<?= $getlecturer->id; ?>" readonly>
                                          <input type="hidden" name="user_image" value="<?= $getlecturer->picture; ?>" readonly>
                                          <input type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Remove this user account?');" name="btnRemoveUser" value="Delete">
                                       </form>
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

      <div id="add" class="modal animated rubberBand delete-modal" role="dialog">
         <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
               <div class="modal-body text-center">
                  <form method="POST" enctype="multipart/form-data">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="card-header">
                                 <span class="fa fa-user"> Lecturer's Information</span>
                              </div>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Staff ID</label>
                                       <input type="text" class="form-control" placeholder="Staff ID" name="matricno">
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Full Name</label>
                                       <input type="text" class="form-control" placeholder="Full Name" name="fullname">
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Email</label>
                                       <input type="email" class="form-control" placeholder="Email" name="email">
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Contact No</label>
                                       <input type="tel" maxlength="11" class="form-control" placeholder="Contact No" name="phone">
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Photo</label>
                                       <input type="file" class="form-control" name="stu_image">
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Password</label>
                                       <input type="password" class="form-control" name="password" required>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Confirm Password</label>
                                       <input type="password" class="form-control" name="cpassword" required>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value="Save" name="btnRegister">
                        <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
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