<footer class="footer">
    <div class="footer-text">
        <?php 
        session_start(); // เรียกใช้ session_start() เพื่อให้สามารถเข้าถึง $_SESSION ได้
        require_once 'server.php';

        if (isset($_SESSION['studentID'])) {
            // ตรวจสอบ studentID ของผู้ใช้ที่เข้าสู่ระบบ
            $studentID = $_SESSION['studentID'];

            // ใช้ studentID เพื่อค้นหาข้อมูลผู้ใช้ในฐานข้อมูล
            $stmt = $conn->prepare("SELECT * FROM studentuser WHERE studentID = :studentID");
            $stmt->bindParam(":studentID", $studentID);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // แสดงชื่อและรหัสนักศึกษาของผู้ใช้ที่ล็อกอินแล้ว
            echo $user['mr_ms'] . ' ' . $user['firstname'] . ' ' . $user['lastname'] . ' ' . $user['studentID'] . ' ' . $user['studygroup'];
        }
        ?>
    </div>
</footer>
