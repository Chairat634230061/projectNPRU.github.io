<div class="content">
    <p class="record-p">เพิ่มข้อมูลผู้ดูแล</p>

    <form action ="../page/Register/register_admin.php" method="post" >

        <div class="Re-Data-laber">
          <label for="firstname" class="">ชื่อผู้ดูแล</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="firstname" required>
          </div>
        <div class="Re-Data-laber">
          <label for="lastname" class="">นามสกุลผู้ดูแล</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="lastname" required>
          </div>

          <div class="Re-Data-laber">
            <label for="number" class="">เบอร์ติดต่อ</label>
          </div>
          <div class="Re-Data">
            <input type="text" class="npru-input" name="number" required>
          </div>
          <div class="Re-Data-laber">
            <label for="email" class="">Email</label>
          </div>
          <div class="Re-Data">
            <input type="text" class="npru-input" name="email" required>
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
             <button type="submit" name ="signupadmin" class="npru-button" value="submit">เพิ่มข้อมูล</button>
            </div>
        </form>
        
</div>