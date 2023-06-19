<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php 
     /* ---delete---  */ 

     if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $deletestmt = $conn->query("DELETE FROM podo WHERE id = $delete_id");
        $deletestmt->execute();

        if ($deletestmt) {
            $_SESSION['success'] = "Data has been deleted successfully";
            echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'ลบข้อมูลนี้เรียบร้อย',
                    icon: 'success',
                    timer: 5000,

                });
            })
        </script>";
        header("refresh:10; url=../page/HomeAdmin.php");
       
        }
    }
?>
<div class="content">
<?php include '../component/Admin/Activity/Haeder.php'?>
<div class="table-container">
        <table class="custom-table">
        <tr>
        <th>ลำดับ</th>
        <th>ชื่อกิจกรรม</th>
        <th>จำนวนชั่วโมงทั้งหมด</th>
        <th>สถานที่</th>
        <th>ผู้ดูแลกิจกรรม</th>
        <th>แก้ไข</th>
        <th>ลบข้อมูล</th>
        </tr>
        <?php
                    //คิวรี่ข้อมูลมาแสดงในตาราง
                    require_once 'server.php';
                    $stmt = $conn->prepare("SELECT * FROM podo");
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    foreach($result as $k) {
                    ?>

                    <tr>
                    <td><?php echo $k['id']; ?></td>
                    <td><?php echo $k['name_activity']; ?></td>
                    <td><?php echo $k['collect_hours']; ?></td>
                    <td><?php echo $k['name_location']; ?></td>
                    <td><?php echo $k['name_teacher']; ?></td>
                    <td>
                    <a href="EditActivity.php?id=<?= $k['id'];?>" class="Edit">Edit</a></td>
                    <td>
                    <a data-id="<?= $k['id']; ?>" href="?delete=<?= $k['id']; ?>" class="delete">Delete</a></td>
                    </tr>
                    <?php } ?>

    </table>
    </div>