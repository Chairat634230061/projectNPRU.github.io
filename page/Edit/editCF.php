<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
session_start();
require_once "server.php";

if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $user_confirm = $_POST['user_confirm'];


        $sql = $conn->prepare("UPDATE info_student SET user_confirm = :user_confirm WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":user_confirm", $user_confirm);
        $sql->execute();


        if ($sql) {
            $_SESSION['success'] = "อัพเดทข้อมูลเรียบร้อย";
         header("location: ../HomeCertifier.php");
         exit();
        } else {
            $_SESSION['error'] = "อัพเดทข้อมูลไม่สำเร็จ";
        header("location: ../HomeCertifier.php");
         exit();
        }
    }

        
?>