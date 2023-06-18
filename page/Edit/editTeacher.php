<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
session_start();
require_once "server.php";

if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $number = $_POST['number'];
        $email = $_POST['email'];

        $sql = $conn->prepare("UPDATE user SET firstname = :firstname, lastname = :lastname, number = :number, email = :email WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":firstname", $firstname);
        $sql->bindParam(":lastname", $lastname);
        $sql->bindParam(":number", $number);
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
        header("refresh:2; url=../Teacher.php");
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
        header("refresh:2; url=../Teacher.php");
        }
    }
?>