<!DOCTYPE html>
<html lang="en">
<head>
    <?php
      $title = "";  
      include '../Components/head.php';
    ?>
    <link rel="stylesheet" href="../Css/app.css">
</head>
<body>
<section class="layout">
    <?php include '../Layouts/topbar.php'; ?>
    <?php 
        if(isset($_GET['page'])) {
            $selected = $_GET['page'];
        } else {
            $selected = "dashboard";
        }
        include '../Layouts/sidebar.php'; 
    ?>
    <main>
        <?php
            if(!isset($_GET['page']) || $_GET['page'] == "dashboard") {
                include '../Layouts/dashboard.php';
            }
            if(isset($_GET['page']) && $_GET['page'] == "reservas") {
                include '../Layouts/reservas.php';
            }
            if(isset($_GET['page']) && $_GET['page'] == "comprobantes") {
                include '../Layouts/comprobantes.php';
            }
            if(isset($_GET['page']) && $_GET['page'] == "perfil") {
                include '../Layouts/perfil.php';
            }
        ?>
    </main>
    <script src="../Scripts/validateToken.js" type="module"></script>
</section>
</body>
</html>