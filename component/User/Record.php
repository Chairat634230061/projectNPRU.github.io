<div class="content">
    <p class="record-p">เพิ่มข้อมูล</p>
    <?php 
        require_once 'server.php';

        // ตรวจสอบว่าตัวแปร $user ถูกกำหนดค่าหรือไม่
        if (isset($_SESSION['user_login'])) {
            // ใช้ user_login เพื่อค้นหาข้อมูลผู้ใช้ในฐานข้อมูล
            $userId = $_SESSION['user_login'];
            $stmt = $conn->prepare("SELECT * FROM studentuser WHERE id = :userId");
            $stmt->bindParam(":userId", $userId);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    ?>
    <form action="../page/insert/insertUSER.php" method="post" enctype="multipart/form-data">
        <div class="Re-Data-laber">
            <label for="activity2" class="">เพิ่มกิจกรรม</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="activity2">
        </div>

        <div class="Re-Data-laber">
            <label for="mr_ms" class="">คำนำหน้า</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="mr_ms" value="<?php echo $user['mr_ms']; ?>" required readonly>
        </div>

        <div class="Re-Data-laber">
            <label for="firstname" class="">ชื่อ</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="firstname" value="<?php echo $user['firstname']; ?>" required readonly>
        </div>

        <div class="Re-Data-laber">
            <label for="lastname" class="">นามสกุล</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="lastname" value="<?php echo $user['lastname']; ?>" required readonly>
        </div>

        <div class="Re-Data-laber">
            <label for="studentID" class="">รหัสนักศึกษา</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="studentID" value="<?php echo $_SESSION['studentID']; ?>" required readonly>
        </div>

        <div class="Re-Data-laber">
            <label for="activity_date1" class="">เริ่มต้น</label>
        </div>
        <div class="Re-Data">
            <input type="date" class="npru-input" name="activity_date1" required>
        </div>

        <div class="Re-Data-laber">
            <label for="activity_date2" class="">สิ้นสุด</label>
        </div>
        <div class="Re-Data">
            <input type="date" class="npru-input" name="activity_date2" required>
        </div>

        <div class="Re-Data-laber">
            <label for="name_location" class="">สถานที่</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="name_location" required>
        </div>

        <div class="Re-Data-laber">
            <label for="collect_hours" class="">ชั่วโมง</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="collect_hours" required>
        </div>

        <div class="Re-Data-laber">
            <label for="img" class="">รูปภาพ</label>
        </div>
        <div class="Re-Data">
            <input type="file" class="npru-input" id="imgInput" name="img">
            <img width="100%" id="previewImg" alt="">
        </div>

        <div class="Re-Data-laber">
            <label for="pdf_link" class="">เอกสารผู้รับรอง</label>
        </div>
        <div class="Re-Data">
            <a href="https://drive.google.com/file/d/1u-UxClekdaVM3tijAGnGz2CJ5MBsAu_C/view?usp=sharing" target="_blank">***ดาวน์โหลด***</a>
        </div>

        <div class="Re-Data-laber">
            <label for="img_confirm" class="">แนบรูปเอกสารรับรอง</label>
        </div>
        <div class="Re-Data">
            <input type="file" class="npru-input" id="imgInput" name="img_confirm">
            <img width="100%" id="previewImg" alt="">
        </div>

        <div class="Re-Data-laber">
            <label for="message" class="">อธิบายรายละเอียดการเข้าร่วม</label>
        </div>
        <div class="Re-Data">
            <textarea class="npru-input" id="message-text" name="name_message"></textarea>
        </div>

        <div class="Re-Data">
            <button type="submit" name="submituser" class="npru-button" value="submituser">เพิ่มข้อมูล</button>
        </div>
    </form>
</div>
