<?php
require_once('../function/helper.php');

if ($_SESSION['fk_role'] !== 'user') {
    header("location: " . BASE_URL . 'dashboard.php?page=admin');
    exit();
}
?>
 
<?php
$sidebar = 'template/sidebar.php';
$topbar = 'template/topbar.php';
if (file_exists($sidebar) && file_exists($topbar)) {
    include 'template/sidebar.php';
    include 'template/topbar.php';
} else {
    echo "404";
}
?>