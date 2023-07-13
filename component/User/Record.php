<div class="content">
    <p class="record-p">เพิ่มข้อมูล</p>

    <form action ="../page/insert/insertUSER.php" method="post" enctype="multipart/form-data">


      <div class="Re-Data-laber">
        <label for="activity" class="select-label">เลือกกิจกรรม</label>
      </div>
      <div class="Re-Data">
      <select  class="form-select" aria-label="Default select example" name="user_activity"required>
        <option selected>กรุณาเลือก</option required>
        <?php       
                    $stmt = $conn->prepare("SELECT * FROM podo");
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    foreach($result as $k) {
        ?>
            
            <option value="<?php echo $k['name_activity']; ?>"><?php echo $k['name_activity']; ?></option>
          <?php } ?>
          <option>เพิ่มด้วยตนเอง</option required>
        </select>
        </div>

        <div class="Re-Data-laber">
        <label for="activity" class="select-label">เลือกผู้รับรอง</label>
      </div>
      <div class="Re-Data">
      <select  class="form-select" aria-label="Default select example" name="user_certifier"required>
        <option selected>กรุณาเลือก</option required>
        <?php       
                    $stmt = $conn->prepare("SELECT * FROM certifier");
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    foreach($result as $k) {
        ?>
            
            <option value="<?php echo $k['firstname']; ?>"><?php echo $k['firstname']; ?></option>
          <?php } ?>
        </select>
        </div>

      
       

        <div class="Re-Data-laber">
          <label for="activity2" class="">เพิ่มกิจกรรม</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="activity2">
          </div>
        <div class="Re-Data-laber">
          <label for="studentID" class="">รหัสนักศึกษา</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="studentID" required>
          </div>

          <div class="Re-Data-laber">
            <label for="collect_hours" class="">ชั่วโมง</label>
          </div>
          <div class="Re-Data">
            <input type="text" class="npru-input" name="collect_hours" required>
          </div>
          <div class="Re-Data-laber">
            <label for="img" class="">รูปภาพ</label>
          </div>
          <div class="Re-Data">
            <input type="file" class="npru-input" id="imgInput" name="img" >
            <img width = "100%" id="previewImg" alt="">
          </div>

          <div class="Re-Data-laber">
            <label for="message" class="">อธิบายรายละเอียดการเข้าร่วม</label> 
          </div>
          <div class="Re-Data">
            <textarea class="npru-input" id="message-text" name="name_message"></textarea>
          </div>

         <div class="Re-Data">
             <button type="submituser" name ="submituser" class="npru-button" value="submituser">เพิ่มข้อมูล</button>
      </div>
        </form>
        
</div>