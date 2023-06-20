<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
session_start();
require_once "server.php";

if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $user_status = $_POST['user_status'];


        $sql = $conn->prepare("UPDATE info_student SET user_status = :user_status WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":user_status", $user_status);
        $sql->execute();


        if ($sql) {
            $_SESSION['success'] = "อัพเดทข้อมูลเรียบร้อย";
         header("location: ../ConfirmPage.php");
         exit();
        } else {
            $_SESSION['error'] = "อัพเดทข้อมูลไม่สำเร็จ";
        header("location: ../ConfirmPage.php");
         exit();
        }
    }

        
?>