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
<?php require_once('./connection.php'); ?>
    <div class="container mt-5">
        <table class="table  table-striped">
            <thead class="table-danger">
                <th>#</th>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>Major</th>
                <th>Email</th>
                <th>ลบ</th>
                <th>แก้ไข</th>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT `id`, `en_name`, `en_surname`, `th_name`, `th_surname`, `major_code`, `email` FROM `std_info`";
                    $query = mysqli_query($connection, $sql);
                    if(!$query){
                        die('เกิดข้อผิดพลาดในการแสดงข้อมูล');
                    }else{
                        $index = 1;
                        while($result = mysqli_fetch_object($query)){
                ?>
                        <tr>
                            <th><?php echo $index ?></th>
                            <td><?php echo $result->id ?></td>
                            <td><?php echo $result->en_name ?></td>
                            <td><?php echo $result->en_surname ?></td>
                            <td><?php echo $result->th_name ?></td>
                            <td><?php echo $result->th_surname ?></td>
                            <td><?php echo $result->major_code ?></td>
                            <td><?php echo $result->email ?></td>
                            <td><a href="./delete_process.php?id=<?php echo $result->id ?>" class="btn btn-warning">x</a></td>
                            <td><a href="./update_form.php?id=<?php echo $result->id ?>" class="btn btn-danger">Edit</a></td>
                            
                        </tr>
                <?php ++$index; } } ?>
            </tbody>
        </table>
        <div><a href="create_form.php" class="btn btn-success">Insert New Record</a></div>
    </div>
    <?php mysqli_close($connection); ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>