<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    session_start();
    require_once ("server.php");

    if (isset($_POST['submitcertifier'])) {
        $firstname = $_POST['firstname'];
        $agency = $_POST['agency'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $urole = 'user';

        if (empty($firstname)) {
            $_SESSION['error'] = 'กรุณากรอกชื่อ';
            header("location: ../AddCertifier.php");
        } else if (empty($lastname)) {
            $_SESSION['error'] = 'กรุณากรอกนามสกุล';
            header("location: ../AddCertifier.php");
        } else if (empty($email)) {
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: ../AddCertifier.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: ../AddCertifier.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: ../AddCertifier.php");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
            header("location: ../AddCertifier.php");
        } else if (empty($c_password)) {
            $_SESSION['error'] = 'กรุณายืนยันรหัสผ่าน';
            header("location: ../AddCertifier.php");
        } else if ($password != $c_password) {
            $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
            header("location: ../AddCertifier.php");
        } else {
            try {

                $check_email = $conn->prepare("SELECT email FROM studentuser WHERE email = :email");
                $check_email->bindParam(":email", $email);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);
                
                if ($row['email'] == $email) {
                    $_SESSION['error'] = "มีอีเมลนี้อยู่ในระบบแล้ว";
                    header("location: ../AddCertifier.php");
                     exit();
                    
                    
                } else if (!isset($_SESSION['error'])) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO Certifier(agency,firstname, lastname, email, password, urole) 
                                            VALUES(:agency, :firstname, :lastname, :email, :password, :urole)");
                    $stmt->bindParam(":agency", $agency);
                    $stmt->bindParam(":firstname", $firstname);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":password", $passwordHash);
                    $stmt->bindParam(":urole", $urole);
                    $stmt->execute();
                    $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว!";
                    header("location: ../Certifier.php");
                    exit();
                    
                } else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: ../Certifier.php");
                    exit();
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>
