<div class="content">
    <?php include '../component/User/Haeder.php'?>
<div class="table-container">
        <table class="custom-table">
        <tr>
            <th>ชื่อกิจกรรม</th>
            <th>ชื่อผู้ดูแล</th>
            <th>ชั่วโมงทั้งหมด</th>
            <th>สถานที่</th>
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

            <td><?php echo $k['name_activity']; ?></td>
            <td><?php echo $k['name_teacher']; ?></td>
            <td><?php echo $k['collect_hours']; ?></td>
            <td><?php echo $k['name_location']; ?></td>
            </tr>
            <?php } ?>
    </table>
    </div>