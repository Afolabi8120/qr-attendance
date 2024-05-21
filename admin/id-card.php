<?php 
   include('../asset/phpqrcode/qrlib.php'); 
   require('../core/validate/user.php'); 

   if(isset($_SESSION['user']) AND !empty($_SESSION['user'])){
        
      $getUser = $globalclass->selectByOneColumn('email','tbluser',$_SESSION['user']);

      if(isset($_GET['sid']) AND !empty($_GET['sid'])){
        $student_id = $_GET['sid'];
        $getStudentData = $globalclass->selectByOneColumn('id','tbluser',$student_id);
        $QRCODE = $getStudentData->matricno;

        if(!$getStudentData){
            header('location: add-student');
        }
      }

   }else{
      header('location: ./');
   }

?>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans Pro', serif;
        }

        .row {
            width: 100%;
            overflow: hidden;
        }

        .card {
            border-radius: 10px;
            border: 2px solid #ccc;
            height: 323px;
            width: 204px;
            float: left;
            margin-right: 5px;
            box-sizing: border-box;
        }

        .blue {
            background-color: #DDE7F2;
        }

        .light_blue {
            background-color: #D0E2F3;
            border-color: #00206087;
        }


        .bold {
            font-weight: bold
        }

        .header {
            margin-top: 11px;
        }

        .header,
        .content,
        .footer,
        .signature,
        .barcode {
            width: 100%;
            overflow: hidden;
        }

        .title {
            font-weight: bold;
            font-size: 20px;
            display: flex;
            align-items: center;
            position: relative;
        }

        .logo {
            height: 48px;
            width: 48px;
            float: left;
            margin-right: 5px;

        }

        .logo img {
            width: 100%;
            height: 100%;
        }

        .logo.krmdc-logo {
            height: 54px
        }

        .student_pic {
            width: 100%;
            display: block;
            overflow: hidden;
            text-align: center;
            box-sizing: border-box;
        }

        .student_pic img {
            width: 100%;
            max-width: 53px;
            margin: 5px auto;
            box-sizing: border-box;
        }

        .signature {
            text-align: right;
        }

        .signature img {
            height: 28px;
            width: 101px;
            display: block;
        }

        .signature img,
        .signature span {
            float: right;
            margin-right: 5px;
        }

        .barcode img {
            width: 100%;
        }

        .barcode {
            text-align: center
        }

        table,
        span {
            font-size: 12px
        }

        table {
            padding-left: 5px
        }

        .footer span {
            width: 100%
        }

        .back {
            text-align: center;
        }

        .back h3 {
            padding: 0 15px;
            font-weight: normal
        }

        .back h2,
        .back h3 {
            font-size: 16px;
        }

        .back h2 {
            padding: 0 17px;
            margin-bottom: 6px;
        }

        .back span,
        .back a {
            display: block;
            text-align: center;
            font-size: 15px;
            font-weight: bold;
        }

        .back-logo {
            width: 58px
        }

        .hrmghs {
            font-size: 15px;
            display: inline-flex;
        }

        .border_blue {
            border: 2px solid #002060
        }

        back span,
        .back a {
            font-size: 14px;
        }

        .border_navy {
            border: 2px solid #3D49FC;
        }

        .txt_full {
            letter-spacing: 5px;
            text-align: center;
            padding-left: 5px;
            padding-right: 5px;
            overflow: hidden;
            margin-bottom: 15px;
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
<section class="main">
    <div class="row">
        <!-- hrmghs -->
        <div class="card blue">
            <div class="header">
                <!-- <div class="logo"><img src="../image/<?= $getStudentData->picture; ?>"></div> -->
                <center><div class="title hrmghs">THE POLYTECHNIC IBADAN</div></center>
            </div>
            <div class="content">
                <span class="student_pic"><img class="border_navy" src="../image/<?= $getStudentData->picture; ?>" height="60px" width="60px" /></span>
                <table border="0" cellpadding="0" cellspaing="0" >
                    <tr>
                        <td>Matric No:</td>
                        <td>:</td>
                        <td><?= $getStudentData->matricno; ?></td>
                    </tr>
                    <tr>
                        <td>Full Name</td>
                        <td>:</td>
                        <td><?= ucwords($getStudentData->fullname); ?></td>
                    </tr>
                    <tr>
                        <td>Level</td>
                        <td>:</td>
                        <td><?= $getStudentData->level; ?></td>
                    </tr>
                    <tr>
                        <td>Faculty</td>
                        <td>:</td>
                        <td><?= $getStudentData->faculty; ?></td>
                    </tr>
                    <tr>
                        <td>Department</td>
                        <td>:</td>
                        <td><?= $getStudentData->department; ?></td>
                    </tr>
                    <tr>
                        <td>Program</td>
                        <td>:</td>
                        <td><?= $getStudentData->program; ?></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>:</td>
                        <td><?= $getStudentData->gender; ?></td>
                    </tr>
                </table>
            </div>
            <div class="footer">
                <div class="student_pic">
                    <?php echo $globalclass->generateQRCode($QRCODE); ?>
                    <!-- <img src="../asset/img/qr.png" height="50" width="50" /> -->
                </div>
            </div>
        </div>
        <div class="card back blue">
            <img src="../asset/img/poly.png" height="50px" width="50px" style="margin-top: 5px;">
            <h5>If Found Please Return The Card To</h5>
            <img src=""/>
            <h2>THE POLYTECHNIC IBADAN</h2>
            <span class="address" style="font-size: 10px;margin-bottom: 3px;">P.M.B 22, U.I Post Office, Ibadan
                    <br /> Oyo State.
                </span>
            <center>
                <!-- <img src="../image/signa.png" height="30" width="100" /> -->
                <span style="font-size: 10px;margin-bottom: 3px;">Authorized Signature</span>
            </center>
            <a href="#" style="font-size: 10px;margin-bottom: 3px;">www.polyib.edu.ng</a>
            <span style="font-size: 10px;">Email: info@polyib.edu.ng</span>
            <br>
            <div class="student_pic">
                <?php #echo $globalclass->generateQRCode($QRCODE); ?>
            </div>

        </div>

        <!-- end hrmghs -->

    </div>
</section>
<button type="submit" name="change_password" class="btn btn-black btn-print" onclick="window.print();">Print</button>

</body>

</html>