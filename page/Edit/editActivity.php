<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
session_start();
require_once "server.php";

if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name_activity = $_POST['name_activity'];
        $collect_hours = $_POST['collect_hours'];
        $name_location = $_POST['name_location'];
        $name_teacher = $_POST['name_teacher'];

        $sql = $conn->prepare("UPDATE podo SET name_activity = :name_activity, collect_hours = :collect_hours, name_location = :name_location, name_teacher = :name_teacher WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":name_activity", $name_activity);
        $sql->bindParam(":collect_hours", $collect_hours);
        $sql->bindParam(":name_location", $name_location);
        $sql->bindParam(":name_teacher", $name_teacher);
        $sql->execute();


        
        if ($sql) {
            $_SESSION['success'] = "อัพเดทข้อมูลเรียบร้อย";
         header("location: ../HomeAdmin.php");
         exit();
        } else {
            $_SESSION['error'] = "อัพเดทข้อมูลไม่สำเร็จ";
        header("location: ../HomeAdmin.php");
         exit();
        }
    }

?>