<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<?php
require_once "server.php";

/* ---delete--- */
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    // ตรวจสอบก่อนว่ามีข้อมูลที่ต้องการลบหรือไม่
    $checkstmt = $conn->prepare("SELECT * FROM info_student WHERE id = :id");
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
        echo '            window.location.href = "../page/ConfirmPage.php?confirm_delete=' . $delete_id . '";';
        echo '        }';
        echo '    });';
        echo '});';
        echo '</script>';
    } else {
        $_SESSION['error'] = "ไม่พบข้อมูลที่ต้องการลบ";
        header("location: ../page/ConfirmPage.php");
        exit();
    }
}

/* ---confirm delete--- */
if (isset($_GET['confirm_delete'])) {
    $confirm_delete_id = $_GET['confirm_delete'];
    $deletestmt = $conn->prepare("DELETE FROM info_student WHERE id = :id");
    $deletestmt->bindParam(':id', $confirm_delete_id);
    $deletestmt->execute();

    if ($deletestmt) {
        $_SESSION['success'] = "ลบข้อมูลนี้เรียบร้อย";
        // เพิ่มคำสั่งรีเฟรชหน้าหลังลบข้อมูล
        header("location: ../page/ConfirmPage.php");
        exit();
    }
}
?>

<div class="content">
<?php include '../component/Admin/Confirm/Haeder.php'?>
<div class="table-container">
        <table class="custom-table">
        <tr>
        <th>ลำดับ</th>
            <th>ชื่อกิจกรรม</th>
            <th>รหัสนักศึกษา</th>
            <th>ชื่อผู้รับรอง</th>
            <th>จำนวนชั่วโมง</th>
            <th>วันที่บันทึกมา</th>
            <th>รูปภาพ</th>
            <th>รายละเอียด</th>
            <th>การรับรอง</th>
            <th>สถานนะ</th>
            <th>อนุมัติข้อมูล</th>
            <th>ลบข้อมูล</th>
        </tr>
        <?php
            //คิวรี่ข้อมูลมาแสดงในตาราง
            require_once 'server.php';
            $stmt = $conn->prepare("SELECT * FROM info_student");
            $stmt->execute();
            $result = $stmt->fetchAll();
            foreach($result as $k) {
            ?>

            <tr>
            <td>
                <?php echo $k['id']; ?> 
            </td>
            <td><?php echo $k['user_activity']; ?></td>
            <td><?php echo $k['studentID']; ?></td>
            <td><?php echo $k['user_certifier']; ?></td>
            <td><?php echo $k['collect_hours']; ?></td>
            <td><?php echo $k['name_time']; ?></td>
            <td width="150px" ><img class="rounded" width="100%"  src="../page/uploadsIMG/<?php echo $k['img']; ?>" alt=""></td>
            <td><?php echo $k['name_message']; ?></td>
            <td><?php echo $k['user_confirm']; ?></td>
            <td><?php echo $k['user_status']; ?></td>
            <td>
            <a href="EditConfirm.php?id=<?= $k['id']; ?>" class='td-a'>ยืนยัน</a>
        </td>
            </td>
            <td>
            <a data-id="<?= $k['id']; ?>" href="?delete=<?= $k['id']; ?>"  class='td-a'>ลบ</a>  
            </td>
            </tr>
            <?php } ?>

    </table>
    </div>