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
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $studygroup = $_POST['studygroup'];

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
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../Student.php';
                        }
                    });
                });
            </script>";
    } else {
        // ถ้า password ตรงกับ c_password ให้ทำการอัปเดตข้อมูล
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
}
?>
