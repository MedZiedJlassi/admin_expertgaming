<?php 

session_start();


if (empty($page)) {
    $page = "function";
    // On limite l'inclusion aux fichiers.php en ajoutant dynamiquement l'extension
    // On supprime également d'éventuels espaces
    $page = trim($page . ".php");
}

// On évite les caractères qui permettent de naviguer dans les répertoires
$page = str_replace("../", "protect", $page);
$page = str_replace(";", "protect", $page);
$page = str_replace("%", "protect", $page);

// On interdit l'inclusion de dossiers protégés par htaccess
if (preg_match("/config/", $page)) {
    echo $page;
} else {
    // On vérifie que la page est bien sur le serveur
    if (file_exists("../../../../config/" . $page) && $page != 'index.php') {
        include "../../../../config/" . $page;
    } else {
        echo "Page inexistante !";
    }
}

if(empty($_SESSION['id'])){

    ProtectEspace::administrateur("", "", "");

}else{

    ProtectEspace::administrateur($_SESSION['id'], $_SESSION['jeton'], $_SESSION['niveau']);

}
?>
<!DOCTYPE html>
<html class="loading bordered-layout" lang="Fr" data-layout="bordered-layout" data-textdirection="ltr">

<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <title>Gestion des Devis | Expert Gaming</title>
    <link rel="apple-touch-icon" href="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/images/ico/favicon.png">
    <link rel="shortcut icon" type="image/x-icon" href="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/css/animate/animate.min.css">
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/css/extensions/sweetalert2.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/css/themes/semi-dark-layout.css">
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/css/pages/ui-feather.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css">
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/css/pages/app-invoice-list.min.css">
    
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    <?php
	$page = '';
	if (empty($page)) {
	 $page = "top";
	 // On limite l'inclusion aux fichiers.php en ajoutant dynamiquement l'extension
	 // On supprime également d'éventuels espaces
	 $page = trim($page.".php");
	
	}
	
	// On évite les caractères qui permettent de naviguer dans les répertoires
	$page = str_replace("../","protect",$page);
	$page = str_replace(";","protect",$page);
	$page = str_replace("%","protect",$page);
	
	// On interdit l'inclusion de dossiers protégés par htaccess
	if (preg_match("/include/",$page)) {
	 echo "Vous n'avez pas accès à ce répertoire";
	 }
	
	else {
	
		// On vérifie que la page est bien sur le serveur
		if (file_exists("../../../include/".$page) && $page != 'index.php') {
		   include("../../../include/".$page); 
		}
	
		else {
			echo "Page inexistante !";
		}
	}
	
	?>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php
	$page = '';
	if (empty($page)) {
	 $page = "menu";
	 // On limite l'inclusion aux fichiers.php en ajoutant dynamiquement l'extension
	 // On supprime également d'éventuels espaces
	 $page = trim($page.".php");
	
	}
	
	// On évite les caractères qui permettent de naviguer dans les répertoires
	$page = str_replace("../","protect",$page);
	$page = str_replace(";","protect",$page);
	$page = str_replace("%","protect",$page);
	
	// On interdit l'inclusion de dossiers protégés par htaccess
	if (preg_match("/include/",$page)) {
	 echo "Vous n'avez pas accès à ce répertoire";
	 }
	
	else {
	
		// On vérifie que la page est bien sur le serveur
		if (file_exists("../../../include/".$page) && $page != 'index.php') {
		   include("../../../include/".$page); 
		}
	
		else {
			echo "Page inexistante !";
		}
	}
	
	?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">ADMINISTRATION</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active ">Devis</li>
                                    <li class="breadcrumb-item ">Gestion des devis</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <a  href="modif_ajout_devis.php" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle waves-effect waves-float waves-light">Ajouter un devis</a>
                    </div>
                </div>
            </div>
            <div class="content-body">
                        <section class="invoice-list-wrapper">
                            <div class="card">
                                <div class="card-datatable table-responsive">
                                    <table class="invoice-list-table table">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>#</th>
                                            <th><i data-feather="trending-up"></i></th>
                                            <th>Client</th>
                                            <th>Total</th>
                                            <th class="text-truncate">Issued Date</th>
                                            <th>Balance</th>
                                            <th>Invoice Status</th>
                                            <th class="cell-fit">Actions</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </section>

                    </div>
            <!-- END: Content-->

            <!-- Begin : main content -->
            <!--<div class="content-body">
                <div class="row">
                    <div class="col-12"> -->

                        

                        <!-- Basic table -->
                        <!-- <section id="basic-datatable">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <table class="datatables-basic table" id="datatable">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th>id</th>
                                                    <th>Propriétaire</th>
                                                    <th>Image</th>
                                                    <th>Titre</th>
                                                    <th>Modele</th>
                                                    <th>Ref</th>
                                                    <th>Prix (TND)</th>
                                                    <th>Promo</th> 
                                                    <th>top</th> 
                                                    <th>Dispo</th>                                                 
                                                    <th>Insertion</th>
                                                    <th>Statut</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section> -->
                        <!--/ Basic table -->

                    <!-- </div>
                    
                </div>

            </div>-->
            <!-- End : main content -->

            
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <?php
	$page = '';
	if (empty($page)) {
	 $page = "footer";
	 // On limite l'inclusion aux fichiers.php en ajoutant dynamiquement l'extension
	 // On supprime également d'éventuels espaces
	 $page = trim($page.".php");
	
	}
	
	// On évite les caractères qui permettent de naviguer dans les répertoires
	$page = str_replace("../","protect",$page);
	$page = str_replace(";","protect",$page);
	$page = str_replace("%","protect",$page);
	
	// On interdit l'inclusion de dossiers protégés par htaccess
	if (preg_match("/include/",$page)) {
	 echo "Vous n'avez pas accès à ce répertoire";
	 }
	
	else {
	
		// On vérifie que la page est bien sur le serveur
		if (file_exists("../../../include/".$page) && $page != 'index.php') {
		   include("../../../include/".$page); 
		}
	
		else {
			echo "Page inexistante !";
		}
	}
	
	?> 
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/js/extensions/moment.min.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/js/tables/datatable/responsive.bootstrap.min.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/js/core/app-menu.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script charset="utf-8"  src="<?php echo Admin::menudevis();?>table/js/webapp_liste_devis.js"></script>

    <script src="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/vendors/js/extensions/polyfill.min.js"></script>
    <!-- END: Page JS-->

    <!-- BEGIN: Page JS-->
    <script src="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/js/scripts/ui/ui-feather.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME']?>/admin_expertgaming/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js"></script>
    <script src="<?php echo Admin::menudevis();?>table/js/app-invoice-list.js"></script>
    <!-- END: Page JS-->
    
    <script>
        $(window).on('load', function () {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
    <script src="https://kit.fontawesome.com/7791373c6a.js" crossorigin="anonymous"></script>
</body>
<!-- END: Body-->

</html>