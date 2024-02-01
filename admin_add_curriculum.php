<?php
session_start();
include("./include/function.php");
?>
<?php
isAdmin();
if (!isset($_GET['tag'])) {
    header("location: admin_index.php");
    exit();
} else {
    $tag = $_GET['tag'];
    $branch_code = Branch::getData($tag)['branch_code'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    include("./include/bootstrap.php");
    ?>
    <link rel="stylesheet" href="./css/admin_add_curriculum.css">
</head>

<body class="container-fluid">
    <header class="text-white d-flex">
        <div>
            <p class="fs-3">Course code tag filter</p>
            <input type="number" name="branch_code" id="branch-code" class="ps-2 w-100" disabled value="<?php echo $branch_code ?>">
        </div>
        <div class="ms-5">
            <p class="fs-3">Year</p>
            <input type="number" name="curriculum_year" id="curriculum-year">
        </div>
    </header>
</body>

</html>