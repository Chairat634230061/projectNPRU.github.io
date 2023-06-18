<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php 
    session_start();
    require_once "server.php" ;

    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $deletestmt = $conn->query("DELETE FROM info_student WHERE id = $delete_id");
        $deletestmt->execute();

        if ($deletestmt) {
            $_SESSION['success'] = "Data has been deleted successfully";
            echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'ลบข้อมูลนี้เรียบร้อย',
                    icon: 'success',
                    timer: 5000,

                });
            })
        </script>";
        header("refresh:10; url=adminActivity.php");
           
        
        }
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

    <?php include '../component/Navber.php'?>
    <?php include '../component/User/Sidebar.php'?>
    <?php include '../component/User/table.php'?>
    <?php include '../component/Footer.php'?>


     <!-- FONT -->
     <style> @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Mitr:wght@300&family=Prompt:wght@300&display=swap');
</style>

</body>
</html>