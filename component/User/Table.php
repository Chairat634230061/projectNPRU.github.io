<div class="content">
    <?php include '../component/User/Haeder.php'?>
<div class="table-container">
        <table class="custom-table">
        <tr>
            <th>ชื่อกิจกรรม</th>
            <th>เริ่มต้น</th>
            <th>สิ้นสุด</th>
            <th>ชั่วโมงทั้งหมด</th>
            <th>สถานที่</th>
            <th>จำกัดจำนวน</th>
            <th>ผู้เข้าร่วมทั้งหมด</th>
            <th>เข้าร่วมกิจกรม</th>
        </tr>
        <?php
            // คิวรี่ข้อมูลแต่ละกิจกรรม
            $stmt = $conn->prepare("SELECT * FROM add_activity");
            $stmt->execute();
            $result = $stmt->fetchAll();

            foreach ($result as $k) {
                ?>

            <tr>
                <td><?php echo $k['name_activity']; ?></td>
                <td><?php echo $k['activity_date1']; ?></td>
                <td><?php echo $k['activity_date2']; ?></td>
                <td><?php echo $k['collect_hours']; ?></td>
                <td><?php echo $k['name_location']; ?></td>
                <td><?php echo $k['participant_limit']; ?></td>
                <td>
               <?php
                        // นับจำนวนผู้เข้าร่วมกิจกรรมจากตาราง join_activity
                        $stmt_count = $conn->prepare("SELECT COUNT(*) AS participant_count FROM join_activity WHERE name_activity = :name_activity");
                        $stmt_count->bindParam(":name_activity", $k['name_activity']);
                        $stmt_count->execute();
                        $row_count = $stmt_count->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <?php echo $row_count['participant_count']; ?> / <?php echo $k['participant_limit']; ?>
                    </td>
                    <td>
                        <?php
                        // เช็คว่ายังมีที่ว่างในการเข้าร่วมกิจกรรมหรือไม่
                        if ($row_count['participant_count'] < $k['participant_limit']) {
                            ?>
                          <a href="../page/Join.php?name_activity=<?= $k['name_activity']; ?>&activity_date1=<?= $k['activity_date1']; ?>&activity_date2=<?= $k['activity_date2']; ?>&name_location=<?= $k['name_location']; ?>" class='td-a' >เข้าร่วม</a>
                            <?php
                        } else {
                            echo "ผู้เข้าร่วมเต็มแล้ว";
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>