<?php
$servername= "localhost";
$username= "root";
$password= "";
$dbname= "db1";

//connection
$con =mysqli_connect($servername,$username,$password,$dbname);
$update=null;
$nid = null;
$ntitle = null;
$ncategory = null;
$nimage = null;
$ncontent =null;

if(!$con){
    die(" connection is failed ".mysqli_connect_error());
}

$results = mysqli_query($con, "SELECT * FROM `haber` Order By Created_date Desc Limit 5");

if (isset($_POST['save'])) {
    $Id = $_POST['Id'];
    $title = $_POST['Title'];
    $Category = $_POST['Category'];
    $Image = $_POST['Category'];
    $Content = $_POST['Content'];


    mysqli_query($con, "INSERT INTO haber (Id,Title,Category,Image,Content) VALUES ('$Id','$title','$Category','$Image','$Content')");
}
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($con, "SELECT * FROM haber WHERE Id=$id");
    echo "edit button click ıd ".$id;
        $n = mysqli_fetch_array($record);
        $nid = $n['Id'];
        $ntitle = $n['Title'];
        $ncategory = $n['Category'];
        $nimage = $n['Image'];
        $ncontent =$n['Content'];

}
if (isset($_POST['update'])) {
    $id = $_POST['Id'];
    $Title = $_POST['Title'];
    $Category = $_POST['Category'];
    $Image = $_POST['Image'];
    $Content = $_POST['Content'];

    mysqli_query($con, "UPDATE haber SET Title='$Title', Category='$Category',Image='$Image',Content='$Content' WHERE id=$id");

}
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($con, "DELETE FROM haber WHERE id=$id");

}

?>
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Category</th>
        <th>Image</th>
        <th>Content</th>
        <th>Edit</th>
        <th>Delete</th>

    </tr>
    </thead>

    <?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
            <td><?php echo $row['Id']; ?></td>
            <td><?php echo $row['Title']; ?></td>
            <td><?php echo $row['Category']; ?></td>
            <td><?php echo $row['Image']; ?></td>
            <td><?php echo $row['Content']; ?></td>
            <td>
                <a href="index.php?edit=<?php echo $row['Id']; ?>" class="edit_btn" >Edit</a>
            </td>
            <td>
                <a href="index.php?del=<?php echo $row['Id']; ?>" class="del_btn">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>




<html>
<head>
    <title>Haber Crud</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>



<form method="post" action="index.php" >
    <div class="input-group">
        <label>Id</label>
        <input type="text" name="Id" value="<?php echo $nid; ?>">
    </div>
    <div class="input-group">
        <label>Title</label>
        <input type="text" name="Title" value="<?php echo $ntitle; ?>">
    </div>
    <div class="input-group">
        <label for="category">Category</label>
        <select name="Category" id="" value="<?php echo $ncategory; ?>">
            <option value="First">First</option>
            <option value="Second">Second</option>
        </select>
    </div>
    <div class="input-group">
        <label>Image</label>
        <input type="text" name="Image" value="<?php echo $nimage; ?>">
    </div>
    <div class="input-group">
        <label>Content</label>
        <input type="text" name="Content" value="<?php echo $ncontent; ?>">
    </div>

    <div class="input-group">
        <?php if ($update == true): ?>
            <button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
        <?php else: ?>
            <button class="btn" type="submit" name="save" >Save</button>
        <?php endif ?>
    </div>

</form>
</body>
</html>
