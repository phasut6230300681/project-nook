<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "se";

try
{
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    #echo "Connected successfully";
}
catch (PDOException $e)
{
    echo "Connection failed <br>" . $e;
}
//-----------------------------//
class RegisterData
{
    public static function isFound($username, $password)
    {
        global $conn;
        $sql = "SELECT * FROM user WHERE username=:username AND password=:password";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->execute();

        return $stmt->rowCount();
    }


    public static function getData($username)
    {
        global $conn;
        $sql = "SELECT * FROM user WHERE username=:username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        return $row = $stmt->fetch();
    }
}

class Branch
{
    public static function isFound($name, $tag, $code)
    {
        global $conn;
        $sql = "SELECT * FROM branch WHERE branch_name=:name OR branch_tag=:tag OR branch_code_tag=:code";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":tag", $tag);
        $stmt->bindParam(":code", $code);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public static function showAll()
    {
        global $conn;
        $sql = "SELECT * FROM branch";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $stmt;
    }
}
