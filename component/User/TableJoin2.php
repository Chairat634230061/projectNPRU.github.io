<script>
    $(document).ready(function() {
        // เพิ่มการตรวจสอบการคลิกที่รูปภาพ
        $('.rounded').click(function() {
            var imgUrl = $(this).attr('src'); // รับ URL ของรูปภาพที่คลิก
            var imgTag = '<img src="' + imgUrl + '" style="max-width: 100%; max-height: 100%;">'; // สร้างแท็ก <img> ใหม่โดยกำหนดขนาดสูงสุด
            Swal.fire({
                html: imgTag, // แทรกรูปภาพใน SweetAlert2
                showCloseButton: true, // แสดงปุ่มปิด
                showConfirmButton: false, // ซ่อนปุ่มยืนยัน
                customClass: {
                    popup: 'swal2-image-popup', // กำหนดคลาส CSS สำหรับการแสดงรูปภาพใน SweetAlert2
                },
            });
        });
    });
</script>
<div class="content">
    <div class="Add">
        <p>กิจกรรมอนุมัติที่เข้าร่วม</p>
    </div>
    <div class="table-container">
        <table class="custom-table">
            <tr>
                <th>ชื่อกิจกรรม</th>
                <th>รหัสนักศึกษา</th>
                <th>ชั่วโมงทั้งหมด</th>
                <th>รูปภาพ</th>
                <th>สถานนะ</th>
            </tr>
            <?php
            
            // รหัสนักศึกษาที่เข้าระบบ
            $loggedInStudentID = $_SESSION['studentID'];

            // คิวรีข้อมูลจากตาราง join_activity โดยใช้ INNER JOIN และเงื่อนไข WHERE เพื่อกรองเฉพาะข้อมูลของผู้ใช้ที่ studentID เท่ากับ studentID ที่เข้าระบบ
            $stmt = $conn->prepare("SELECT successful.*, studentuser.* 
            FROM successful 
            INNER JOIN studentuser ON successful.studentID = studentuser.studentID 
            WHERE successful.name_activity IS NOT NULL AND successful.name_activity != '' 
            AND successful.studentID = :loggedInStudentID");
            $stmt->bindParam(':loggedInStudentID', $loggedInStudentID);
            $stmt->execute();
            $result = $stmt->fetchAll();

        
            foreach ($result as $k) {
            ?>

                <tr>

                    <td><?php echo $k['name_activity']; ?></td>
                    <td><?php echo $k['studentID']; ?></td>
                    <td><?php echo $k['collect_hours']; ?></td>
                    <td width="150px">
                    <?php if(!empty($k['img'])) { ?>
                    <img class="rounded" width="100%" src="../page/Joinimg/<?php echo $k['img']; ?>" alt="">
                    <?php } else { ?>
                            ไม่มีรูปภาพ
                    <?php } ?>
                    </td>
                    <td><?php echo $k['user_status']; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>
