<?php 
   include('../asset/phpqrcode/qrlib.php'); 
   require('../core/validate/user.php'); 

   if(isset($_SESSION['lecturer']) AND !empty($_SESSION['lecturer'])){
    
    $course_code = $_GET['course_code'];  
      $session = $_GET['session'];
      $semester = $_GET['semester'];
      $sid = $_GET['sid'];
      $getUser = $globalclass->selectByOneColumn('email','tbluser',$_SESSION['lecturer']);

      if(isset($_GET['sid']) AND !empty($_GET['sid'])){
        $student_id = $_GET['sid'];
        $getStudentData = $globalclass->selectByOneColumn('matricno','tblattendance',$student_id);

        // if(!$getStudentData){
        //     header('location: attendance-list');
        // }
      }

   }else{
      header('location: ./');
   }

?>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
   	<link rel="stylesheet" href="../asset/css/adminlte.min.css">
   	<link rel="stylesheet" href="../asset/tables/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <style>
        body {
            font-family: 'Source Sans Pro', serif;
        }

        table {
        	margin: 5px;
        	padding: 5px;

        }

        button {
            margin: 10px;
            background: maroon;
            color: white;
            padding: 12px;
            outline: none;
            border: none;
            border-radius: 5px;
            height: 40px;
            width: 80px;
            cursor: pointer;
        }
        @media print {
            .btn-print {
                display:none !important;
            }
        }

    </style>
</head>

<body>
<section class="container">
    <div class="row">
        <!-- hrmghs -->
        <div class="col-md-12">
            <h2 class="mt-3 mb-3 text-center ">Student Attendance System Using QR Code</h2>
            <p class="mt-3 mb-3 text-center ">(A Case Study of Computer Science Department)</p>
            <table border="1" style="border: 1px solid #ccc;margin-top: 20px;" cellpadding="10" width="100%">
            	<thead style="text-align: center;">
            		<tr>
            			<th>Matric No</th>
            			<th colspan="3">Full Name</th>
            			<th>Level/Program</th>
            			<th>Faculty/Department</th>
            		</tr>
            	</thead>
            	<tbody>
            		<tr style="text-align: center;">
            			<?php $getS = $globalclass->selectByOneColumn('matricno','tbluser',$student_id); ?>
            			<td><?= $getS->matricno; ?></td>
            			<td colspan="3"><?= ucwords($getS->fullname); ?></td>
            			<td><?= $getS->level . "/" .$getS->program; ?></td>
            			<td><?= $getS->faculty . "/" .$getS->department; ?></td>
            		</tr>
            		<tr style="text-align: center;font-weight: bold;">
            			<td>S/N</td>
                        <td>Course Code</td>
                        <td>Semester</td>
                        <td>Session</td>
            			<td>Date</td>
            			<td>Time </td>
            		</tr>
            		<?php $i = 1; foreach($user->getStudentAttendance($sid,$course_code,$session,$semester) as $getstudent): 

                        $getCourseInfo = $globalclass->selectByOneColumn('course_code','tblcourse',$getstudent->course_code);
                    ?>
            		<tr>
            			<td><?= $i++; ?></td>
                        <td>
                            <?= strtoupper($getstudent->course_code); ?> <br>
                            <?= strtoupper($getCourseInfo->course_title); ?>
                        </td>
                        <td><?= ucwords($getstudent->semester); ?></td>
                        <td><?= $getstudent->session; ?></td>
            			<td><?= $getstudent->_date; ?></td>
            			<td><?= $getstudent->time_in; ?></td>
            		</tr>
            		<?php endforeach; ?>
            	</tbody>
            </table>
        </div>

    </div>
</section>
<button type="submit" name="" style="background: maroon;color: white;font-family: 'Helvetica';" class="btn btn-black btn-print" onclick="window.print();">Print</button>

</body>

</html>