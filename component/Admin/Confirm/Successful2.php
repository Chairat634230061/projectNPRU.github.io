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
    $checkstmt = $conn->prepare("SELECT * FROM successful WHERE id = :id");
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
        <th>ชื่อ</th>
        <th>นามสกุล</th>
        <th>รหัสนักศึกษา</th>
        <th>ชื่อกิจกรรม</th>
        <th>จำนวนชั่วโมง</th>
        <th>รูปภาพ</th>
        <th>สถานนะ</th>
        <th>ลบข้อมูล</th>
        </tr>
        <?php
            //คิวรี่ข้อมูลมาแสดงในตาราง
            require_once 'server.php';
            $stmt = $conn->prepare("SELECT * FROM successful WHERE name_activity IS NOT NULL AND name_activity != ''");
            $stmt->execute();
            $result = $stmt->fetchAll();
            foreach($result as $k) {
            ?>

            <tr>
            <td><?php echo $k['firstname']; ?></td>
            <td><?php echo $k['lastname']; ?></td>
            <td><?php echo $k['studentID']; ?></td>
            <td><?php echo $k['name_activity']; ?></td>
            <td><?php echo $k['collect_hours']; ?></td>
            <td width="150px">
                    <?php if(!empty($k['img'])) { ?>
                    <img class="rounded" width="100%" src="../page/Joinimg/<?php echo $k['img']; ?>" alt="">
                    <?php } else { ?>
                            ไม่มีรูปภาพ
                    <?php } ?>
                    </td>
            <td><?php echo $k['user_status']; ?></td>
            <td>
            <a data-id="<?= $k['id']; ?>" href="?delete=<?= $k['id']; ?>"  class='td-a'>ลบ</a>  
            </td>
            </tr>
            <?php } ?>

    </table>
    </div>
