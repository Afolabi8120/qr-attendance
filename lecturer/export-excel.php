<?php
    require('../core/validate/user.php'); 
    #require_once('../assets/dompdf/vendor/autoload.php');

    $course_code = $_GET['course_code'];  
    $session = $_GET['session'];
    $semester = $_GET['semester'];
    $_date = $_GET['_date'];
    $getUser = $globalclass->selectByOneColumn('email','tbluser',$_SESSION['lecturer']);

    /* Filter Excel Data */
    function filterData(&$str)
    {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }

    /* Excel File Name */
    $fileName = 'Student Attendance Report for ' . $course_code . " - " . $_date . '.xls';

    /* Excel Column Name */
    $fields = array('Course Code','Matric No', 'Full Name', 'Level', 'Semester', 'Session', 'Date', 'Total Attendance Count');

    /* Implode Excel Data */
    $excelData = implode("\t", array_values($fields)) . "\n";

    /* Fetch All Records From The Database */
    // foreach ($admin->selectAll('tblproduct') as $getProductStock){
    //     $lineData = array($getProductStock->product_code, ucwords($getProductStock->product_name), $getProductStock->quantity);
    //     array_walk($lineData, 'filterData');
    //     $excelData .= implode("\t", array_values($lineData)) . "\n";
    // }
 
    foreach($user->getAttendance($getUser->id,$course_code,$semester,$session,$_date) as $getattendance){
        $i = 1;
        $getStudentInfo = $globalclass->selectByOneColumn('matricno','tbluser',$getattendance[1]);
        $lineData = array(strtoupper($getattendance[3]), $getattendance[1], ucwords($getStudentInfo->fullname), ucwords($getStudentInfo->level), $semester, $session, $getattendance[4], $user->countTotalStudentAttendance($getattendance[1],$course_code,$semester,$session));
        array_walk($lineData, 'filterData');
        $excelData .= implode("\t", array_values($lineData)) . "\n";
    }

    /* Generate Header File Encodings For Download */
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$fileName\"");

    /* Render  Excel Data For Download */
    echo $excelData;

    exit;
