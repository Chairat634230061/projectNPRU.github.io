<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php 

    require_once "server.php";
    session_start();
     /* ---delete---  */ 

     if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $deletestmt = $conn->query("DELETE FROM user WHERE id = $delete_id");
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
        <th>เบอร์ติดต่อ</th>
        <th>Emil</th>
        <th>แก้ไข</th>
        <th>ลบข้อมูล</th>
        </tr>
        <?php
        //คิวรี่ข้อมูลมาแสดงในตาราง
        require_once 'server.php';
        $stmt = $conn->prepare("SELECT * FROM user");
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach($result as $k) {
        ?>

        <tr>
        <td><?php echo $k['id']; ?></td>
        <td><?php echo $k['firstname']; ?></td>
        <td><?php echo $k['number']; ?></td>
        <td><?php echo $k['email']; ?></td>
        <td>
        <a href="EditTeacher.php?id=<?= $k['id'];?>" class="Edit">Edit</a></td>
        <td>
        <a data-id="<?= $k['id']; ?>" href="?delete=<?= $k['id']; ?>" class="delete">Delete</a></td>
        </tr>
        <?php } ?>
        
    </table>
    </div>