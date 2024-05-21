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
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $number = $_POST['number'];
    $email = $_POST['email'];

    // เพิ่มเงื่อนไขเช็ค password กับ c_password ว่าตรงกันหรือไม่
    if ($password !== $c_password) {
        // ถ้า password ไม่ตรงกับ c_password ให้แสดง SweetAlert2 แจ้งเตือน
        echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'ข้อผิดพลาด',
                        text: 'รหัสผ่านและการยืนยันรหัสผ่านไม่ตรงกัน',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });
                    window.location.href = '../Teacher.php'; // เพิ่มการเปลี่ยนทางหน้าเพื่อให้กลับไปที่หน้า Teacher.php
                });
            </script>";
    } else {
        // ถ้า password ตรงกับ c_password ให้ทำการอัปเดตข้อมูล
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
}
?>
