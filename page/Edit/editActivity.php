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
        $activity_date1 = $_POST['activity_date1'];
        $activity_date2 = $_POST['activity_date2'];
        $participant_limit = $_POST['participant_limit'];

        $sql = $conn->prepare("UPDATE add_activity SET name_activity = :name_activity, collect_hours = :collect_hours, name_location = :name_location, activity_date1 = :activity_date1, activity_date2 = :activity_date2, participant_limit = :participant_limit WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":name_activity", $name_activity);
        $sql->bindParam(":collect_hours", $collect_hours);
        $sql->bindParam(":name_location", $name_location);
        $sql->bindParam(":activity_date1", $activity_date1);
        $sql->bindParam(":activity_date2", $activity_date2);
        $sql->bindParam(":participant_limit", $participant_limit);
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