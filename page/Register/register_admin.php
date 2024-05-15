<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
session_start();
require_once("server.php");

if (isset($_POST['signupadmin'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $urole = 'admin';

    if (empty($firstname)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อ';
        header("location: ../AddTeacher.php");
        exit();
    } elseif (empty($lastname)) {
        $_SESSION['error'] = 'กรุณากรอกนามสกุล';
        header("location: ../AddTeacher.php");
        exit();
    } elseif (empty($number)) {
        $_SESSION['error'] = 'กรุณากรอกเบอร์';
        header("location: ../AddTeacher.php");
        exit();
    } elseif (empty($email)) {
        $_SESSION['error'] = 'กรุณากรอกอีเมล';
        header("location: ../AddTeacher.php");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
        header("location: ../AddTeacher.php");
        exit();
    } elseif (empty($password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header("location: ../AddTeacher.php");
        exit();
    } elseif (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
        $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
        header("location: ../AddTeacher.php");
        exit();
    } elseif (empty($c_password)) {
        $_SESSION['error'] = 'กรุณายืนยันรหัสผ่าน';
        header("location: ../AddTeacher.php");
        exit();
    } elseif ($password != $c_password) {
        $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
        header("location: ../AddTeacher.php");
        exit();
    }

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $check_email = $conn->prepare("SELECT email FROM user_admin WHERE email = :email");
        $check_email->bindParam(":email", $email);
        $check_email->execute();
        $row = $check_email->fetch(PDO::FETCH_ASSOC);       //รวจสอบว่ามีอีเมลที่ถูกใช้ลงทะเบียนอยู่แล้วในฐานข้อมูลหรือไม่ โดยทำการเชื่อมต่อกับฐานข้อมูลและเซตแอตทริบิวต์ของการเชื่อมต่อเพื่อให้เกิดการแจ้งเตือนเมื่อเกิดข้อผิดพลาด 

        if ($row) {
            $_SESSION['error'] = "มีอีเมลนี้อยู่ในระบบแล้ว";
            header("location: ../AddTeacher.php");
            exit();
        } else {
            // สร้างรหัสผ่านที่ถูกเข้ารหัสด้วย bcrypt
            //การเข้ารหัส รหัสผ่านเป็นกระบวนการที่จะแปลงข้อมูลรหัสผ่านที่ผู้ใช้ป้อนเป็นสตริงรหัสที่ไม่สามารถถอดรหัสกลับมาเป็นรหัสผ่านเดิมได้. นี่เป็นวิธีที่ช่วยให้รหัสผ่านเก็บไว้อย่างปลอดภัยในฐานข้อมูลหรือระบบอื่น ๆ โดยไม่ต้องเก็บเป็นรหัสผ่านแบบเปิดเผย.
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO user_admin(number, firstname, lastname, email, password, urole) 
                                        VALUES(:number, :firstname, :lastname, :email, :password, :urole)");
            $stmt->bindParam(":number", $number);
            $stmt->bindParam(":firstname", $firstname);
            $stmt->bindParam(":lastname", $lastname);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $passwordHash);
            $stmt->bindParam(":urole", $urole);
            $stmt->execute();
            $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว!";
            header("location: ../Teacher.php");
            exit();
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>