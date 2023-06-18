<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
session_start();
require_once "server.php";

if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name_activity = $_POST['name_activity'];
        $collect_hours = $_POST['collect_hours'];

        $sql = $conn->prepare("UPDATE podo SET name_activity = :name_activity, collect_hours = :collect_hours WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":name_activity", $name_activity);
        $sql->bindParam(":collect_hours", $collect_hours);
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
        header("refresh:2; url=../HomeAdmin.php");
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
        header("refresh:2; url=../HomeAdmin.php");
        }
    }
?>