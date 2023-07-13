<div class="content">
    <p class="record-p">เพิ่มข้อมูลนักศึกษา</p>

    <form action ="../page/Edit/editCertifier.php" method="post" >

    <?php if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $stmt = $conn->prepare("SELECT * FROM certifier WHERE id = $id");
            $stmt->execute();
            $result = $stmt->fetchAll();
            foreach($result as $k) {
       }
      }
       ?>
        <div class="Re-Data-laber">
            <label for="id" class="">ลำดับ</label>
            </div>
        <div class="Re-Data">
            <input type="text" readonly value="<?php echo $k['id']; ?>" class="npru-input" name="id" required>
        </div>

        <div class="Re-Data-laber">
          <label for="agency" class="">หน่วยงาน</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" value="<?php echo $k['agency']; ?>" name="agency" required>
          </div>
        <div class="Re-Data-laber">
          <label for="firstname" class="">ชื่อผู้รับรอง</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" value="<?php echo $k['firstname']; ?>" name="firstname" required>
          </div>
        <div class="Re-Data-laber">
          <label for="lastname" class="">นามสกุล</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" value="<?php echo $k['lastname']; ?>" name="lastname" required>
          </div>

          <div class="Re-Data-laber">
            <label for="email" class="">Email</label>
          </div>
          <div class="Re-Data">
            <input type="text" class="npru-input" value="<?php echo $k['email']; ?>" name="email" required>
          </div>
          <div class="Re-Data-laber">
            <label for="password" class="">รหัสผ่าน</label>
          </div>
          <div class="Re-Data">
            <input type="password" class="npru-input" name="password" required>
          </div>
          <div class="Re-Data-laber">
            <label for="c_password" class="">ยืนยันรหัสผ่าน</label>
          </div>
          <div class="Re-Data">
            <input type="password" class="npru-input" name="c_password" required>
          </div>

          <div class="Re-Data">
        <button type="submit" name="update" class="npru-button">อัพเดทข้อมูล</button>
    </div>
        </form>
        
</div>