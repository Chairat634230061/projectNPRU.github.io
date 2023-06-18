
<div class="content">
    <p class="record-p">เพิ่มข้อมูล</p>

    <form action ="../page/Edit/editConfirm.php" method="post" >
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
            <input type="text" value="<?php echo $k['id']; ?>" class="npru-input" name="id" required>
        </div>


        <div class="Re-Data-laber">
          <label for="user_status" class="">สถานนะ</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="user_status" required>
          </div>


          <div class="Re-Data">
        <button type="submit" name="update" class="npru-button">อัพเดทข้อมูล</button>
    </div>
        </form>
        
</div>