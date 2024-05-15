<?php 
    session_start();
    require_once "server.php" ;

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Mitr:wght@300&family=Prompt:wght@300&display=swap" rel="stylesheet">

</head>
<body>
    
    <div class="container">
        <div class="left-box">
            <h1 class="npru_h1">เลือกเพื่อเข้าสู่ระบบ</h1>
            <!-- ส่วนซ้าย -->
            <a href="Login/LoginUser.php" class="npru-button">เข้าสู่ระบบผู้กู้ยืม</a>
            <a href="Login/LoginAdmin.php" class="npru-button">เข้าสู่ระบบผู้ดูแล</a>
    
        </div>
        
        <div class="right-box">
            <!-- ส่วนขวา -->
            
                <img src="./img/npru-48.jpg" alt="npru" class="npruhome">
          
        </div>
    </div>
        

  <!-- FONT -->
    <style> @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Mitr:wght@300&family=Prompt:wght@300&display=swap');
</style>
</body>
</html>
