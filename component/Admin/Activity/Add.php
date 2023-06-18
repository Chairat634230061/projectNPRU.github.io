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
            <label for="name_teacher" class="">ผู้ดูแล</label>
          </div>
          <div class="Re-Data">
            <input type="text" class="npru-input" name="name_teacher" required>
          </div>

         <div class="Re-Data">
             <button type="submit" name ="submit" class="npru-button" >เพิ่มข้อมูล</button>
            </div>
        </form>
        
</div>




