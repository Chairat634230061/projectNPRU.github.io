    <!-- SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- SweetAlert2 -->
<?php 
    require_once "server.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AddActivity</title>
    <link rel="stylesheet" href="page.css">
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Mitr:wght@300&family=Prompt:wght@300&display=swap" rel="stylesheet">

</head>
<body>
    <?php include '../component/NavberAdmin.php'?>
    <?php include '../component/Admin/Sideber.php'?>
    <?php include '../component/Admin/Student/Add.php'?>
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
    </script>


<!-- FONT -->
    <style> @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Mitr:wght@300&family=Prompt:wght@300&display=swap');
</body>
</html>