<?php
$servername= "localhost";
$username= "root";
$password= "";
$dbname= "db1";

//connection
$con =mysqli_connect($servername,$username,$password,$dbname);


if(!$con){
    die(" connection is failed ".mysqli_connect_error());
}

$students = mysqli_query($con, "SELECT * FROM student");
$coordinators = mysqli_query($con, "SELECT * FROM coordinator");
$studentcoordinators = mysqli_query($con, "SSELECT * FROM `student_coordinator` WHERE coordinator_id=null");
$studentnull = mysqli_query($con, "SSELECT * FROM `student_coordinator` WHERE student_id=null");
?>
<html>
<head>
    <title>Ogrenci List</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<table>

    <caption><b>OGRENCİ</b></caption>
    <thead>
    <tr>
        <th>Ad Soyad</th>
        <th>Doğum Tarihi</th>

    </tr>
    </thead>

    <?php while ($row = mysqli_fetch_array($students)) { ?>
        <tr>
            <td><?php echo $row['Name_Surname']; ?></td>
            <td><?php echo $row['Birthdate']; ?></td>
        </tr>
    <?php } ?>
</table>
<br>
<br>

<table>

    <caption><b>KORDİNATÖR</b></caption>
    <thead>
    <tr>
        <th>Kordinatör Adı</th>

    </tr>
    </thead>

    <?php while ($row = mysqli_fetch_array($coordinators)) { ?>
        <tr>
            <td><?php echo $row['Coordinator_name']; ?></td>
        </tr>
    <?php } ?>
</table>


<br>
<br>

<table>

    <caption><b>Ogrecisi Olmayan Kordinatörlükler</b></caption>
    <thead>
    <tr>
        <th>Ogrenci Adı</th>
        <th>Kordinator Adı</th>

    </tr>
    </thead>
    <?php while ($row = mysqli_fetch_array($studentcoordinators)) { ?>
        <tr>
            <td><?php echo $row['student_id']; ?></td>
            <td><?php echo $row['coordinator_id']; ?></td>
        </tr>
    <?php } ?>

</table>

<br>
<br>


<table>

    <caption><b>Kordinatörlüğü olmayan Öğrenci</b></caption>
    <thead>
    <tr>
        <th>Ogrenci Adı</th>
        <th>Kordinator Adı</th>

    </tr>
    </thead>
    <?php while ($row = mysqli_fetch_array($studentnull)) { ?>
        <tr>
            <td><?php echo $row['student_id']; ?></td>
            <td><?php echo $row['coordinator_id']; ?></td>
        </tr>
    <?php } ?>

</table>


</html>

