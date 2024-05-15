<div class="content">
    <p class="record-p">เพิ่มข้อมูล</p>

    <form action ="../page/Edit/editConfirmJoin.php" method="post">
    <?php 
    if (isset($_GET['name_activity'])) {
        require_once "server.php";
        $id = $_GET['name_activity'];
        $stmt = $conn->prepare("SELECT * FROM join_activity WHERE name_activity = :name_activity");
        $stmt->bindParam(':name_activity', $id);
        $stmt->execute();
        $result = $stmt->fetch(); // เปลี่ยนเป็น fetch() เนื่องจากเราต้องการแค่ข้อมูลเดียว
    ?>
        <div class="Re-Data-laber">
            <label for="name_activity" class="">ชื่อกิจกรรม</label>
        </div>
        <div class="Re-Data">
            <!-- แก้ชื่อ field เป็น name_activity -->
            <input type="text" readonly value="<?php echo $result['name_activity']; ?>" class="npru-input" name="name_activity" required>
        </div>

        <div class="Re-Data-laber">
            <label for="user_status" class="">สถานนะ</label>
        </div>
        <div class="Re-Data-radio">
            <input type="radio" id="pass" name="user_status" value="อนุมัติ" required>
            <label for="pass">อนุมัติ</label>
            <input type="radio" id="fail" name="user_status" value="ไม่อนุมัติ" required>
            <label for="fail">ไม่อนุมัติ</label>
        </div>

        <!-- เพิ่ม input hidden เพื่อส่งค่า id ไปกับฟอร์ม -->
        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">

        <div class="Re-Data">
            <button type="submit" name="update" class="npru-button">อัพเดทข้อมูล</button>
        </div>
    <?php 
    }
    ?>
    </form>
</div>
