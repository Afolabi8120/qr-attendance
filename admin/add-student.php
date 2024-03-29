<?php 
   require('../core/validate/user.php'); 

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
                        <h1 class="m-0"><span class="fa fa-user"></span> Students</h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="#">Home</a></li>
                           <li class="breadcrumb-item active">Student</li>
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
                        class="fa fa-user-plus"></i> Add Student</a>
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
                                 <th>Action</th>
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
                                 <td class="text-center">
                                       <a href="id-card?sid=<?= $getstudent->id; ?>" target="_blank" class="btn btn-info btn-sm mb-2">Print ID Card</a>
                                       <form method="POST">
                                          <input type="hidden" name="user_id" value="<?= $getstudent->id; ?>" readonly>
                                          <input type="hidden" name="user_image" value="<?= $getstudent->picture; ?>" readonly>
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
                                 <span class="fa fa-user"> Student's Information</span>
                              </div>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Matric No</label>
                                       <input type="text" class="form-control" placeholder="Matric No" name="matricno">
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
                                       <label>Gender</label>
                                       <select name="gender" class="form-control">
                                          <option value="Male">Male</option>
                                          <option value="Female">Female</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Level</label>
                                       <select name="level" class="form-control">
                                          <option value="ND I">ND I</option>
                                          <option value="ND II">ND II</option>
                                          <option value="ND III">ND III</option>
                                          <option value="HND I">HND I</option>
                                          <option value="HND II">HND II</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Program</label>
                                       <select name="program" class="form-control">
                                          <option value="FT">FT</option>
                                          <option value="PT">PT</option>
                                          <option value="DPP">DPP</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Faculty</label>
                                       <select name="faculty" class="form-control">
                                          <option value="FSC">FSC</option>
                                          <option value="FFMS">FFMS</option>
                                          <option value="FBCS">FBCS</option>
                                          <option value="FENG">FENG</option>
                                          <option value="FES">FES</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Department</label>
                                       <input type="text" class="form-control" placeholder="Email" name="department" value="Computer Science" readonly>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Passport</label>
                                       <input type="file" class="form-control" name="stu_image">
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