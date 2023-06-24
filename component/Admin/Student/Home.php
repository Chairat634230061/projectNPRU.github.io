<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php 

    require_once "server.php";
     /* ---delete---  */ 

     if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $deletestmt = $conn->query("DELETE FROM studentuser WHERE id = $delete_id");
        $deletestmt->execute();

        if ($deletestmt) {
            $_SESSION['success'] = "ลบข้อมูลนี้เรียบร้อย";
        header("location: ../page/Student.php");
        exit();
        
        }
    }
?>
<div class="content">
<?php include '../component/Admin/Student/Haeder.php'?>
<div class="table-container">
        <table class="custom-table">
        <tr>
        <th>ลำดับ</th>
        <th>รหัสนักศึกษา</th>
        <th>ชื่อจริงนักศึกษา</th>
        <th>นามสกุลนักศึกษา</th>
        <th>Email</th>
        <th>แก้ไข</th>
        <th>ลบข้อมูล</th>
        </tr>
        <?php
            //คิวรี่ข้อมูลมาแสดงในตาราง
            require_once 'server.php';
            $stmt = $conn->prepare("SELECT * FROM studentuser");
            $stmt->execute();
            $result = $stmt->fetchAll();
            foreach($result as $k) {
            ?>

            <tr>
            <td><?php echo $k['id']; ?></td>
            <td><?php echo $k['studentID']; ?></td>
            <td><?php echo $k['firstname']; ?></td>
            <td><?php echo $k['lastname']; ?></td>
            <td><?php echo $k['email']; ?></td>
            <td>
            <a href="EditStudent.php?id=<?= $k['id'];?>" class="Edit">Edit</a></td>
            <td>
            <a data-id="<?= $k['id']; ?>" href="?delete=<?= $k['id']; ?>" class="delete">Delete</a></td>
            </td>
        </tr>
            <?php } ?>

    </table>
    </div>