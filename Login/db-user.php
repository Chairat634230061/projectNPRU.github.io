<?php 
    session_start();
    require_once 'server.php';

    if (isset($_POST['LoginUser'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $studentID = $_POST['studentID']; 
    
        if (empty($email) || empty($password) || empty($studentID)) {
            $_SESSION['error'] = 'กรุณากรอกข้อมูลให้ครบถ้วน';
            header("location: LoginUser.php");
        } else {
            try {
                $check_data = $conn->prepare("SELECT * FROM studentuser WHERE email = :email AND studentID = :studentID");
                $check_data->bindParam(":email", $email);
                $check_data->bindParam(":studentID", $studentID); 
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);
    
                if ($check_data->rowCount() > 0) {
                    if (password_verify($password, $row['password'])) {
                        // ตั้งค่า session สำหรับ studentID
                        $_SESSION['studentID'] = $row['studentID'];
                        // ทำตามกระบวนการเข้าสู่ระบบสำหรับผู้ใช้ที่ต้องการ
                        if ($row['urole'] == 'admin') {
                            $_SESSION['admin_login'] = $row['id'];
                            header("location: ../page/HomeAdmin.php");
                        } else {
                            $_SESSION['user_login'] = $row['id'];
                            header("location: ../page/HomeUser.php");
                        }
                    } else {
                        $_SESSION['error'] = 'รหัสผ่านผิด';
                        header("location: LoginUser.php");
                    }
                } else {
                    $_SESSION['error'] = "ไม่พบข้อมูลผู้ใช้หรือรหัสนักศึกษาไม่ถูกต้อง";
                    header("location: LoginUser.php");
                }
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>
