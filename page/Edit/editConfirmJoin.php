<?php
session_start();
require_once "server.php";

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $user_status = $_POST['user_status'];

    $sql = $conn->prepare("UPDATE join_activity SET user_status = :user_status WHERE id = :id");
    $sql->bindParam(":id", $id);
    $sql->bindParam(":user_status", $user_status);
    $sql->execute();

    if ($sql) {
        $_SESSION['success'] = "อัปเดตข้อมูลเรียบร้อย";
        if ($user_status == 'อนุมัติ') {
            // เพิ่มข้อมูลลงใน successful ก่อน
            $insertstmt = $conn->prepare("INSERT INTO successful (name_activity, studentID, collect_hours, img, user_status, firstname, lastname, mr_ms, id) SELECT name_activity, studentID, collect_hours, img, user_status, firstname, lastname, mr_ms, id FROM join_activity WHERE id = :id");
            $insertstmt->bindParam(':id', $id);
            $insertstmt->execute();

            // ถ้าเพิ่มข้อมูลลงใน successful เรียบร้อย และหลังจากนั้นลบข้อมูลจาก join_activity
            if ($insertstmt) {
                $deletestmt = $conn->prepare("DELETE FROM join_activity WHERE id = :id");
                $deletestmt->bindParam(':id', $id);
                $deleteSuccess = $deletestmt->execute();

                if ($deleteSuccess) {
                    header("location: ../AdminJoin.php");
                    exit();
                } else {
                    $_SESSION['error'] = "ไม่สามารถลบข้อมูลจาก join_activity ได้";
                    header("location: ../AdminJoin.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = "ไม่สามารถเพิ่มข้อมูลใน successful ได้";
                header("location: ../AdminJoin.php");
                exit();
            }
        } elseif ($user_status == 'ไม่อนุมัติ') {
            // เพิ่มข้อมูลลงใน unsuccessful ก่อน
            $insertstmt = $conn->prepare("INSERT INTO unsuccessful (name_activity, studentID, collect_hours, img, user_status, firstname, lastname, mr_ms, id) SELECT name_activity, studentID, collect_hours, img, user_status, firstname, lastname, mr_ms, id FROM join_activity WHERE id = :id");
            $insertstmt->bindParam(':id', $id);
            $insertstmt->execute();

            // ถ้าเพิ่มข้อมูลลงใน unsuccessful เรียบร้อย และหลังจากนั้นลบข้อมูลจาก join_activity
            if ($insertstmt) {
                $deletestmt = $conn->prepare("DELETE FROM join_activity WHERE id = :id");
                $deletestmt->bindParam(':id', $id);
                $deleteSuccess = $deletestmt->execute();

                if ($deleteSuccess) {
                    header("location: ../AdminJoin.php");
                    exit();
                } else {
                    $_SESSION['error'] = "ไม่สามารถลบข้อมูลจาก join_activity ได้";
                    header("location: ../AdminJoin.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = "ไม่สามารถเพิ่มข้อมูลใน unsuccessful ได้";
                header("location: ../AdminJoin.php");
                exit();
            }
        } else {
            header("location: ../AdminJoin.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "อัปเดตข้อมูลไม่สำเร็จ";
        header("location: ../AdminJoin.php");
        exit();
    }
}
?>
