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
        header("refresh:2; url=../ConfirmPage.php");
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
        header("refresh:2; url=../ConfirmPage.php");
        }
    }
?>