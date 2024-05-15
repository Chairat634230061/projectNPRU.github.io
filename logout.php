<?php 
    session_start();
    // เช็คว่า studentID เป็นของผู้ใช้ทั่วไปหรือไม่
    if(isset($_SESSION['user_login']) && $_SESSION['user_login']['studentID'] == $_GET['studentID']) {
        unset($_SESSION['user_login']);
    }
    unset($_SESSION['admin_login']);
    header('location: index.php');
?>