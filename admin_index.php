<?php
session_start();
include("./include/db.php");
include("./include/function.php")
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- copy  -->
    <?php
    include('./include/bootstrap.php')
    ?>
    <!--  -->
    <link rel="stylesheet" href="./css/admin_index.css">
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
            <div id="navbarSupportedContent" class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul id="nav-header" class="navbar-nav me-auto mb-2 mb-lg-0 w-100 d-flex justify-content-end ">
                    <li class="nav-item ms-3">
                        <img src="./image/notifications_logo.png" alt="">
                    </li>
                    <li class="nav-item ms-3">
                        <?php echo $_SESSION['username'] ?>
                    </li>
                    <li class="nav-item ms-3 ">
                        <span class="material-symbols-outlined">
                            account_circle
                        </span>
                    </li>
                </ul>

            </div>
        </div>
    </header>
    <!-- end top -->

    <!-- main -->
    <main class="d-flex position-relative">
        <!--  -->
        <aside id="sidebar" class="d-flex flex-column flex-shrink-0 text-dark bg-white">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link text-dark">
                        <span class="material-symbols-outlined">
                            linked_services
                        </span>
                        Branch
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link  text-dark">
                        <span class="material-symbols-outlined">
                            book
                        </span>
                        Curriculum
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link  text-dark">
                        <span class="material-symbols-outlined">
                            person
                        </span>
                        Member
                    </a>
                </li>

            </ul>
            <hr>
            <!-- <div class="dropdown">
                <a href="#" class="d-flex align-items-center  text-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>mdo</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div> -->
        </aside>
        <!-- end sidebar -->

        <section id="section">
            <span class="material-symbols-outlined">
                <p id="sidebar-toggle">menu</p>
            </span>
            <br>
            <!-- display -->
            <div id="section-right" class="bg-body d-flex align-items-center justify-content-between border border-dark pe-5">
                <div>
                    <span class="material-symbols-outlined ms-1 bg-body">
                        linked_services
                    </span> Branch
                </div>
                <span>
                    <a href="admin_index.php?branch" id="btn-add"><button class="btn border border-dark " style="background-color: #DCFFCB;width:120px;">+ Branch</button></a>
                </span>
            </div>
        </section>
    </main>
    <!-- end main -->
    <script>
        let toggle = document.getElementById("sidebar-toggle")

        let sidebar = document.getElementById("sidebar")
        let section = document.getElementById("section")

        window.addEventListener("resize", () => {
            let width = window.innerWidth;
            console.log(width);
            //labtop
            if (width > 768) {

                sidebar.style.left = "0%"
                section.style.left = "200px"
            } //ipad 
            else if (width <= 768 && width > 600) {
                sidebar.style.left = "0% "
                section.style.left = "100px"

            } else if (width <= 600) {
                sidebar.style.left = "0%"
                section.style.left = "60px"
            }
        });

        toggle.addEventListener("click", () => {
            let width = window.innerWidth;

            //labtop
            if (width > 768) {
                if (sidebar.style.left === "0%") {
                    sidebar.style.left = "-100%"
                    section.style.left = "0px"
                } else {
                    sidebar.style.left = "0%"
                    section.style.left = "200px"
                }
            } //ipad 
            else if (width <= 768 && width > 600) {
                if (sidebar.style.left === "0%") {
                    sidebar.style.left = "-100%"
                    section.style.left = "0px"
                } else {
                    sidebar.style.left = "0%"
                    section.style.left = "100px"
                }
            } else if (width <= 600) {
                console.log(11);
                if (sidebar.style.left === "0%") {
                    sidebar.style.left = "-100%"
                    section.style.left = "0px"
                } else {
                    sidebar.style.left = "0% "
                    section.style.left = "60px"
                }
            }
        })
    </script>
</body>

</html>