<?php 
session_start();
require_once "server.php";

if (isset($_POST['submituser'])) {
    $activity2 = $_POST['activity2'];
    $mr_ms = $_POST['mr_ms'];
    $studentID = $_POST['studentID'];
    $collect_hours = $_POST['collect_hours'];
    $name_message = $_POST['name_message'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $activity_date1 = $_POST['activity_date1'];
    $activity_date2 = $_POST['activity_date2'];
    $name_location = $_POST['name_location'];

    // ตรวจสอบว่ารหัสนักศึกษามีอยู่ในฐานข้อมูลหรือไม่
    $stmt = $conn->prepare("SELECT * FROM studentuser WHERE studentID = :studentID");
    $stmt->bindParam(':studentID', $studentID);
    $stmt->execute();
    $existing_student = $stmt->fetch();

    if ($existing_student) {
        // รหัสนักศึกษามีอยู่ในฐานข้อมูล
        // ตรวจสอบการอัปโหลดไฟล์รูปภาพ
        if (isset($_FILES['img']) && $_FILES['img']['size'] > 0 && $_FILES['img']['error'] == 0
            && isset($_FILES['img_confirm']) && $_FILES['img_confirm']['size'] > 0 && $_FILES['img_confirm']['error'] == 0) {
            $img = $_FILES['img'];
            $img_confirm = $_FILES['img_confirm'];

            $allow = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
            $extension_img = explode(".", $img['name']);
            $extension_img_confirm = explode(".", $img_confirm['name']);

            $fileActExt_img = strtolower(end($extension_img));
            $fileActExt_img_confirm = strtolower(end($extension_img_confirm));

            $fileNew_img = rand() . "." . $fileActExt_img;
            $fileNew_img_confirm = rand() . "." . $fileActExt_img_confirm;

            $filePath_img = '../uploadsIMG/' . $fileNew_img;
            $filePath_img_confirm = '../imgConfirm/' . $fileNew_img_confirm;

            if (in_array($fileActExt_img, $allow) && in_array($fileActExt_img_confirm, $allow)) {
                if (move_uploaded_file($img['tmp_name'], $filePath_img) && move_uploaded_file($img_confirm['tmp_name'], $filePath_img_confirm)) {
                    // เพิ่มข้อมูลลงในฐานข้อมูล
                    $sql = $conn->prepare("INSERT INTO info_student( studentID, collect_hours, img, name_message, activity2, firstname, lastname, img_confirm, activity_date1, activity_date2, mr_ms, name_location ) 
                    VALUES( :studentID, :collect_hours, :img, :name_message, :activity2, :firstname, :lastname, :img_confirm, :activity_date1, :activity_date2, :mr_ms, :name_location )");
                    $sql->bindParam(":studentID", $studentID);
                    $sql->bindParam(":collect_hours", $collect_hours);
                    $sql->bindParam(":mr_ms", $mr_ms);
                    $sql->bindParam(":img", $fileNew_img);
                    $sql->bindParam(":name_message", $name_message);
                    $sql->bindParam(":activity2", $activity2);
                    $sql->bindParam(":firstname", $firstname);
                    $sql->bindParam(":lastname", $lastname);
                    $sql->bindParam(":activity_date1", $activity_date1);
                    $sql->bindParam(":activity_date2", $activity_date2);
                    $sql->bindParam(":img_confirm", $fileNew_img_confirm);
                    $sql->bindParam(":name_location", $name_location);

                    $sql->execute();

                    if ($sql) {
                        $_SESSION['success'] = "เพิ่มข้อมูลเรียบร้อย";
                        header("location: ../ActivityUser.php");
                        exit();
                    } else {
                        $_SESSION['error'] = "เพิ่มข้อมูลไม่สำเร็จ";
                        header("location: ../ActivityUser.php");
                        exit();
                    }
                }
            }
        } else {
            // กรณีที่ไม่มีการอัปโหลดไฟล์รูปภาพ
            $_SESSION['error'] = "กรุณาเลือกไฟล์รูปภาพและเอกสารรับรอง";
            header("location: ../ActivityUser.php");
            exit();
        }
    } else {
        // รหัสนักศึกษาไม่มีอยู่ในฐานข้อมูล
        $_SESSION['error'] = "ไม่พบรหัสนักศึกษาในระบบ";
        header("location: ../ActivityUser.php");
        exit();
    }
}
?>
