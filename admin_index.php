<?php
session_start();
//include_once("./include/db.php");
include("./include/function.php");
?>
<?php
// not admin
if ($_SESSION['login_type'] != "admin") {
    session_destroy();
    header("location: login.php");
}

//logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("location: login.php");
}

//add branch
if (isset($_POST['add_branch'])) {
    $branch_name = $_POST['branch_name'];
    $branch_tag = $_POST['branch_tag'];
    $branch_code_tag = $_POST['branch_code_tag'];
    if (Branch::rowCount($branch_name, $branch_tag, $branch_code_tag) >= 1) {
        $_SESSION['error_log'] = "ข้อมูลซํ้า";
        header("location: admin_index.php?branch_add");
        exit();
    } else {
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
//Delete branch --> bin icon 
if (isset($_GET['branch_delete_tag'])) {
    $branch_delele_tag = $_GET['branch_delete_tag'];
    $sql = "DELETE FROM branch WHERE branch_tag=:b";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":b", $branch_delele_tag);
    $stmt->execute();

    header("location: admin_index.php?branch");
    exit();
}
//add member
if (isset($_POST['add_member'])) {
    $user = $_POST['add_user']; //ชื่อ
    $email = $_POST['add_email']; //เมล
    $tag = $_POST['tag']; //T-?
    $role = "Professer";

    if (Member::rowCount($email) >= 1) {
        $_SESSION['error_log'] = "ผู้ใช้ซํ้า โปรดกรอกข้อมูลใหม่";
        header("location: admin_index.php?branch&branch_add_member=$tag");
        exit();
    }

    $sql = "INSERT INTO user (username,role,firstname_lastname,branch) VALUES (:e,:t,:fn,:b)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":e", $email);
    $stmt->bindParam(":t", $role);
    $stmt->bindParam(":fn", $user);
    $stmt->bindParam(":b", $tag);
    $stmt->execute();

    header("location: admin_index.php?branch&view_member_tag=$tag");
    exit();
}
//delete member
if (isset($_GET['delete_id'])) {

    $id = $_GET['delete_id'];
    $sql = "DELETE FROM user WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    header("location: admin_index.php?branch&view_member_tag=$tag");
    exit();
}
//update role

if (isset($_POST['role_change'])) {
    $role = $_POST['role_select'];
    $id = $_POST['id'];
    $tag = $_POST['tag'];
    $sql = "UPDATE user SET role=:r WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":r", $role);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    header("location: admin_index.php?branch&view_member_tag=$tag");
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
        <!-- left sidebar -->
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
        <!-- end left sidebar -->

        <!-- right page -->
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
                        <a href="admin_index.php?branch&branch_add" id="btn-add"><button class="btn border border-dark " style="background-color: #DCFFCB;width:120px;">+ Branch</button></a>
                    </span>
                </div>
                <div class="branch-info-container mt-4 ">
                    <!-- each branch  -->
                    <?php foreach (Branch::showAll()->fetchAll() as $row) : ?>
                        <div class="branch-info border border-dark rounded-3">
                            <div class="d-flex flex-column justify-content-between h-100">
                                <span class="material-symbols-outlined w-100 text-end"> more_horiz </span>
                                <a href="admin_index.php?branch&view_member_tag=<?php echo $row['branch_tag'] ?>" id="view-branch-member-container" class="text-decoration-none text-dark position-relative">
                                    <div class="w-100 text-center h3">
                                        <?php echo $row['branch_tag'] . "<br>"; ?>
                                        <h6>
                                            <?php echo $row['branch_code_tag']; ?>
                                        </h6>
                                    </div>
                                    <div class="position-absolute text-center w-100 top-0">
                                        <h4 id="view-branch-member">
                                            View <?php echo $row['branch_tag']; ?> member
                                        </h4>
                                    </div>
                                </a>
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
                <?php if (isset($_GET['branch_add'])) : ?>
                    <div id="add-branch-container" class="position-fixed start-0 top-0 w-100 h-100 text-body d-flex justify-content-center align-items-center">
                        <div class="text-white text-center">
                            <form action="admin_index.php" id="add-branch-menu" class="p-3 text-dark" method="post">
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
                                        <a href="admin_index.php?branch" class="btn btn-danger text-white text-decoration-none">Cancel</a>
                                        <button type="submit" name="add_branch" value="Create" class="btn btn-success">Create</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
                <!-- end add branch -->

                <!-- each branch can click to add member and view-->
                <?php if (isset($_GET['view_member_tag'])) : ?>
                    <?php
                    $tag = $_GET['view_member_tag']; //tag
                    ?>
                    <div id="view-member-full-page" class=" position-fixed top-0 start-0 w-100 h-100 text-white d-flex justify-content-center align-items-center">
                        <div id="view-member-container" class="text-dark position-relative">
                            <div class="position-absolute end-0">
                                <span class="material-symbols-outlined">
                                    <a href="admin_index.php?branch" class=" text-decoration-none link-danger">close</a>
                                </span>
                            </div>
                            <div id="view-member-header" class="d-flex align-items-center justify-content-between p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="material-symbols-outlined">
                                        <span style="font-size: 70px;">person</span>
                                    </span>
                                    <span class="material-symbols-outlined">

                                        <span style="font-size: 70px;">arrow_forward</span>
                                    </span>
                                    <span class="text-dark h1"><?php echo $tag; ?></span>
                                </div>
                                <div>
                                    <a href="admin_index.php?branch&branch_add_member=<?php echo $tag; ?>" id="btn-add"><button class="btn border border-dark " style="background-color: #DCFFCB;width:120px;">+ Member</button></a>
                                </div>
                            </div>
                            <br>
                            <table id="show-member" class="table table-hover table-striped w-100 p-2" id="jQueryTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <!-- <th>Faculty</th>
                                        <th>Branch</th> -->
                                        <th style="width: 250px;">Role</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $rowCount = 0 ?>
                                    <?php foreach (Member::fetchAllByBranch($tag) as $row) : ?>
                                        <tr>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['firstname_lastname'] ?></td>
                                            <td><?php echo $row['username'] ?></td>
                                            <td style="width: 250px;">
                                                <?php echo $row['role'] ?><span id="open-form[<?php echo $rowCount ?>]" class="open-form material-symbols-outlined ms-1">settings</span>
                                                <form action="admin_index.php" method="post" id="form-role[<?php echo $rowCount ?>]" class="form-role">
                                                    <div class=""></div>
                                                    <select name="role_select" id="" class="form-select">
                                                        <option value="Professor(SM)">Professor(SM)</option>
                                                        <option value="Professor">Professor</option>
                                                    </select>
                                                    <span><input name="role_change" type="submit" value="Change" class=" btn btn-success"></span>
                                                    <input type="hidden" name="tag" value="<?php echo $tag; ?>">
                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                </form>
                                            </td>
                                            <td><a href="admin_index.php?branch&view_member_tag=T-12&delete_id=<?php echo $row['id'] ?>" class=" btn btn-danger ">Delete</a></td>
                                        </tr>
                                        <?php $rowCount = $rowCount + 1 ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                <?php endif; ?>
                <!-- end click brach to view and add member -->

                <!-- add member -->
                <?php if (isset($_GET['branch_add_member'])) : ?>
                    <?php $tag = $_GET['branch_add_member'] ?>
                    <div id="view-member-full-page" class=" position-fixed top-0 start-0 w-100 h-100 text-white d-flex justify-content-center align-items-center">
                        <div class="text-white text-center">
                            <form action="admin_index.php" id="add-branch-menu" class="p-3 text-dark" method="post">
                                <h2> Add member</h2>
                                <div class="mt-2">
                                    <label class="w-100 text-start">Firstname Lastname</label>
                                    <input type="text" name="tag" value="<?php echo $tag; ?>" id="" hidden>
                                    <input required oninvalid="this.setCustomValidity('โปรดใส่ข้อมูล')" oninput="this.setCustomValidity('')" type="text" name="add_user" id="add-user" class="form-control">
                                </div>
                                <div class="mt-2">
                                    <label class="w-100 text-start">Email</label>
                                    <input required oninvalid="this.setCustomValidity('โปรดใส่ข้อมูล')" oninput="this.setCustomValidity('')" type="email" name="add_email" id="add-email" class="form-control">
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center ">
                                    <span class="">
                                        <?php if (isset($_SESSION['error_log'])) : ?>
                                            <div class="alert alert-danger warning alert-dismissible fade show" role="alert">
                                                <strong><?php echo $_SESSION['error_log'] ?></strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                            <?php unset($_SESSION['error_log']); ?>
                                        <?php endif; ?>
                                    </span>
                                    <span>
                                        <a href="admin_index.php?branch&view_member_tag=<?php echo $tag; ?>" class="btn btn-danger text-white text-decoration-none">Cancel</a>
                                        <button type="submit" name="add_member" value="Create" class="btn btn-success">Create</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
                <!-- end add member -->
            <?php endif ?>
            <!-- end open branch -->

            <!-- open member -->
            <?php if (isset($_GET['member'])) : ?>

            <?php endif; ?>
            <!-- end open member -->
        </section>
        <!-- end right page -->
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
    <!-- jquery table -->
    <script>
        new DataTable('#jQueryTable', {
            info: false,
            scrollX: true,
            scrollCollapse: true,
            scrollY: '50vh'

        });
    </script>
    <script>
        //open role setting  
        const RowCount = <?php echo $rowCount; ?>;
        for (let i = 0; i < RowCount; i++) {
            let open_form = document.getElementById("open-form" + "[" + i + "]")
            open_form.addEventListener('click', () => {
                let form_role = document.getElementById("form-role" + "[" + i + "]")
                if (form_role.style.display === "none") {
                    form_role.style.display = "block"
                } else {
                    form_role.style.display = "none"
                }
            })
        }
    </script>
</body>






</html>