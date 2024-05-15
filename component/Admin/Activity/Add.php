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
         <label for="activity_date1" class="">เริ่มต้น</label>
          </div>
          <div class="Re-Data">
              <input type="date" class="npru-input" name="activity_date1" required>
          </div>
          <div class="Re-Data-laber">
              <label for="activity_date2" class="">สิ้นสุด</label>
          </div>
          <div class="Re-Data">
              <input type="date" class="npru-input" name="activity_date2" required>
          </div>
          <div class="Re-Data-laber">
          <label for="participant_limit" class="">จำกัดจำนวน</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="participant_limit" required>
          </div>
          
         <div class="Re-Data">
             <button type="submit" name ="submit" class="npru-button" >เพิ่มข้อมูล</button>
            </div>
        </form>
        
</div>




