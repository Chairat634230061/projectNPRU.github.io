<div class="content">
    <p class="record-p">ตรวจสอบการเข้าร่วม</p>
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

        // ตรวจสอบว่ามีค่า name_activity ที่ถูกส่งมาจาก URL หรือไม่
        if (isset($_GET['name_activity'])) {
            // รับค่าชื่อกิจกรรมจาก query parameter
            $name_activity = $_GET['name_activity'];
            $activity_date1 = $_GET['activity_date1'];
            $activity_date2 = $_GET['activity_date2'];
            $name_location = $_GET['name_location'];
        }
    ?>
    <form action="../page/insert/join_activity.php" method="post" enctype="multipart/form-data">
        <div class="Re-Data-laber">
            <label for="name_activity" class="">ชื่อกิจกรรม</label>
        </div>
        <div class="Re-Data">
            <input type="text" readonly value="<?= isset($name_activity) ? $name_activity : ''; ?>" class="npru-input" name="name_activity" required>
        </div>
        <div class="Re-Data-laber">
            <label for="name_location" class="">สถานที่</label>
        </div>
        <div class="Re-Data">
            <input type="text" readonly value="<?= isset($name_location) ? $name_location : ''; ?>" class="npru-input" name="name_location" required>
        </div>
        <div class="Re-Data-laber">
            <label for="firstname" class="">ชื่อ</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="firstname" value="<?= isset($user['firstname']) ? $user['firstname'] : ''; ?>" required readonly>
        </div>
        <div class="Re-Data-laber">
            <label for="lastname" class="">นามสกุล</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="lastname" value="<?= isset($user['lastname']) ? $user['lastname'] : ''; ?>" required readonly>
        </div>
        <div class="Re-Data-laber">
            <label for="studentID" class="">รหัสนักศึกษา</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="studentID" value="<?= isset($_SESSION['studentID']) ? $_SESSION['studentID'] : ''; ?>" required readonly>
        </div>
        <div class="Re-Data-laber">
            <label for="activity_date1" class="">เริ่มต้น</label>
        </div>
        <div class="Re-Data">
            <input type="text" readonly value="<?= isset($activity_date1) ? $activity_date1 : ''; ?>" class="npru-input" name="activity_date1" required>
        </div>
        <div class="Re-Data-laber">
            <label for="activity_date2" class="">สิ้นสุด</label>
        </div>
        <div class="Re-Data">
            <input type="text" readonly value="<?= isset($activity_date2) ? $activity_date2 : ''; ?>" class="npru-input" name="activity_date2" required>
        </div>
        <div class="Re-Data">
            <button type="Join" name="Join" class="npru-button" value="Join">เข้าร่วม</button>
            <a href="../page/HomeUser.php" class='td-a' >ย้อนกลับ</a>
        </div>
    </form>  
</div>
