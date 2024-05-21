<div class="content">
    <p class="record-p">ยืนยันกิจกรรม</p>

    <form action="../page/Edit/editConfirm.php" method="post">
        <?php
  require_once "server.php";
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $stmt = $conn->prepare("SELECT * FROM info_student WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetchAll();
            foreach ($result as $k) {
        ?>
                <div class="Re-Data-laber">
                    <label for="id" class="">ลำดับ</label>
                </div>
                <div class="Re-Data">
                    <input type="text" readonly value="<?php echo $k['id']; ?>" class="npru-input" name="id" required>
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
        <?php
            }
        }
        ?>
        <div class="Re-Data">
            <button type="submit" name="update" class="npru-button">ยืนยัน</button>
        </div>
    </form>

</div>
