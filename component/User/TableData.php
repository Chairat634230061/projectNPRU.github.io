<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/2sweetalert@11"></script>
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
<?php 
     /* ---delete---  */ 

     if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $deletestmt = $conn->query("DELETE FROM info_student WHERE id = $delete_id");
        $deletestmt->execute();

        if ($deletestmt) {
            $_SESSION['success'] = "Data has been deleted successfully";
            echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'ลบข้อมูลนี้เรียบร้อย',
                    icon: 'success',
                    timer: 5000,

                });
            })
        </script>";
        header("refresh:10; url=../ConfirmPage.php");
           
        
        }
    }
?>
<div class="content">
<?php include '../component/Admin/Confirm/Haeder.php'?>
<div class="table-container">
        <table class="custom-table">
        <tr>
            <th>ชื่อกิจกรรม</th>
            <th>สถานที่</th>
            <th>จำนวนชั่วโมง</th>
            <th>วันที่บันทึกมา</th>
            <th>รูปภาพ</th>
            <th>รูปเอกสารรับรอง</th>
            <th>รายละเอียด</th>
        </tr>
        <?php
                // รหัสนักศึกษาที่เข้าระบบ
                $loggedInStudentID = $_SESSION['studentID'];

                // คิวรีข้อมูลจากตาราง info_student โดยใช้ INNER JOIN และเงื่อนไข WHERE เพื่อกรองเฉพาะข้อมูลของผู้ใช้ที่ studentID เท่ากับ studentID ที่เข้าระบบ
                $stmt = $conn->prepare("SELECT info_student.*, studentuser.* FROM info_student INNER JOIN studentuser ON info_student.studentID = studentuser.studentID WHERE info_student.studentID = :loggedInStudentID");
                $stmt->bindParam(':loggedInStudentID', $loggedInStudentID);
                $stmt->execute();
                $result = $stmt->fetchAll();

                foreach ($result as $row) {
                    ?>
                    <tr>
                        <td><?php echo $row['activity2']; ?></td>
                        <td><?php echo $row['name_location']; ?></td>
                        <td><?php echo $row['collect_hours']; ?></td>
                        <td><?php echo $row['name_time']; ?></td>
                        <td width="150px"><img class="rounded" width="100%" src="../page/uploadsIMG/<?php echo $row['img']; ?>" alt=""></td>
                        <td width="150px"><img class="rounded" width="100%" src="../page/imgConfirm/<?php echo $row['img_confirm']; ?>" alt=""></td>
                        <td><?php echo $row['name_message']; ?></td>
                    </tr>
                    <?php
                }
            ?>
            

    </table>
    </div>