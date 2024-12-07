
<?php
session_start();
if(!isset($_SESSION['role'])){
    header("Location: ../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ecommerce</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <!-- vendor css -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/calendar.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>

</head>
<body class="">
	<nav class="pcoded-navbar menu-light">
		<div class="navbar-wrapper  ">
			<div class="navbar-content scroll-div">
				<ul class="nav pcoded-inner-navbar ">
					<li class="nav-item pcoded-menu-caption">
						<label>Navigation</label>
					</li>
					<li class="nav-item">
						<a href="../dashboard/index.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
					</li>
					<li class="nav-item">
						<a href="../products/index.php" class="nav-link "><span class="pcoded-micon"><i class="fas fa-shopping-cart"></i></span><span class="pcoded-mtext">Products</span></a>
					</li>
    				<li class="nav-item">
						<a href="../categories/index.php" class="nav-link "><span class="pcoded-micon"><i class="far fa-list-alt"></i></span><span class="pcoded-mtext">Categories</span></a>
					</li>
					<li class="nav-item">
						<a href="../orders/index.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Orders</span></a>
					</li>
					<li class="nav-item">
						<a href="../users/index.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Users</span></a>
					</li>
                    <li class="nav-item">
						<a href="../calendar/index.php" class="nav-link"><span class="pcoded-micon"><i class="fas fa-calendar-alt"></i></span><span class="pcoded-mtext">Calendar</span></a>
					</li>
					<!-- <li class="nav-item pcoded-hasmenu">
						<a href="sales.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Sales</span></a>
					</li> -->
                    <li class="nav-item">
						<a href="../logout.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-log-out"></i></span><span class="pcoded-mtext">Logout</span></a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            <a href="#!" class="b-brand"><img src="../images/logo.png" alt="" class="logo"></a>
        </div>
	</header>
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10" id="breadcrumb-title"></h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="javascript:;" id="breadcrumb-title-sub"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>