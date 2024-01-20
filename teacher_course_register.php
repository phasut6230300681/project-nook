<?php include('./include/db.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- copy -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- bootstrap -->
    <?php include('./include/bootstrap.php') ?>
    <!-- title -->
    <title>Teacher course register</title>
    <!-- css -->
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
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul id="nav-header" class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">ตารางสอน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">ดูวิชาที่เปิด</a>
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
                                    <img src="/image/home_FILL0_wght400_GRAD0_opsz24.png" alt=""> <span class="ms-1 d-none d-sm-inline dropdown-toggle">Bootstrap </span></a>
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
                    <form action="">
                        <table class="table">
                            <thead class="">
                                <tr>
                                    <th scope="col" style="max-width:150px;width:150px">Course ID</th>
                                    <th scope="col" style="max-width:200px;width:200px">Course name</th>
                                    <th scope="col" style="max-width:150px;width:150px">Start time</th>
                                    <th scope="col" style="max-width:150px;width:150px">End time</th>
                                    <th scope="col" style="max-width:150px;width:150px">Room</th>
                                    <th scope="col" style="max-width:150px;width:150px">รูปแบบ</th>
                                    <th scope="col" style="max-width:150px;width:150px">หมู่เรียน</th>
                                    <!-- <th scope="col" style="width:70px">ยื่นยัน</th> -->
                                </tr>
                            </thead>
                            <tbody id="tableForm">

                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="6" class=" border-0"></td>
                                    <td class=" border-0"><input type="submit" id="btn-submit" value="Submit" class="btn btn-primary mt-3 mb-3 border-0"></td>
                                </tr>
                            </tfoot>
                        </table>

                    </form>

                    <div id="btn-add-remove" class="w-100">
                        <div id="btn-group">
                            <button id="remove" class="btn btn-danger"><img src="/image/remove.png" alt="">Remove Row</button>
                            <button id="add" class="btn  btn-success"><img src="/image/add.png" alt="">Add Row</button>
                        </div>
                    </div>
                    <!-- end register -->

                    <!-- course status -->
                    <div>
                        ตารางขอลงทะเบียนด้านล่าง(ยังไม่ทำ)

                    </div>
                </div>

            </div>
            <!-- div container -->
        </div>
        <!-- end main container -->

    </main>

    <!-- end center -->
    <script>
        rowCount = 0
        document.getElementById('btn-submit').disabled = true;
        // add
        document.getElementById('add').addEventListener('click', () => {
            let tableForm = document.getElementById('tableForm')
            let tr = document.createElement('tr')
            const inputName = ["course_id[]", "course_name[]", "start_time[]", "end_time[]", "room[]", "format[]", "sec[]", "submit[]"];
            const inputType = ["number", "text", "number", "number", "number", "text", "number", "submit"];
            for (let i = 0; i < 8 - 1; i++) {
                let td = document.createElement("td")
                let input = document.createElement("input")
                input.type = inputType[i];
                input.name = inputName[i];
                if (i != 4) {
                    input.setAttribute('required', 'true');
                }
                td.appendChild(input)
                tr.appendChild(td)
            }
            tableForm.appendChild(tr)
            rowCount++
            console.log(rowCount);
            updateRowCount()
        });
        // remove
        document.getElementById('remove').addEventListener('click', () => {
            let tableForm = document.getElementById('tableForm');
            tableForm.deleteRow(tableForm.rows.length - 1);
            if (rowCount == 0) {
                rowCount = 0
            } else {
                rowCount--
            }
            console.log(rowCount);
            updateRowCount()
        });
        // submit
        function updateRowCount() {
            if (rowCount == 0) {
                document.getElementById('btn-submit').disabled = true;
            } else if (rowCount > 0) {
                document.getElementById('btn-submit').disabled = false;
            }
        }
    </script>

</body>

</html>