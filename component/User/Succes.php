<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

<script>
    $(document).ready(function() {
        // เพิ่มการตรวจสอบการคลิกที่รูปภาพ
        $('.rounded').click(function() {
            var imgUrl = $(this).attr('src'); // รับ URL ของรูปภาพที่คลิก
            var imgTag = '<img src="' + imgUrl + '" style="max-width: 100%; max-height: 100%;">'; // สร้างแท็ก <img> ใหม่โดยกำหนดขนาดสูงสุด
            Swal.fire({
                html: imgTag, // แทรกรูปภาพใน SweetAlert2
                showCloseButton: true, // แสดงปุ่มปิด
                showConfirmButton: false, // ซ่อนปุ่มยืนยัน
                customClass: {
                    popup: 'swal2-image-popup', // กำหนดคลาส CSS สำหรับการแสดงรูปภาพใน SweetAlert2
                },
            });
        });
    });
</script>
<?php
require_once "server.php";

/* ---delete--- */
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    // ตรวจสอบก่อนว่ามีข้อมูลที่ต้องการลบหรือไม่
    $checkstmt = $conn->prepare("SELECT * FROM unsuccessful WHERE id = :id");
    $checkstmt->bindParam(':id', $delete_id);
    $checkstmt->execute();
    $rowCount = $checkstmt->rowCount();

    if ($rowCount > 0) {
        // แสดงหน้าต่างยืนยันการลบ
        echo '<script>';
        echo '$(document).ready(function() {';
        echo '    Swal.fire({';
        echo '        title: "คุณต้องการลบข้อมูลนี้หรือไม่?",';
        echo '        icon: "warning",';
        echo '        showCancelButton: true,';
        echo '        confirmButtonText: "ยืนยัน",';
        echo '        cancelButtonText: "ปิด",';
        echo '    }).then((result) => {';
        echo '        if (result.isConfirmed) {';
        echo '            window.location.href = "../page/Successful.php?confirm_delete=' . $delete_id . '";';
        echo '        }';
        echo '    });';
        echo '});';
        echo '</script>';
    } else {
        $_SESSION['error'] = "ไม่พบข้อมูลที่ต้องการลบ";
        header("location: ../page/Successful.php");
        exit();
    }
}

/* ---confirm delete--- */
if (isset($_GET['confirm_delete'])) {
    $confirm_delete_id = $_GET['confirm_delete'];
    $deletestmt = $conn->prepare("DELETE FROM successful WHERE id = :id");
    $deletestmt->bindParam(':id', $confirm_delete_id);
    $deletestmt->execute();

    if ($deletestmt) {
        $_SESSION['success'] = "ลบข้อมูลนี้เรียบร้อย";
        // เพิ่มคำสั่งรีเฟรชหน้าหลังลบข้อมูล
        header("location: ../page/Successful.php");
        exit();
    }
}
?>

<div class="content">
<?php include '../component/Admin/Confirm/SuccesHaeder.php'?>
<div class="table-container">
        <table class="custom-table">
        <tr>
            <th>ชื่อกิจกรรม</th>
            <th>สถานที่</th>
            <th>จำนวนชั่วโมง</th>
            <th>วันที่บันทึกมา</th>
            <th>รูปภาพ</th>
            <th>รูปเอกสารรับรอง</th>
            <th>รายละเอียด</th>
            <th>สถานนะ</th>
        </tr>
        <?php
                // รหัสนักศึกษาที่เข้าระบบ
                $loggedInStudentID = $_SESSION['studentID'];

                // คิวรีข้อมูลจากตาราง successful โดยใช้ INNER JOIN และเงื่อนไข WHERE เพื่อกรองเฉพาะข้อมูลของผู้ใช้ที่ รหัสนักศึกษา เท่ากับ รหัสนักศึกษา ที่เข้าระบบ
                $stmt = $conn->prepare("SELECT successful.*, studentuser.* 
                FROM successful 
                INNER JOIN studentuser ON successful.studentID = studentuser.studentID 
                WHERE successful.activity2 IS NOT NULL AND successful.activity2 != '' 
                AND successful.studentID = :loggedInStudentID");
                $stmt->bindParam(':loggedInStudentID', $loggedInStudentID);
                $stmt->execute();
                $result = $stmt->fetchAll();

                foreach ($result as $row) {
                    ?>

            <tr>
            <td><?php echo $row['activity2']; ?></td>
            <td><?php echo $row['name_location']; ?></td>
            <td><?php echo $row['collect_hours']; ?></td>
            <td><?php echo $row['name_time']; ?></td>
            <td width="150px" ><img class="rounded" width="100%"  src="../page/uploadsIMG/<?php echo $row['img']; ?>" alt=""></td>
            <td width="150px" ><img class="rounded" width="100%"  src="../page/imgConfirm/<?php echo $row['img_confirm']; ?>" alt=""></td>
            <td><?php echo $row['name_message']; ?></td>
            <td><?php echo $row['user_status']; ?></td>
           
            </tr>
            <?php } ?>

    </table>
    </div>
