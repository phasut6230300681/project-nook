<?php
class RegisterData
{
    public static function isFound($conn, $username, $password)
    {
        $sql = "SELECT * FROM user WHERE username=:username AND password=:password";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->execute();

        return $stmt;
    }


    function getUser($conn, $username, $password)
    {

        $sql = "SELECT * FROM user WHERE username=:username AND password=:password";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->execute();
    }
}

?>
