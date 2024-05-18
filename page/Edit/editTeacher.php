<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
session_start();
require_once "server.php";

if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $mr_ms = $_POST['mr_ms'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $number = $_POST['number'];
        $email = $_POST['email'];

        $sql = $conn->prepare("UPDATE user_admin SET mr_ms = :mr_ms, firstname = :firstname, lastname = :lastname, number = :number, email = :email WHERE id = :id");
         $sql->bindParam(":id", $id);
         $sql->bindParam(":mr_ms", $mr_ms); 
         $sql->bindParam(":firstname", $firstname);
         $sql->bindParam(":lastname", $lastname);
         $sql->bindParam(":number", $number);
         $sql->bindParam(":email", $email);
         $sql->execute();

        if ($sql) {
            $_SESSION['success'] = "อัพเดทข้อมูลเรียบร้อย";
         header("location: ../Teacher.php");
         exit();
        } else {
            $_SESSION['error'] = "อัพเดทข้อมูลไม่สำเร็จ";
        header("location: ../Teacher.php");
         exit();
        }
    }
?>