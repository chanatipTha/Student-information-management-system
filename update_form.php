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
    $error = [
        "id" => "",
        "email" => "",
        "en_name" => "",
        "en_surname" => "",
        "th_name" => "",
        "th_surname" => "",
        "major_code" => "",
    ];
    $id_old = $_GET["id"];
    $id = $email = $en_name = $en_surname = $th_name = $th_surname = $major_code = "";

    function protectInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        empty($_POST["id"]) ? $error["id"] = "*กรุณากรอกรหัสนักศึกษา" : $id = protectInput($_POST["id"]);
        if(!empty($_POST["email"])){
            !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) ? $error["email"] = "*โปรดระบุ @ เพื่อให้รูปแบบอีเมลถูกต้อง" : $email = protectInput($_POST["email"]);
        }
        empty($_POST["en_name"]) ? $error["en_name"] = "*กรุณากรอกชื่อ" : $en_name = protectInput($_POST["en_name"]);
        empty($_POST["en_surname"]) ? $error["en_surname"] = "*กรุณากรอกนามสกุล" : $en_surname = protectInput($_POST["en_surname"]);
        empty($_POST["th_name"]) ? $error["th_name"] = "*กรุณากรอกชื่อ" : $th_name = protectInput($_POST["th_name"]);
        empty($_POST["th_surname"]) ? $error["th_surname"] = "*กรุณากรอกนามสกุล" : $th_surname = protectInput($_POST["th_surname"]);
        if(!empty($_POST["email"])){
            $major_code = protectInput($_POST["major_code"]);
        }
        if(empty($error["email"]) && empty($error["major_code"]) && !empty($_POST["id"]) && !empty($_POST["en_name"]) && !empty($_POST["en_surname"]) && !empty($_POST["th_name"]) && !empty($_POST["th_surname"])){
            $sql = "UPDATE `std_info` SET `id`='$id',`en_name`='$en_name',`en_surname`='$en_surname',`th_name`='$th_name',`th_surname`='$th_surname',`major_code`='$major_code',`email`='$email' WHERE `id` = $id_old";
            $query = mysqli_query($connection, $sql);
            if(!$query){
                $error["id"] = "*มีผู้ใช้รหัสนักศึกษานี้แล้ว กรุณาเปลี่ยนรหัสนักศึกษา";
            }else{
                header("Location: ./update_procress.php?id=$id");
                exit();
            }
        }
    }
    ?>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="container-body mt-5 ">
            
                <?php
                    $sql = "SELECT `id`, `en_name`, `en_surname`, `th_name`, `th_surname`, `major_code`, `email` FROM `std_info` WHERE `id` = '$id_old'";
                    $query = mysqli_query($connection, $sql);
                    if(!$query){
                        die('การแสดงข้อมูลล้มเหลว');
                    }else{
                        while($result = mysqli_fetch_object($query)){
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $result->id); ?>" method="post" class="row g-3 mt-5">
                <h1 class="d-flex justify-content-center">Edit Record</h1>
                    <div class="col-12 mb-3">
                        <label for="id">ID</label>
                        <?php if ($error["id"]) { ?>
                            <input name="id" type="text" class="form-control is-invalid" id="id">
                            <div class="invalid-feedback"><?php echo $error["id"]; ?></div>
                        <?php } else if (!empty($id)) { ?>
                            <input name="id" type="text" class="form-control is-valid" id="id" value="<?php echo $id; ?>">
                        <?php } else { ?>
                            <input name="id" type="text" class="form-control is-valid" id="id" value="<?php echo $result->id ?>">
                        <?php } ?>
                    </div>
                    <div class="col-md-6">
                        <label for="en_name">Name</label>
                        <?php if ($error["en_name"]) { ?>
                            <input name="en_name" type="text" class="form-control is-valid" id="en_name">
                            <div class="form-control"><?php echo $error["en_name"]; ?></div>
                        <?php } else if (!empty($en_name)) { ?>
                            <input name="en_name" type="text" class="form-control is-valid" id="en_name" value="<?php echo $en_name; ?>">
                        <?php } else { ?>
                            <input name="en_name" type="text" class="form-control is-valid" id="en_name" value="<?php echo $result->en_name ?>">
                        <?php } ?>
                    </div>
                    <div class="col-md-6">
                        <label for="en_surname">Surname</label>
                        <?php if ($error["en_surname"]) { ?>
                            <input name="en_surname" type="text" class="form-control is-valid" id="en_surname">
                            <div class="form-control"><?php echo $error["en_surname"]; ?></div>
                        <?php } else if (!empty($en_surname)) { ?>
                            <input name="en_surname" type="text" class="form-control is-valid" id="en_surname" value="<?php echo $en_surname; ?>">
                        <?php } else { ?>
                            <input name="en_surname" type="text" class="form-control is-valid" id="en_surname" value="<?php echo $result->en_surname ?>">
                        <?php } ?>
                    </div>
                    <div class="col-md-6">
                        <label for="th_name">ชื่อ</label>
                        <?php if ($error["th_name"]) { ?>
                            <input name="th_name" type="text" class="form-control is-valid" id="th_name">
                            <div class="form-control"><?php echo $error["th_name"]; ?></div>
                        <?php } else if (!empty($th_name)) { ?>
                            <input name="th_name" type="text" class="form-control is-valid" id="th_name" value="<?php echo $th_name; ?>">
                        <?php } else { ?>
                            <input name="th_name" type="text" class="form-control is-valid" id="th_name" value="<?php echo $result->th_name ?>">
                        <?php } ?>
                    </div>
                    <div class="col-md-6">
                        <label for="th_surname">นามสกุล</label>
                        <?php if ($error["th_surname"]) { ?>
                            <input name="th_surname" type="text" class="form-control is-valid" id="th_surname">
                            <div class="form-control"><?php echo $error["th_surname"]; ?></div>
                        <?php } else if (!empty($th_surname)) { ?>
                            <input name="th_surname" type="text" class="form-control is-valid" id="th_surname" value="<?php echo $th_surname; ?>">
                        <?php } else { ?>
                            <input name="th_surname" type="text" class="form-control is-valid" id="th_surname" value="<?php echo $result->th_surname ?>">
                        <?php } ?>
                    </div>
                    <div class="mb-3">
                        <label for="major_code">รหัสสาขาเอก</label>
                        <?php if ($error["major_code"]) { ?>
                            <input name="major_code" type="text" class="form-control is-valid" id="major_code">
                            <div class="form-control"><?php echo $error["major_code"]; ?></div>
                        <?php } else if (!empty($major_code)) { ?>
                            <input name="major_code" type="text" class="form-control is-valid" id="major_code" value="<?php echo $major_code; ?>">
                        <?php } else { ?>
                            <input name="major_code" type="text" class="form-control is-valid" id="major_code" value="<?php echo $result->major_code ?>">
                        <?php } ?>
                    </div>
                    <div class="mb-3">
                        <label for="email">อีเมล</label>
                        <?php if ($error["email"]) { ?>
                            <input name="email" type="text" class="form-control is-valid" id="email">
                            <div class="form-control"><?php echo $error["email"]; ?></div>
                        <?php } else if (!empty($email)) { ?>
                            <input name="email" type="text" class="form-control is-valid" id="email" value="<?php echo $email; ?>">
                        <?php } else { ?>
                            <input name="email" type="text" class="form-control is-valid" id="email" value="<?php echo $result->email ?>">
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="./index.php" class="btn btn-secondary">Back</a>
                </form>
                <?php } } ?>
            
        </div>
    </div>
    <?php mysqli_close($connection); ?>
</body>

</html>