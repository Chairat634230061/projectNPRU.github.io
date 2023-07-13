<?php 
    session_start();
    require_once 'server.php';

    if (isset($_POST['LoginCertifier'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

      
        if (empty($email)) {
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: LoginCertifier.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: LoginCertifier.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: LoginCertifier.php");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
            header("location: LoginCertifier.php");
        } else {
            try {

                $check_data = $conn->prepare("SELECT * FROM certifier WHERE email = :email");
                $check_data->bindParam(":email", $email);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data->rowCount() > 0) {

                    if ($email == $row['email']) {
                        if (password_verify($password, $row['password'])) {
                            if ($row['urole'] == 'admin') {
                                $_SESSION['admin_login'] = $row['id'];
                                header("location: ../page/HomeAdmin.php");
                            } else {
                                $_SESSION['user_login'] = $row['id'];
                                header("location: ../page/HomeCertifier.php");
                            }
                        } else {
                            $_SESSION['error'] = 'รหัสผ่านผิด';
                            header("location: LoginCertifier.php");
                        }
                    } else {
                        $_SESSION['error'] = 'อีเมลผิด';
                        header("location: LoginCertifier.php");
                    }
                } else {
                    $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
                    header("location: LoginCertifier.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
               
            }
        }
    }


?>
