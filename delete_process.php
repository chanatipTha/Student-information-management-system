<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
    <title>Student information management system</title>
</head>
<body>
<?php
require_once('./connection.php');

$id = $_GET["id"];
$sql = "DELETE FROM `std_info` WHERE `id` = '$id'";
$query = mysqli_query($connection, $sql);
mysqli_close($connection);
if(!$query){
    die('การลบข้อมูลล้มเหลว');
}else{
?>
    <h1>Delete Record</h1>
    <h1>id <?php echo $id; ?></h1>
    <h1>Successfully!</h1>
    <a href="./index.php" class="btn btn-warning ml-5">Back</a>
<?php } ?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>