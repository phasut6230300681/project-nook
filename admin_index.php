<?php
session_start();
//include_once("./include/db.php");
include("./include/function.php");
?>
<?php
// not admin
if ($_SESSION['login_type'] != "admin")
{
    session_destroy();
    header("location: login.php");
}

//logout
if (isset($_GET['logout']))
{
    session_destroy();
    header("location: login.php");
}

//branch
if (isset($_POST['add_branch']))
{
    $branch_name = $_POST['branch_name'];
    $branch_tag = $_POST['branch_tag'];
    $branch_code_tag = $_POST['branch_code_tag'];
    if (Branch::isFound($branch_name, $branch_tag, $branch_code_tag) >= 1)
    {
        $_SESSION['error_log'] = "ข้อมูลซํ้า";
        header("location: admin_index.php?branch&add");
        exit();
    }
    else
    {
        $sql = "INSERT INTO branch (branch_name,branch_tag,branch_code_tag) VALUES (:name, :tag, :code)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":name", $branch_name);
        $stmt->bindParam(":tag", $branch_tag);
        $stmt->bindParam(":code", $branch_code_tag);
        $stmt->execute();

        header("Location: admin_index.php?branch");
        exit();
    }
}
//Delete branch menu 
if (isset($_GET['branch_delete_tag']))
{
    $branch_delele_tag = $_GET['branch_delete_tag'];
    $sql = "DELETE FROM branch WHERE branch_tag=:b";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":b", $branch_delele_tag);
    $stmt->execute();

    header("location: admin_index.php?branch");
    exit();
}

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
                    <a href="./admin_index.php?branch" class="nav-link text-dark">
                        <span class="material-symbols-outlined">
                            linked_services
                        </span>
                        Branch
                    </a>
                </li>
                <li>
                    <a href="./admin_index.php?curriculum" class="nav-link  text-dark">
                        <span class="material-symbols-outlined">
                            book
                        </span>
                        Curriculum
                    </a>
                </li>
                <li>
                    <a href="./admin_index.php?member" class="nav-link  text-dark">
                        <span class="material-symbols-outlined">
                            person
                        </span>
                        Member
                    </a>
                </li>
                <li>
                    <a href="./admin_index.php?logout" class="nav-link  text-dark">
                        <span class="material-symbols-outlined">
                            logout
                        </span>
                        Logout
                    </a>
                </li>
            </ul>
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

        <!--  -->
        <section class="p-4">
            <!-- sidebar toggle icon -->
            <span class="material-symbols-outlined">
                <p id="sidebar-toggle">menu</p>
            </span>
            <!-- do not change -->
            <br>
            <!-- open branch -->
            <?php if (isset($_GET['branch'])) : ?>
                <div id="function-container" class="bg-body d-flex align-items-center justify-content-between border border-dark pe-3">
                    <div>
                        <span class="material-symbols-outlined ms-1 bg-body">
                            linked_services
                        </span> Branch
                    </div>
                    <span>
                        <a href="admin_index.php?branch&add" id="btn-add"><button class="btn border border-dark " style="background-color: #DCFFCB;width:120px;">+ Branch</button></a>
                    </span>
                </div>
                <div class="branch-info-container mt-4 ">
                    <!-- each branch  -->
                    <?php foreach (Branch::showAll()->fetchAll() as $row) : ?>
                        <div class="branch-info">
                            <div class="d-flex flex-column justify-content-between h-100">
                                <span class="material-symbols-outlined w-100 text-end"> more_horiz </span>
                                <div class="w-100 text-center h3">
                                    <?php echo $row['branch_tag'] . "<br>"; ?>
                                    <h6><?php echo $row['branch_code_tag']; ?></h6>
                                </div>
                                <span class="material-symbols-outlined w-100 text-end">
                                    <a href="admin_index.php?branch&branch_delete_tag=<?php echo $row['branch_tag'] ?>" class="text-danger text-decoration-none" onclick="return confirm('Delete <?php echo $row['branch_tag'] . '?' ?>')">delete</a>
                                </span>
                            </div>
                            <div class="text-center overflow-hidden fw-bold">
                                <?php echo $row['branch_name']; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!-- end each branch -->
                </div>

                <!-- add branch-->
                <?php if (isset($_GET['add']) && isset($_GET['branch'])) : ?>
                    <div id="add-branch-container" class="position-fixed start-0 top-0 w-100 h-100 bg-dark text-body d-flex justify-content-center align-items-center" style="z-index: 9999;opacity:0.9 ">
                        <div class="text-white text-center" id="add-branch-menu">
                            <form action="admin_index.php" class="p-3 bg-white text-dark" method="post">
                                <h2> Create a faculty</h2>
                                <div class="mt-2">
                                    <label class="w-100 text-start">Branch name</label>
                                    <input required oninvalid="this.setCustomValidity('โปรดใส่ข้อมูล')" oninput="this.setCustomValidity('')" type="text" name="branch_name" id="branch-name" class="form-control">
                                </div>
                                <div class="mt-2">
                                    <label class="w-100 text-start">Branch tag</label>
                                    <input required oninvalid="this.setCustomValidity('โปรดใส่ข้อมูล')" oninput="this.setCustomValidity('')" type="text" name="branch_tag" id="branch-tag" class="form-control">
                                </div>
                                <div class="mt-2">
                                    <label class="w-100 text-start">Branch code tag</label>
                                    <input required oninvalid="this.setCustomValidity('โปรดใส่ข้อมูล')" oninput="this.setCustomValidity('')" type="text" name="branch_code_tag" id="branch-code-tag" class="form-control">
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center ">
                                    <span class="">
                                        <?php if (isset($_SESSION['error_log'])) : ?>
                                            <div class="alert alert-danger warning alert-dismissible fade show" role="alert">
                                                <strong>ข้อมูลซํ้าโปรดกรอกข้อมูลใหม่</strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                            <?php unset($_SESSION['error_log']); ?>
                                        <?php endif; ?>
                                    </span>
                                    <span>
                                        <button class="btn btn-danger">
                                            <a href="admin_index.php?branch" class=" text-white text-decoration-none ">
                                                Cancel
                                            </a>
                                        </button>
                                        <button type="submit" name="add_branch" value="Create" class="btn btn-success">Create</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
                <!-- end add branch -->
            <?php endif ?>
            <!-- end open branch -->

            <!-- member -->
            <?php if (isset($_GET['member'])) : ?>
                <div id="function-container" class="bg-body d-flex align-items-center justify-content-between border border-dark pe-3">
                    <div>
                        <span class="material-symbols-outlined ms-1 bg-body">
                            Person
                        </span> Member
                    </div>
                    <span>
                        <a href="admin_index.php?member&add" id="btn-add"><button class="btn border border-dark " style="background-color: #DCFFCB;width:120px;">+ Member</button></a>
                    </span>
                </div>
                <div class="branch-info-container mt-4 ">
                    <!-- each branch  -->
                    <?php foreach (Branch::showAll()->fetchAll() as $row) : ?>
                        <div class="branch-info">
                            <div class="d-flex flex-column justify-content-center align-items-center h-100">
                              
                                <div class="w-100 text-center h3">
                                    <?php echo $row['branch_tag'] . "<br>"; ?>
                                    <h6><?php echo $row['branch_code_tag']; ?></h6>
                                </div>
                            </div>
                            <div class="text-center overflow-hidden fw-bold">
                                <?php echo $row['branch_name']; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!-- end each branch -->
                </div>

                <!-- add member -->
                <?php if (isset($_GET['add']) && isset($_GET['member'])) : ?>
                    <div id="add-branch-container" class="position-fixed start-0 top-0 w-100 h-100 bg-dark text-body d-flex justify-content-center align-items-center" style="z-index: 9999;opacity:0.9 ">
                        <div class="text-white text-center" id="add-branch-menu">
                            <form action="admin_index.php" class="p-3 bg-white text-dark" method="post">
                                <h2> Add member</h2>
                                <div class="mt-2">
                                    <label class="w-100 text-start">Firstname-Lastname</label>
                                    <input required oninvalid="this.setCustomValidity('โปรดใส่ข้อมูล')" oninput="this.setCustomValidity('')" type="text" name="branch_name" id="member-name" class="form-control">
                                </div>
                                <div class="mt-2">
                                    <label class="w-100 text-start">Email</label>
                                    <input required oninvalid="this.setCustomValidity('โปรดใส่ข้อมูล')" oninput="this.setCustomValidity('')" type="email" name="branch_tag" id="member-email" class="form-control">
                                </div>

                                <hr>
                                <div class="d-flex justify-content-between align-items-center ">
                                    <span class="">
                                        <?php if (isset($_SESSION['error_log'])) : ?>
                                            <div class="alert alert-danger warning alert-dismissible fade show" role="alert">
                                                <strong>ข้อมูลซํ้าโปรดกรอกข้อมูลใหม่</strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                            <?php unset($_SESSION['error_log']); ?>
                                        <?php endif; ?>
                                    </span>
                                    <span>
                                        <button class="btn btn-danger">
                                            <a href="admin_index.php?branch" class=" text-white text-decoration-none ">
                                                Cancel
                                            </a>
                                        </button>
                                        <button type="submit" name="add_branch" value="Create" class="btn btn-success">Create</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <!-- end member -->
        </section>
    </main>
    <!-- end main -->

    <!-- responsive -->
    <script>
        // responsive
        let toggle = document.getElementById("sidebar-toggle")

        let sidebar = document.getElementById("sidebar")
        let section = document.querySelector("section")

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
        // end responsive
    </script>
</body>
<!-- add branch to database -->




</html>