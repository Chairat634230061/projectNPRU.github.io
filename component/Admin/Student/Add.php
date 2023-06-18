<div class="content">
    <p class="record-p">เพิ่มข้อมูลนักศึกษา</p>

    <form action ="../page/Register/register_user.php" method="post" >

        <div class="Re-Data-laber">
          <label for="studentID" class="">รหัสนักศึกษา</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="studentID" required>
          </div>
        <div class="Re-Data-laber">
          <label for="firstname" class="">ชื่อนักศึกษา</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="firstname" required>
          </div>
        <div class="Re-Data-laber">
          <label for="lastname" class="">นามสกุลนักศึกษา</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="lastname" required>
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
             <button type="submituser" name ="submituser" class="npru-button" value="signup">เพิ่มข้อมูล</button>
            </div>
        </form>
        
</div>