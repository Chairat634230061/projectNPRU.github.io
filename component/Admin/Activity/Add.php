<div class="content">
    <p class="record-p">เพิ่มข้อมูลกิจกรรม</p>

    <form action ="../page/insert/insert.php" method="post" >

        <div class="Re-Data-laber">
          <label for="name_activity" class="">ชื่อกิจกรรม</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="name_activity" required>
          </div>

          <div class="Re-Data-laber">
            <label for="collect_hours" class="">จำนวนชั่วโมงทั้งหมด</label>
          </div>
          <div class="Re-Data">
            <input type="text" class="npru-input" name="collect_hours" required>
          </div>
          <div class="Re-Data-laber">
            <label for="name_location" class="">สถานที่</label>
          </div>
          <div class="Re-Data">
            <input type="text" class="npru-input" name="name_location" required>
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
         <div class="Re-Data">
             <button type="submit" name ="submit" class="npru-button" >เพิ่มข้อมูล</button>
            </div>
        </form>
        
</div>




