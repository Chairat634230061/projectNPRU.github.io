<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php 
session_start();
require_once "server.php";

if (isset($_POST['submituser'])) {
    $user_activity = $_POST['user_activity'];
    $studentID = $_POST['studentID'];
    $collect_hours = $_POST['collect_hours'];
    $name_message = $_POST['name_message'];


    // ตรวจสอบว่ามีไฟล์รูปภาพถูกส่งมาหรือไม่
    if (isset($_FILES['img']) && $_FILES['img']['size'] > 0 && $_FILES['img']['error'] == 0) {
        $img = $_FILES['img'];
        $allow = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        $extension = explode(".", $img['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;
        $filePath = '../uploadsIMG/' . $fileNew;

        if (in_array($fileActExt, $allow)) {
            if (move_uploaded_file($img['tmp_name'], $filePath)) {
                // ต่อมาทำการเพิ่มข้อมูลลงในฐานข้อมูล
                $sql = $conn->prepare("INSERT INTO info_student(user_activity, studentID, collect_hours, img, name_message) 
                VALUES(:user_activity, :studentID, :collect_hours, :img, :name_message)");
                $sql->bindParam(":user_activity", $user_activity);
                $sql->bindParam(":studentID", $studentID);
                $sql->bindParam(":collect_hours", $collect_hours);
                $sql->bindParam(":img", $fileNew);
                $sql->bindParam(":name_message", $name_message);
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
        // กรณีไม่มีไฟล์รูปภาพถูกส่งมาหรือเกิดข้อผิดพลาดในการอัปโหลด
        // ทำการเพิ่มข้อมูลลงในฐานข้อมูลโดยไม่รวมฟิลด์ 'img'
        $sql = $conn->prepare("INSERT INTO info_student(user_activity, studentID, collect_hours, name_message) 
        VALUES(:user_activity, :studentID, :collect_hours, :name_message)");
        $sql->bindParam(":user_activity", $user_activity);
        $sql->bindParam(":studentID", $studentID);
        $sql->bindParam(":collect_hours", $collect_hours);
        $sql->bindParam(":name_message", $name_message);
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

?>
