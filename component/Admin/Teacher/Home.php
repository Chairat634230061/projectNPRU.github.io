<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<?php

require_once "server.php";

/* ---delete---  */
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    // ตรวจสอบก่อนว่ามีข้อมูลที่ต้องการลบหรือไม่
    $checkstmt = $conn->prepare("SELECT * FROM user_admin WHERE id = :id");
    $checkstmt->bindParam(':id', $delete_id);
    $checkstmt->execute();
    $rowCount = $checkstmt->rowCount();

    if ($rowCount > 0) {
        // แสดงหน้าต่างยืนยันการลบ
        echo '<script>';
        echo 'Swal.fire({';
        echo '    title: "คุณต้องการลบข้อมูลนี้หรือไม่?",';
        echo '    icon: "warning",';
        echo '    showCancelButton: true,';
        echo '    confirmButtonText: "ยืนยัน",';
        echo '    cancelButtonText: "ปิด"';
        echo '}).then((result) => {';
        echo '    if (result.isConfirmed) {';
        echo 'window.location.href = "../page/Teacher.php?confirm_delete=' . $delete_id . '";';

        echo '    }';
        echo '});';
        echo '</script>';
    } else {
        $_SESSION['error'] = "ไม่พบข้อมูลที่ต้องการลบ";
        header("location: ../page/Teacher.php");
        exit();
    }
}

/* ---confirm delete--- */
if (isset($_GET['confirm_delete'])) {
    $confirm_delete_id = $_GET['confirm_delete'];
    $deletestmt = $conn->prepare("DELETE FROM user_admin WHERE id = :id");
    $deletestmt->bindParam(':id', $confirm_delete_id);
    $deletestmt->execute();

    if ($deletestmt) {
        $_SESSION['success'] = "ลบข้อมูลนี้เรียบร้อย";
        header("location: ../page/Teacher.php");
        exit();
    }
}

?>

<div class="content">
<?php include '../component/Admin/Teacher/Haeder.php'?>
<div class="table-container">
        <table class="custom-table">
        <tr>
        <th>ลำดับ</th>
        <th>ชื่อผู้ดูแล</th>
        <th>นามสกุลผู้ดูแล</th>
        <th>เบอร์ติดต่อ</th>
        <th>Emil</th>
        <th>ลบข้อมูล</th>
        </tr>
        <?php
        //คิวรี่ข้อมูลมาแสดงในตาราง
        require_once 'server.php';
        $stmt = $conn->prepare("SELECT * FROM user_admin");
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach($result as $k) {
        ?>

        <tr>
        <td>
        <div class="icon-wrapper">
            <a href="EditTeacher.php?id=<?= $k['id']; ?>"> <i class="fas fa-edit"></i></a>
            <?php echo $k['id']; ?> 
        </div>
        </td>

        <td><?php echo $k['firstname']; ?></td>
        <td><?php echo $k['lastname']; ?></td>
        <td><?php echo $k['number']; ?></td>
        <td><?php echo $k['email']; ?></td>

        <td>
        <a data-id="<?= $k['id']; ?>" href="?delete=<?= $k['id']; ?>" > <i class="fas fa-trash fa-lg"></i>
        </a>
        </td>
        </tr>
        <?php } ?>
        
    </table>
    </div>