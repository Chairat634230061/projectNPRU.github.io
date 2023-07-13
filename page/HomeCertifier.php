<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
session_start();
require_once "server.php";

if (!isset($_SESSION['user_login'])) {
    $_SESSION['error'] = 'คุณต้องเข้าสู่ระบบเพื่อเข้าถึงหน้าดังกล่าว';
    header("location: ../Login/LoginCertifier.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeUser</title>
    <link rel="stylesheet" href="page.css">
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Mitr:wght@300&family=Prompt:wght@300&display=swap" rel="stylesheet">

</head>
<body>

    <?php include '../component/NavberCertifier.php'?>
    <?php include '../component/Certifier/Sidebar.php'?>
    <?php include '../component/Certifier/Home.php'?>
    <?php include '../component/Footer.php'?>




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


        <?php if(isset($_SESSION['success'])) : ?>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'success',
                    text: '<?php echo $_SESSION['success']; ?>',
                });
            });
            <?php unset($_SESSION['success']); ?>
        <?php endif ?>
</script>
<!-- SweetAlert2 -->


     <!-- FONT -->
     <style> @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Mitr:wght@300&family=Prompt:wght@300&display=swap');
</style>

</body>
</html>