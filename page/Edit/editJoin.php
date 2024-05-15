<?php
session_start();
require_once "server.php";

if (isset($_POST['update'])) {
    $name_activity = $_POST['name_activity'];
    $collect_hours = $_POST['collect_hours'];

    // เพิ่มการอัปโหลดไฟล์รูปภาพ
    if (isset($_FILES['img']) && $_FILES['img']['size'] > 0 && $_FILES['img']['error'] == 0) {
        $img = $_FILES['img'];
        $allow = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        $extension_img = explode(".", $img['name']);
        $fileActExt_img = strtolower(end($extension_img));

        // ตรวจสอบว่าส่วนขยายของไฟล์ภาพอยู่ในอาร์เรย์ $allow หรือไม่
        if (in_array($fileActExt_img, $allow)) {
            $fileNew_img = rand() . "." . $fileActExt_img;
            $filePath_img = '../Joinimg/' . $fileNew_img;

            // ย้ายไฟล์ภาพไปยังโฟลเดอร์ปลายทาง
            move_uploaded_file($img['tmp_name'], $filePath_img);
        } else {
            $_SESSION['error'] = "ไฟล์ภาพไม่รองรับ";
            header("location: ../HomeJoin.php");
            exit();
        }
    } else {
        // ถ้าไม่มีการอัปโหลดภาพให้ใช้ค่าเดิมของฟิลด์ "img"
        $img = ""; // หรือสามารถใช้ค่าเดิมที่อยู่ในฐานข้อมูลได้
    }

    // เชื่อมต่อฐานข้อมูล
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ทำการอัปเดตฐานข้อมูล
    $sql = $conn->prepare("UPDATE join_activity SET img = :img, collect_hours = :collect_hours WHERE name_activity = :name_activity");
    $sql->bindParam(":name_activity", $name_activity);
    $sql->bindParam(":collect_hours", $collect_hours);
    $sql->bindParam(":img", $fileNew_img); // ใช้ชื่อไฟล์ภาพที่อัปโหลด
    $result = $sql->execute();

    if ($result) {
        $_SESSION['success'] = "อัพเดทข้อมูลเรียบร้อย";
    } else {
        $_SESSION['error'] = "อัพเดทข้อมูลไม่สำเร็จ";
    }
    header("location: ../HomeJoin.php");
    exit();
}
?>
