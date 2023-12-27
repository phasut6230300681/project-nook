<?php
session_start();


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
    <div class="login-container d-flex flex-column justify-content-around">
        <div class="logo text-center">
            <img width="60%" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/61/ENG_th-flat_transparent_%281%29.gif/300px-ENG_th-flat_transparent_%281%29.gif" alt="Logo">
            <p class="mt-3 fs-4">เข้าใช้งานระบบลงทะเบียน</p>
            <p id="errorLog" class="bg-danger"></p>
        </div>

        <div class="login-form">
            <form action="login.php" method="post">
                <input id="email" class="form-control rounded-3 border border-2 border-dark" type="email" placeholder="Enter email" name="email">
                <input id="password" class="form-control mt-3 rounded-1 border border-2 border-dark" type="password" placeholder="Enter password" name="password">
                <h6 class="text-end mb-3">Forget password ?</h6>
                <div class="mt-2 d-flex justify-content-center align-items-center text-center">
                    <input name="login-teacher" id="login-teacher" type="submit" value="Login Teacher" class="bg-warning fs-6 p-1 border-0 rounded-3"></input>
                    <h6 class="ms-2 me-2">Or</h6>
                    <input name="login-admin" type="submit" value="Login Admin" class="bg-warning fs-6 p-1 border-0 rounded-3"></input>
                </div>
            </form>
        </div>
    </div>

    <script>
        //error log
        document.getElementById("login-teacher").addEventListener('click', () => {
            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;

            if (email == '' && password == '') {
                document.getElementById('errorLog').innerText = 'Please enter both email and password';
                event.preventDefault();
            } else if (email == '') {
                document.getElementById('errorLog').innerText = 'Please enter email';
                event.preventDefault();
            } else if (password == '') {
                document.getElementById('errorLog').innerText = 'Please enter password';
                event.preventDefault();
            }
        });
    </script>
    <!-- if email,password not null check user in database-->
    <?php
    if (isset($_POST['login-teacher']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($email != '' && $password != '')
        {

            $_SESSION['user'] = $email;
            header("Location: https://www.google.co.th/");
            exit;
        }
    }
    ?>
</body>

</html>