<footer class="footer">
    <div class="footer-text">
        <?php 
        require_once 'server.php';

        if (isset($_SESSION['admin_login'])) {
            // ใช้ user_login เพื่อค้นหาข้อมูลผู้ใช้ในฐานข้อมูล
            $userId = $_SESSION['admin_login'];
            $stmt = $conn->prepare("SELECT * FROM user_admin WHERE id = :userId");
            $stmt->bindParam(":userId", $userId);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // แสดงชื่อและรหัสนักศึกษาของผู้ใช้ที่ล็อกอินแล้ว
            echo $user['mr_ms'] . ' '.$user['firstname'] . ' ' . $user['lastname'] . ' ' ;
        }
        ?>
    </div>
</footer>
