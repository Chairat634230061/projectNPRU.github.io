
<div class="content">
    <p class="record-p">เพิ่มข้อมูล</p>

    <form action ="../page/Edit/editCF.php" method="post" >
    <?php if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $stmt = $conn->prepare("SELECT * FROM info_student WHERE id = $id");
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
          <label for="user_confirm" class="">สถานนะ</label>
        </div>
        <div class="Re-Data-radio">
        <input type="radio" id="pass" name="user_confirm" value="รับรอง" required>
        <label for="pass">รับรอง</label>
        <input type="radio" id="fail" name="user_confirm" value="ไม่รับรอง" required>
        <label for="fail">ไม่รับรอง</label>
      </div>
      
          <div class="Re-Data">
        <button type="submit" name="update" class="npru-button">อัพเดทข้อมูล</button>
    </div>
        </form>
        
</div>