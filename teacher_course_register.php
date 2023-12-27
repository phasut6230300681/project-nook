<!DOCTYPE html>
<html lang="en">

<head>
    <!-- copy -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('./include/bootstrap.php') ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- title -->
    <title>Teacher course register</title>
    <!-- csss -->
    <link rel="stylesheet" href="./css/teacher_course_register.css">
</head>

<body>
    <!-- top -->
    <header class="navbar navbar-expand-lg navbar-light w-100" style="background-color: #046b64;">
        <div class="container-fluid">
            <!-- logo -->
            <img class="navbar-brand" src="./image/ku_logo.png" alt="kusrc logo">
            <!-- toggle button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- list nav -->
            <div class="collapse navbar-collapse bg-body" id="navbarSupportedContent">
                <ul id="nav-header" class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">ตารางสอน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                    <li class="nav-item">
                        <img class="pt-2" src="./image/notifications_logo.png" alt="">
                    </li>


                </ul>
                <!-- nav right -->
                <div class="right">
                    <img class="me-3" id="user-logo" src="./image/book.jpg" alt="">
                    <span class="me-2">ชื่อ-สกุล</span>
                </div>
            </div>
        </div>
    </header>
    <!-- end top -->

    <!-- center -->
    <main class="d-flex">
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <!-- sidebar -->
                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <span class="fs-5 d-none d-sm-inline text-dark">Menu</span>
                        </a>
                        <!-- side bar item -->
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                            <!-- home -->
                            <li class="nav-item">
                                <a href="#" class="nav-link align-middle px-0">
                                    <img src="/image/home_FILL0_wght400_GRAD0_opsz24.png" alt="">
                                    <span class="ms-1 d-none d-sm-inline">
                                        Home
                                    </span>
                                </a>
                            </li>
                            <!-- orders -->
                            <li>
                                <a href="#" class="nav-link px-0 align-middle">
                                    <img src="/image/home_FILL0_wght400_GRAD0_opsz24.png" alt=""> <span class="ms-1 d-none d-sm-inline">Orders</span></a>
                            </li>
                            <li>
                                <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                    <img src="/image/home_FILL0_wght400_GRAD0_opsz24.png" alt=""> <span class="ms-1 d-none d-sm-inline">Bootstrap</span></a>
                                <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                    <li class="w-100">
                                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1</a>
                                    </li>
                                    <li>
                                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <hr>
                    </div>
                </div>
                <!-- end sidebar -->

                <!-- register-->
                <!--  <div id="register" class="col py-3"> -->
                <div id="register" class="col py-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width:100px">Course ID</th>
                                <th scope="col" style="min-width:200px">Course name</th>
                                <th scope="col" style="width:100px">Start time</th>
                                <th scope="col" style="width:100px">End time</th>
                                <th scope="col" style="width:100px">Room</th>
                                <th scope="col" style="width:100px">รูปแบบ</th>
                                <th scope="col" style="width:100px">หมู่เรียน</th>
                            </tr>
                        </thead>
                        <tbody id="tableForm">
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                    <div class="w-100 text-end">
                        <button id="remove" class="btn btn-danger"><img src="/image/remove.png" alt="">Remove Row</button>
                        <button id="add" class="btn  btn-success"><img src="/image/add.png" alt="">Add Row</button>
                    </div>
                </div>
                <!-- end register -->
            </div>
            <!-- div container -->
        </div>
        <!-- end sidebar -->
    </main>
    <!-- end center -->
    <script>
        document.getElementById('add').addEventListener('click', () => {
            let tableForm = document.getElementById('tableForm');
            let newRow = tableForm.insertRow(tableForm.rows.length);
            const inputName = ["course_id", "course_name", "start_time", "end_time", "room", "format", "sec"];
            const inputType = ["number", "text", "number", "number", "number", "text", "number"];
            for (let i = 0; i < 7; i++) {
                let cell = newRow.insertCell(i);
                let input = document.createElement('input');
                input.classList.add
                input.type = inputType[i];
                input.name = inputName[i];
                cell.appendChild(input);
            }
        });

        document.getElementById('remove').addEventListener('click', () => {
            let tableForm = document.getElementById('tableForm');
            if (tableForm.rows.length > 1) {
                tableForm.deleteRow(tableForm.rows.length - 1);
            }
        });
    </script>
</body>

</html>