<?php
    session_start();

    include_once ('./controller/user.php');
    include ('./controller/secureUrl.php');

    $userObj = new User();

    if (!isset($_SESSION['login'])) {
        header("Location:./index.php");
    }

    if (isset($_GET['logout'])){
        $userObj->logout();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Hotel Teyvat:ADMIN</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="./assets/styles/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Hotel Teyvat</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a href="home.php?logout=true" class="dropdown-item">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="home.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Main Page
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tabel
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php $pengguna = base64_url_encode("Pengguna") ?>
                                    <a class="nav-link" href="home.php?t=<?php echo $pengguna?>">Pengguna</a>
                                    <?php $resepsionis = base64_url_encode("Resepsionis") ?>
                                    <a class="nav-link" href="home.php?t=<?php echo $resepsionis?>">Resepsionis</a>
                                    <?php $manajer = base64_url_encode("Manajer") ?>
                                    <a class="nav-link" href="home.php?t=<?php echo $manajer?>">Manajer</a>
                                    <?php $kamar = base64_url_encode("Kamar") ?>
                                    <a class="nav-link" href="home.php?t=<?php echo $kamar?>">Kamar</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION['username'] ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <?php 
                        if (isset($_GET['t'])){
                            $table = base64_url_decode($_GET['t']); ?>
                    
                            <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Tabel <?php echo $table?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tabel</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabel <?php echo $table?>
                            </div>
                            <div class="card-body">
                                        <?php
                                                if ($table == "Pengguna"){
                                                    include_once('content/user.php');
                                                }else if ($table == "Resepsionis"){
                                                    include_once('content/resepsionis.php');
                                                }else if ($table == "Manajer"){
                                                    include_once('content/manajer.php');
                                                }else if ($table == "Kamar"){
                                                    include_once('content/kamar.php');
                                                }
                                        ?>
                            </div>
                        </div>
                    </div>
                        <?php }else {
                            include_once('./content/mainpage.php');
                        }
                    ?>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Hotel Teyvat</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="./js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="./js/datatables-simple-demo.js"></script>
    </body>
</html>
