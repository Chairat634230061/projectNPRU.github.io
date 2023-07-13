<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<?php
require_once "server.php";

?>

<div class="content">
<?php include '../component/Admin/Confirm/Haeder.php'?>
<div class="table-container">
        <table class="custom-table">
        <tr>
             <th>ลำดับ</th>
            <th>ชื่อกิจกรรม</th>
            <th>รหัสนักศึกษา</th>
            <th>จำนวนชั่วโมง</th>
            <th>วันที่บันทึกมา</th>
            <th>รูปภาพ</th>
            <th>รายละเอียด</th>
            <th>สถานะการรับรอง</th>
            <th>รับรองสถานะ</th>
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
            <td><?php echo $k['collect_hours']; ?></td>
            <td><?php echo $k['name_time']; ?></td>
            <td width="150px" ><img class="rounded" width="100%"  src="../page/uploadsIMG/<?php echo $k['img']; ?>" alt=""></td>
            <td><?php echo $k['name_message']; ?></td>
            <td><?php echo $k['user_confirm'];?>
            </td>
            <td>
            <a href="EditCF.php?id=<?= $k['id']; ?>" class='td-a'>ยืนยัน</a>
        </td>
           
    
            </tr>
            <?php } ?>

    </table>
    </div>