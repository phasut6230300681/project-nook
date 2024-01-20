<?php
session_start();
include("./include/db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php
    include('./include/bootstrap.php')
    ?>
    <!--  -->
    <link rel="stylesheet" href="/css/login.css">
</head>



<body>
    <div class="login-container d-flex flex-column justify-content-around overflow-hidden ">
        <div class="text-center">
            <img width="50%" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/61/ENG_th-flat_transparent_%281%29.gif/300px-ENG_th-flat_transparent_%281%29.gif" alt="Logo">
            <p class="mt-3 fs-4">เข้าใช้งานระบบลงทะเบียน</p>

            <div>
                <?php if (isset($_SESSION['error_login'])) : ?>
                    <div class="alert alert-danger d-flex align-items-center h6 justify-content-between" role="alert">
                        <div class=" d-flex justify-content-center align-items-center">
                            <img src="./image/warning.png" class="me-3" alt="">
                            <div id=""> <?php echo $_SESSION["error_login"] ?> </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['error_login']); ?>
                <?php endif; ?>
            </div>
        </div>
        <!-- professor -->
        <div id="professor-login" class="p-3">
            <h5 class="ms-3">สำหรับ Professor</h5>
            <div class=" text-center">
                <img src="/image/google_logo.png" width="200px" alt="" srcset="" class=" border border-dark">
            </div>
        </div>
        <!-- admin  -->
        <div id="admin-login" class="login-form p-3">
            <form action="login.php" method="post">
                <h5 class="ms-3">สำหรับ Admin</h5>
                <div class="d-flex  flex-column align-items-center justify-content-center">
                    <input required id="username" oninvalid="this.setCustomValidity('โปรดใส่ username')" oninput="this.setCustomValidity('')" class="form-control rounded-3 border border-2 border-dark" type="text" placeholder="Enter username" name="username">
                    <input required id="password" oninvalid="this.setCustomValidity('โปรดใส่ password')" oninput="this.setCustomValidity('')" class="form-control mt-3 rounded-1 border border-2 border-dark" type="password" placeholder="Enter password" name="password">
                </div>
                <!-- <h6 class="text-end mb-3">Forget password ?</h6> -->
                <div class="mt-2 d-flex justify-content-center align-items-center text-center">
                    <input name="login" id="login" type="submit" value="Login Admin" class="bg-warning fs-6 p-1 border-0 rounded-3"></input>
                </div>
            </form>
        </div>
    </div>
    <!-- end login -->


    <!-- if email,password not null check user in database-->
    <?php
    if (isset($_POST['login']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($username != '' && $password != '')
        {

            // $_SESSION['user'] = $email;
            // header("Location: https://www.google.co.th/");
            $sql = "SELECT * FROM user WHERE username=:username AND password=:password";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $stmt->execute();
            //มี user ใน database    
            if ($stmt->rowCount() == 1)
            {
                $_SESSION['user'] = $username;

                echo "<script>console.log(" . $stmt->rowCount() . ");</script>";
                header("location: https://www.google.co.th/");
                exit();
            }
            // ไม่มีข้อมูล
            else
            {
                $_SESSION['error_login'] = "User not found";
                header("Location: login.php");
                exit();
            }

            exit;
        }
    }
    ?>
</body>


</html>