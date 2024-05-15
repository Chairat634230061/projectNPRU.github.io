<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

<div class="content">
    
    <div class="Add">
    <?php 
require_once 'server.php';

if (isset($_SESSION['user_login'])) {
    // ใช้ $_SESSION['user_login'] เพื่อตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
    // ในที่นี้คุณสามารถใช้ตัวแปร $user ที่ได้จากการค้นหาข้อมูลผู้ใช้ได้
    // เพื่อแสดงข้อมูลผู้ใช้ในหน้าเว็บได้
    $userId = $_SESSION['user_login'];
    $stmt = $conn->prepare("SELECT * FROM studentuser WHERE id = :userId");
    $stmt->bindParam(":userId", $userId);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="content">
    <div class="Add">
        <p>ชั่วโมงสะสมผู้กู้กยศ. : <?php echo $user['firstname'] . ' ' . $user['lastname'] . ' ' . $user['studentID'] ?></p>
    </div>
    <div class="table-container">
        <table class="custom-table">
            <tr>
                <th>ชื่อกิจกรรม</th>
                <th>ชื่อกิจกรรมที่เพิ่มเอง</th>
                <th>วันที่บันทึก</th>
                <th>ชั่วโมงทั้งหมด</th>
            </tr>
            <?php
            // รหัสนักศึกษาที่เข้าระบบ
            $loggedInStudentID = $_SESSION['studentID'];
            $stmt = $conn->prepare("SELECT successful.*, studentuser.* FROM successful INNER JOIN studentuser ON successful.studentID = studentuser.studentID WHERE successful.studentID = :loggedInStudentID");
            $stmt->bindParam(':loggedInStudentID', $loggedInStudentID);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_hours = 0;
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['name_activity'] . "</td>";
                echo "<td>" . $row['activity2'] . "</td>";
                echo "<td>" . $row['name_time'] . "</td>";
                echo "<td>" . $row['collect_hours'] . "</td>";
                echo "</tr>";
                $total_hours += intval($row['collect_hours']); // คำนวณจำนวนชั่วโมงทั้งหมด
            }
            ?>
            <tr>
                <td colspan="3"><strong>รวมชั่วโมงทั้งหมด</strong></td>
                <td><strong><?php echo $total_hours; ?></strong></td>
            </tr>
        </table>
    </div>
</div>
