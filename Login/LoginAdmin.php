<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php 
    session_start();
    require_once "server.php" ;
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบผู้ดูแล</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="Login.css">
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Mitr:wght@300&family=Prompt:wght@300&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="left-box">
            <h1 class="npru_h1">เข้าสู่ระบบผู้ดูแล</h1>
            <!-- ส่วนซ้าย -->
            <form action="db-admin.php" method="post">
                <div class="user-box">
                    <label for="email" >อีเมลผู้ดูแล</label>
                    <input type="text" name='email' class="npru-input">
                </div>
                <div class="user-box">
                    <label for="password" >รหัสผ่าน</label>
                    <input type="password" name='password'class="npru-input">
            </div>

            <div class="user-box">
                <button type="submit" name='LoginAdmin' class="npru-button">เข้าสู่ระบบผู้ดูแล</button>
            </div>
            </form>
    </div>
    
    <div class="right-box">
        <!-- ส่วนขวา -->
        <img src="../img/npru-48.jpg" alt="npru" class="npruhome">
    </div>
</div>
 <!-- SweetAlert2 -->
 <script>
        <?php if(isset($_SESSION['error'])) : ?>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'error',
                    text: '<?php echo $_SESSION['error']; ?>',
                });
            });
            <?php unset($_SESSION['error']); ?>
        <?php endif ?>
    </script>
<!-- SweetAlert2 -->

<!-- FONT -->
<style> 
    @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Mitr:wght@300&family=Prompt:wght@300&display=swap');
</style>

<!-- FONT -->
</body>
</html>