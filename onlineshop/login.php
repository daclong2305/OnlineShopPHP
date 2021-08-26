<?php

session_start();
include 'connect.php';



if (isset($_POST["email"]) && $_POST["password"]) {
    $email = mysqli_real_escape_string($conn,$_POST["email"]);
    $password = $_POST["password"];
    echo $email;
    $sql = "SELECT * FROM user_info WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_row()) {
            $_SESSION["uid"] = $row[0];
            $_SESSION["name"] = $row[1];
        }
    }
}