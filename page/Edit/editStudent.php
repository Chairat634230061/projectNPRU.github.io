<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
session_start();
require_once "server.php";

if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $studentID = $_POST['studentID'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];

        $sql = $conn->prepare("UPDATE studentuser SET studentID = :studentID, firstname = :firstname, lastname = :lastname, email = :email WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":studentID", $studentID);
        $sql->bindParam(":firstname", $firstname);
        $sql->bindParam(":lastname", $lastname);
        $sql->bindParam(":email", $email);
        $sql->execute();

        if ($sql) {
            $_SESSION['success'] = "";
            echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'อัพเดทข้อมูลเรียบร้อย',
                    icon: 'success',
                    timer: 5000,
                   showConfimButton: false,
                });
            })
        </script>";
        header("refresh:2; url=../Student.php");
        } else {
            $_SESSION['error'] = "";
            echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'อัพเดทข้อมูลไม่สำเร็จ',
                    icon: 'error',
                    timer: 5000,
                   showConfimButton: false,
                });
            })
        </script>";
        header("refresh:2; url=../Student.php");
        }
    }
?>