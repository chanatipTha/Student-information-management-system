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
            $sql = "INSERT INTO `std_info`(`id`, `en_name`, `en_surname`, `th_name`, `th_surname`, `major_code`, `email`) VALUES 
            ('$id','$en_name','$en_surname','$th_name','$th_surname','$major_code','$email')";
            $query = mysqli_query($connection, $sql);
            if(!$query){
                $error["id"] = "*มีผู้ใช้รหัสนักศึกษานี้แล้ว กรุณาเปลี่ยนรหัสนักศึกษา";
            }else{
                header("Location: ./create_procress.php");
                exit();
            }
        }
    }
    ?>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="container mt-5  justify-content-center">
        <h1 class="d-flex justify-content-center">Insert New Record</h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="row g-3 mt-5">
                    <div class="col-12 mb-3">
                        <label for="id" class="form-label">ID</label>
                <?php if ($error["id"]) { ?>
                    <input name="id" type="text" class="form-control is-invalid" id="id">
                    <div class="invalid-feedback"><?php echo $error["id"]; ?></div>
                <?php } else if (!empty($id)) { ?>
                    <input name="id" type="text" class="form-control is-valid" id="id" value="<?php echo $id; ?>">
                <?php } else { ?>
                    <input name="id" type="text" class="form-control" id="id">
                <?php } 
                ?>
                    </div>
                    <div class="col-md-6">
                    <label for="std_en_name" class="form-label">Name</label>
                <?php if ($error["en_name"]) { ?>
                    <input name="en_name" type="text" class="form-control is-invalid" id="std_en_name">
                    <div class="invalid-feedback"><?php echo $error["en_name"]; ?></div>
                 <?php } else if (!empty($en_name)) { ?>
                    <input name="en_name" type="text" class="form-control is-valid" id="std_en_name" value="<?php echo $en_name; ?>">
                <?php } else { ?>
                    <input name="en_name" type="text" class="form-control" id="std_en_name">
                <?php } ?>
                    </div>
                    <div class="col-md-6">
                    <label for="en_surname" class="form-label">Surname</label>
                <?php if ($error["en_surname"]) { ?>
                    <input name="en_surname" type="text" class="form-control is-invalid" id="en_surname">
                    <div class="invalid-feedback"><?php echo $error["en_surname"]; ?></div>
                <?php } else if (!empty($en_surname)) { ?>
                    <input name="en_surname" type="text" class="form-control is-valid" id="en_surname" value="<?php echo $en_surname; ?>">
                <?php } else { ?>
                    <input name="en_surname" type="text" class="form-control" id="en_surname">
                <?php }
                ?> 
                    </div>
                    <div class="col-md-6">
                    <label for="th_name" class="form-label">ชื่อ</label>
                <?php if ($error["th_name"]) { ?>
                    <input name="th_name" type="text" class="form-control is-invalid" id="th_name">
                    <div class="invalid-feedback"><?php echo $error["th_name"]; ?></div>
                <?php } else if (!empty($th_name)) { ?>
                    <input name="th_name" type="text" class="form-control is-valid" id="th_name" value="<?php echo $th_name; ?>">
                <?php } else { ?>
                    <input name="th_name" type="text" class="form-control" id="th_name">
                <?php } ?>
                    </div>
                    <div class="col-md-6">
                    <label for="th_surname" class="form-label">นามสกุล</label>
                <?php if ($error["th_surname"]) { ?>
                    <input name="th_surname" type="text" class="form-control is-invalid" id="th_surname">
                    <div class="invalid-feedback"><?php echo $error["th_surname"]; ?></div>
                <?php } else if (!empty($th_surname)) { ?>
                    <input name="th_surname" type="text" class="form-control is-valid" id="th_surname" value="<?php echo $th_surname; ?>">
                <?php } else { ?>
                    <input name="th_surname" type="text" class="form-control" id="th_surname">
                <?php } ?>
                    </div>
                    <div class="mb-3">
                    <label for="major_code" class="form-label">Major</label>
                <?php if ($error["major_code"]) { ?>
                    <input name="major_code" type="text" class="form-control is-invalid" id="major_code">
                    <div class="invalid-feedback"><?php echo $error["major_code"]; ?></div>
                <?php } else if (!empty($major_code)) { ?>
                    <input name="major_code" type="text" class="form-control is-valid" id="major_code" value="<?php echo $major_code; ?>">
                <?php } else { ?>
                    <input name="major_code" type="text" class="form-control" id="major_code">
                <?php } ?>
                    </div>
                    <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                <?php if ($error["email"]) { ?>
                    <input name="email" type="text" class="form-control is-invalid" id="email">
                    <div class="invalid-feedback"><?php echo $error["email"]; ?></div>
                <?php } else if (!empty($email)) { ?>
                    <input name="email" type="text" class="form-control is-valid" id="email" value="<?php echo $email; ?>">
                <?php } else { ?>
                    <input name="email" type="text" class="form-control" id="email">
                <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <a href="./index.php " class="btn btn-warning ">Back</a>
                </form>
            
        </div>
    </div>
    <?php mysqli_close($connection); ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>