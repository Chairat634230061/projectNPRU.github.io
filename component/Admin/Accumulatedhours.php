<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

<div class="content">
    <div class="Add">
        <p>ชั่วโมงสะสม ผู้กู้กยศ.</p>
    </div>
    <form action="" method="GET">
        <div class="form-group">
            <label for="studentID">รหัสนักศึกษา:</label>
            <input type="text" class="form-control" id="studentID" name="studentID" placeholder="กรอกรหัสนักศึกษา">
            <button type="submit" class="hoursbutton">ตรวจสอบ</button>
        </div>
    </form>
    <form action="" method="GET">
        <div class="form-group">
            <label for="studygroup">หมู่เรียน:</label>
            <input type="text" class="form-control" id="studygroup" name="studygroup" placeholder="กรอกหมู่เรียน">
            <button type="submit" class="hoursbutton">ตรวจสอบ</button>
        </div>
    </form>
    <div class="containerID">
        <?php
        require_once 'server.php';

        if (isset($_GET['studentID'])) {
            $student_id = $_GET['studentID'];
            $stmt = $conn->prepare("SELECT mr_ms, firstname, lastname, studygroup, GROUP_CONCAT(name_activity SEPARATOR ' ') AS activities, GROUP_CONCAT(activity2 SEPARATOR ' ') AS added_activities, studentID, SUM(collect_hours) AS total_hours FROM successful WHERE studentID = :student_id GROUP BY mr_ms, firstname, lastname, studygroup, studentID");
            $stmt->bindParam(':student_id', $student_id);
        } elseif (isset($_GET['studygroup'])) {
            $studygroup = $_GET['studygroup'];
            $stmt = $conn->prepare("SELECT mr_ms, firstname, lastname, studygroup, GROUP_CONCAT(name_activity SEPARATOR ' ') AS activities, GROUP_CONCAT(activity2 SEPARATOR ' ') AS added_activities, studentID, SUM(collect_hours) AS total_hours FROM successful WHERE studygroup = :studygroup GROUP BY mr_ms, firstname, lastname, studygroup, studentID");
            $stmt->bindParam(':studygroup', $studygroup);
        } else {
            $stmt = $conn->prepare("SELECT mr_ms, firstname, lastname, studygroup, GROUP_CONCAT(name_activity SEPARATOR ' ') AS activities, GROUP_CONCAT(activity2 SEPARATOR ' ') AS added_activities, studentID, SUM(collect_hours) AS total_hours FROM successful GROUP BY mr_ms, firstname, lastname, studygroup, studentID");
        }
        
        $stmt->execute();
        $result = $stmt->fetchAll();

        if ($result) {
            echo "<table class='custom-table mt-4'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>ลำดับ</th>";
            echo "<th>คำนำหน้า</th>";
            echo "<th>ชื่อ</th>";
            echo "<th>นามสกุล</th>";
            echo "<th>หมู่เรียน</th>";
            echo "<th>กิจกรรมทั้งหมด</th>";
            echo "<th>เพิ่มด้วยตนเอง</th>";
            echo "<th>รหัสนักศึกษา</th>";
            echo "<th>จำนวนชั่วโมง</th>";
            echo "<th>ผลการตรวจสอบ</th>"; // เพิ่มช่องเก็บผลการตรวจสอบ
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($result as $index => $activity) {
                echo "<tr>";
                echo "<td>" . ($index + 1) . "</td>";
                echo "<td>" . $activity['mr_ms'] . "</td>";
                echo "<td>" . $activity['firstname'] . "</td>";
                echo "<td>" . $activity['lastname'] . "</td>";
                echo "<td>" . $activity['studygroup'] . "</td>";
                echo "<td>" . $activity['activities'] . "</td>";
                echo "<td>" . $activity['added_activities'] . "</td>";
                echo "<td>" . $activity['studentID'] . "</td>";
                echo "<td>" . $activity['total_hours'] . "</td>";
                
                // เพิ่มโค้ด JavaScript เพื่อตรวจสอบจำนวนชั่วโมงสะสมและแสดงผล
                echo "<td>";
                if ($activity['total_hours'] >= 36) {
                    echo "ผ่าน";
                } else {
                    echo "ไม่ผ่าน";
                }
                echo "</td>";
                
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            // ไม่พบข้อมูลในตาราง successful
            echo "<div class='mt-4 alert alert-warning'>ไม่พบข้อมูลกิจกรรมที่บันทึกไว้</div>";
            echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            icon: 'warning',
                            title: 'ไม่พบข้อมูล',
                            text: 'ไม่พบข้อมูลกิจกรรมที่บันทึกไว้ในระบบ',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    });
                </script>";
        }

        ?>
    </div>
</div>
