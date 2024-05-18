<?php
session_start();
require_once "server.php";

// ตรวจสอบว่าผู้ใช้ล็อกอินอยู่หรือไม่
    // ตรวจสอบว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
        if (isset($_POST['Join'])) {
            // รับข้อมูลที่ส่งมาจากแบบฟอร์ม
            $name_activity = $_POST['name_activity'];
            $firstname = $_POST['firstname']; // ใช้ข้อมูล firstname จากเซสชัน
            $lastname = $_POST['lastname']; // ใช้ข้อมูล lastname จากเซสชัน
            $studentID = $_POST['studentID']; // ใช้ข้อมูล studentID จากเซสชัน
            $activity_date1 = $_POST['activity_date1'];
            $activity_date2 = $_POST['activity_date2'];
            $name_location = $_POST['name_location'];
            $mr_ms = $_POST['mr_ms'];

            // เพิ่มข้อมูลเข้าฐานข้อมูล join_activity
            $stmt = $conn->prepare("INSERT INTO join_activity (name_activity, firstname, lastname, studentID, activity_date1, activity_date2, name_location, mr_ms) VALUES (:name_activity, :firstname, :lastname, :studentID, :activity_date1, :activity_date2, :name_location, :mr_ms)");
            $stmt->bindParam(":name_activity", $name_activity);
            $stmt->bindParam(":firstname", $firstname);
            $stmt->bindParam(":lastname", $lastname);
            $stmt->bindParam(":studentID", $studentID);
            $stmt->bindParam(":activity_date1", $activity_date1);
            $stmt->bindParam(":activity_date2", $activity_date2);
            $stmt->bindParam(":name_location", $name_location);
            $stmt->bindParam(":mr_ms", $mr_ms);
            // ทำการ execute คำสั่ง SQL
            if ($stmt->execute()) {
                $_SESSION['success'] = "เข้าร่วมสำเร็จ";
                header("location: ../HomeUser.php");
                exit();
            } else {
                $_SESSION['error'] = "เกิดข้อผิดพลาด";
                header("location: ../HomeUser.php");
                exit();
            }
        }
?>
