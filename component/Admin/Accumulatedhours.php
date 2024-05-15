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
    <div class="containerID">
        <?php
        require_once 'server.php';

        // ตรวจสอบว่ามีการตั้งค่ารหัสนักศึกษาใน URL หรือไม่
        if (isset($_GET['studentID'])) {
            $student_id = $_GET['studentID'];

            // ดึงข้อมูลจากฐานข้อมูลตามรหัสนักศึกษา
            $stmt = $conn->prepare("SELECT * FROM successful WHERE studentID = :student_id");
            $stmt->bindParam(':student_id', $student_id);
            $stmt->execute();
            $result = $stmt->fetchAll();

            if ($result) {
                $total_hours = 0; // เริ่มต้นตัวนับชั่วโมงทั้งหมด
                echo "<table class='custom-table mt-4'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>ลำดับ</th>";
                echo "<th>ชื่อ</th>";
                echo "<th>นามสกุล</th>";
                echo "<th>ชื่อกิจกรรม</th>";
                echo "<th>เพิ่มด้วยตนเอง</th>";
                echo "<th>รหัสนักศึกษา</th>";
                echo "<th>จำนวนชั่วโมง</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                foreach ($result as $index => $activity) {
                    echo "<tr>";
                    echo "<td>" . ($index + 1) . "</td>";
                    echo "<td>" . $activity['firstname'] . "</td>";
                    echo "<td>" . $activity['lastname'] . "</td>";
                    echo "<td>" . $activity['name_activity'] . "</td>";
                    echo "<td>" . $activity['activity2'] . "</td>";
                    echo "<td>" . $activity['studentID'] . "</td>";
                    echo "<td>" . $activity['collect_hours'] . "</td>";
                    echo "</tr>";
                    $total_hours += intval($activity['collect_hours']); // เพิ่มชั่วโมงรวม
                }
                // เพิ่มแถวสำหรับยอดรวม
                echo "<tr>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td><strong>จำนวนชั่วโมงกิจกรรมทั้งหมด</strong></td>";
                echo "<td><strong>" . $total_hours . "</strong></td>";
                echo "</tr>";
                echo "</tbody>";
                echo "</table>";
            } else {
                // ไม่พบข้อมูลสำหรับรหัสนักศึกษาที่ระบุ
                echo "<div class='mt-4 alert alert-danger'>ไม่พบชั่วโมงสะสมสำหรับรหัสนักศึกษา $student_id</div>";
                echo "<script>
                        $(document).ready(function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่พบชั่วโมงสะสม',
                                text: 'ไม่พบชั่วโมงสะสมสำหรับรหัสนักศึกษา $student_id',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        });
                    </script>";
            }
        } else {
            // ดึงข้อมูลจากตาราง successful ทั้งหมด
            $stmt = $conn->prepare("SELECT * FROM successful");
            $stmt->execute();
            $result = $stmt->fetchAll();

            if ($result) {
                echo "<table class='custom-table mt-4'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>ลำดับ</th>";
                echo "<th>ชื่อ</th>";
                echo "<th>นามสกุล</th>";
                echo "<th>ชื่อกิจกรรม</th>";
                echo "<th>เพิ่มด้วยตนเอง</th>";
                echo "<th>รหัสนักศึกษา</th>";
                echo "<th>จำนวนชั่วโมง</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                foreach ($result as $index => $activity) {
                    echo "<tr>";
                    echo "<td>" . ($index + 1) . "</td>";
                    echo "<td>" . $activity['firstname'] . "</td>";
                    echo "<td>" . $activity['lastname'] . "</td>";
                    echo "<td>" . $activity['name_activity'] . "</td>";
                    echo "<td>" . $activity['activity2'] . "</td>";
                    echo "<td>" . $activity['studentID'] . "</td>";
                    echo "<td>" . $activity['collect_hours'] . "</td>";
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
        }
        ?>
    </div>
</div>
