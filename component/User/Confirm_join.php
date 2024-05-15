<script>
    $(document).ready(function(){
        $('#imgInput').change(function(){
            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (ext == "jpg" || ext == "png" || ext == "jpeg" || ext == "gif" || ext == "pdf")) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#previewImg').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
    });
</script>
<div class="content">
    <p class="record-p">เพิ่มข้อมูลการเข้าร่วม</p>
    <form action="../page/Edit/editJoin.php" method="post" enctype="multipart/form-data">
        <?php 
        if (isset($_GET['name_activity'])) {
            $name_activity = $_GET['name_activity'];
            $stmt = $conn->prepare("SELECT * FROM join_activity WHERE name_activity = :name_activity");
            $stmt->bindParam(":name_activity", $name_activity);
            $stmt->execute();
            $result = $stmt->fetchAll();
            foreach ($result as $k) {
        ?>
        <?php } } ?>

        <div class="Re-Data-laber">
            <label for="name_activity" class="">ชื่อกิจกรรม</label>
        </div>
        <div class="Re-Data">
            <input type="text" readonly value="<?php echo $k['name_activity']; ?>" class="npru-input" name="name_activity" required>
        </div>
        <div class="Re-Data-laber">
            <label for="collect_hours" class="">ชั่วโมง</label>
        </div>
        <div class="Re-Data">
            <input type="text" class="npru-input" name="collect_hours" value="<?php echo $k['collect_hours']; ?>" required>
        </div>
        <div class="Re-Data-laber">
            <label for="img" class="">รูปภาพ</label>
        </div>
        <div class="Re-Data">
            <input type="file" class="npru-input" id="imgInput" name="img">
            <img width="100%" id="previewImg" alt="">
        </div>
        <div class="Re-Data">
            <button type="submit" name="update" class="npru-button">อัพเดทข้อมูล</button>
        </div>
    </form>
</div>