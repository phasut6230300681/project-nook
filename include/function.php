<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "se";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    #echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed <br>" . $e;
}
//-------//
function isAdmin() {
    if ($_SESSION['login_type'] != "admin") {
        session_destroy();
        header("location: login.php");
        exit();
    }
}

//-----------------------------//
class RegisterData {
    public static function rowCount($username, $password) {
        global $conn;
        $sql = "SELECT * FROM user WHERE username=:username AND password=:password";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public static function getData($username) {
        global $conn;
        $sql = "SELECT * FROM user WHERE username=:username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        return $row = $stmt->fetch();
    }
}

class Branch {
    public static function rowCount($name, $tag, $code) {
        global $conn;
        $sql = "SELECT * FROM branch WHERE branch_name=:name OR branch_tag=:tag OR branch_code_tag=:code";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":tag", $tag);
        $stmt->bindParam(":code", $code);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public static function showAll() {
        global $conn;
        $sql = "SELECT * FROM branch";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public static function getData($tag) {
        global $conn;
        $sql = "SELECT * FROM branch WHERE branch_tag=:tag";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":tag", $tag);
        $stmt->execute();
        return $stmt->fetch();
    }
}

class Member {
    public static function rowCount($email) {
        global $conn;
        $sql = "SELECT username FROM user WHERE username=:e";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":e", $email);
        $stmt->execute();
        return $stmt->rowCount();
    }
    public static function fetchAllByBranch($branch) {
        global $conn;
        $sql = "SELECT * FROM user WHERE branch=:b";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":b", $branch);
        $stmt->execute();
        return $row = $stmt->fetchAll();
    }
}
