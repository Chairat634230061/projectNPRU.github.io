<?php
session_start();
require_once "server.php";

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $user_status = $_POST['user_status'];

    $sql = $conn->prepare("UPDATE info_student SET user_status = :user_status WHERE id = :id");
    $sql->bindParam(":id", $id);
    $sql->bindParam(":user_status", $user_status);
    $sql->execute();

    if ($sql) {
        $_SESSION['success'] = "อัปเดตข้อมูลเรียบร้อย";
        if ($user_status == 'อนุมัติ') {
            // เพิ่มข้อมูลลงใน successful ก่อน
            $insertstmt = $conn->prepare("INSERT INTO successful (user_activity, studentID, collect_hours, name_time, img, name_message, user_status, firstname, lastname, activity2, img_confirm,  id) SELECT user_activity, studentID, collect_hours, name_time, img, name_message, user_status, firstname, lastname, activity2, img_confirm, id FROM info_student WHERE id = :id");
            $insertstmt->bindParam(':id', $id);
            $insertstmt->execute();

            // เพิ่มการตรวจสอบว่าการลบข้อมูลจาก info_student สำเร็จหรือไม่
            $deletestmt = $conn->prepare("DELETE FROM info_student WHERE id = :id");
            $deletestmt->bindParam(':id', $id);
            $deleteSuccess = $deletestmt->execute();

            if ($insertstmt && $deleteSuccess) {
                // ถ้าเพิ่มข้อมูลลงใน successful เรียบร้อยและลบข้อมูลจาก info_student สำเร็จ
                header("location: ../ConfirmPage.php");
                exit();
            } else {
                $_SESSION['error'] = "ไม่สามารถเพิ่มข้อมูลใน successful หรือลบข้อมูลจาก info_student ได้";
                header("location: ../ConfirmPage.php");
                exit();
            }
        } elseif ($user_status == 'ไม่อนุมัติ') {
            // เพิ่มข้อมูลลงใน unsuccessful ก่อน
            $insertstmt = $conn->prepare("INSERT INTO unsuccessful (user_activity, studentID, collect_hours, name_time, img, name_message, user_status, firstname, lastname, activity2, img_confirm, id) SELECT user_activity, studentID, collect_hours, name_time, img, name_message, user_status, firstname, lastname, activity2, img_confirm, id FROM info_student WHERE id = :id");
            $insertstmt->bindParam(':id', $id);
            $insertstmt->execute();

            // เพิ่มการตรวจสอบว่าการลบข้อมูลจาก info_student สำเร็จหรือไม่
            $deletestmt = $conn->prepare("DELETE FROM info_student WHERE id = :id");
            $deletestmt->bindParam(':id', $id);
            $deleteSuccess = $deletestmt->execute();

            if ($insertstmt && $deleteSuccess) {
                // ถ้าเพิ่มข้อมูลลงใน unsuccessful เรียบร้อยและลบข้อมูลจาก info_student สำเร็จ
                header("location: ../ConfirmPage.php");
                exit();
            } else {
                $_SESSION['error'] = "ไม่สามารถเพิ่มข้อมูลใน unsuccessful หรือลบข้อมูลจาก info_student ได้";
                header("location: ../ConfirmPage.php");
                exit();
            }
        } else {
            header("location: ../ConfirmPage.php"); // กรณีอื่น ๆ ที่ไม่ระบุสถานะเด้งไปยังหน้า 
            exit();
        }
    } else {
        $_SESSION['error'] = "อัปเดตข้อมูลไม่สำเร็จ";
        header("location: ../ConfirmPage.php"); // เมื่อไม่สำเร็จให้เด้งไปยังหน้า ConfirmPage.php
        exit();
    }
}
?>
