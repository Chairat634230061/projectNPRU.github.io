<!-- edit -->
<div class="content">
    <p class="record-p">อัพเดทข้อมูลกิจกรรม</p>

    <form action="../page/Edit/editActivity.php" method="post">
        <?php if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $stmt = $conn->prepare("SELECT * FROM add_activity WHERE id = $id");
            $stmt->execute();
            $result = $stmt->fetchAll();
            foreach ($result as $k) {
        }
    }
    ?>
            <div class="Re-Data-laber">
            <label for="id" class="">ลำดับ</label>
            </div>
        <div class="Re-Data">
            <input type="text" readonly value="<?php echo $k['id']; ?>" class="npru-input" name="id" required>
        </div>
        
        <div class="Re-Data-laber">
            <label for="name_activity" class="">ชื่อกิจกรรม</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="name_activity" value="<?php echo $k['name_activity']; ?>"
                required>
        </div>

        <div class="Re-Data-laber">
            <label for="collect_hours" class="">จำนวนชั่วโมงทั้งหมด</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="collect_hours" value="<?php echo $k['collect_hours']; ?>"
                required>
        </div>
        <div class="Re-Data-laber">
            <label for="name_location" class="">สถานที่</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="name_location" value="<?php echo $k['name_location']; ?>"
                required>
        </div>
        <div class="Re-Data-laber">
            <label for="activity_date1" class="">เริ่มต้น</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="activity_date1" value="<?php echo $k['activity_date1']; ?>"
                required>
        </div>
        <div class="Re-Data-laber">
            <label for="activity_date2" class="">สิ้นสุด</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="activity_date2" value="<?php echo $k['activity_date2']; ?>"
                required>
        </div>
       
        <div class="Re-Data-laber">
            <label for="participant_limit" class="">จำกัดจำนวน</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="participant_limit" value="<?php echo $k['participant_limit']; ?>"
                required>
        </div>
       

        <div class="Re-Data">
        <button type="submit" name="update" class="npru-button">อัพเดทข้อมูล</button>
    </div>
    </form>
</div>
