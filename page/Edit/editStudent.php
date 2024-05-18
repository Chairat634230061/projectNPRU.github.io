<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
session_start();
require_once "server.php";

if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $studentID = $_POST['studentID'];
        $mr_ms = $_POST['mr_ms'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $studygroup = $_POST['studygroup'];

        $sql = $conn->prepare("UPDATE studentuser SET studentID = :studentID, mr_ms = :mr_ms, firstname = :firstname,  studygroup = :studygroup, lastname = :lastname, email = :email WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":studentID", $studentID);
        $sql->bindParam(":mr_ms", $mr_ms);
        $sql->bindParam(":firstname", $firstname);
        $sql->bindParam(":lastname", $lastname);
        $sql->bindParam(":studygroup", $studygroup);
        $sql->bindParam(":email", $email);
        $sql->execute();
        
        if ($sql) {
            $_SESSION['success'] = "อัพเดทข้อมูลเรียบร้อย";
         header("location: ../Student.php");
         exit();
        } else {
            $_SESSION['error'] = "อัพเดทข้อมูลไม่สำเร็จ";
        header("location: ../Student.php");
         exit();
        }
    }

?>