<?php
// admin.php
session_start();
$page = $_GET['page'];
if (isset($_SESSION['logintime']) && date('U') > $_SESSION['logintime'] + 7200000) {
  header('Location: actions/logout.php');
}
require_once 'config.php';
require_once ('../template/head.php');

if(!isset($_SESSION['username'])){

header('Location: index.php?page=login&messaggio=notloggedin');
}
?>

<?php
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
}

if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1) {
  header('Location: index.php?page=error&errorcode=403');
  die();
}

  if ($page !=basename($page) || !preg_match("/^[A-Za-z0-9\-_]+$/", $page) || !file_exists("admin/" . $page . ".php")) {
    $page = "error";
    $errorcode = 404;
    header('Location: index.php?page=' . $page . '&errorcode=' . $errorcode);
  }


 ?>


</head>

<?php require('../template/header.php'); ?>
<script defer>document.getElementById('header').innerHTML += "<?php echo ' ' .  str_replace('_', '-', $config_year); ?>";</script> <!-- defer attribute = waits until document is fully loaded to load the script -->



  <?php require('../template/menu.php'); ?>

  <div class="container" id="pagecontent">
    <?php
    // if (!isset($_page) || $page == "") {
    //   $page = 'home';
    // }
    require 'admin/' . $page . '.php';


    ?>
  </div>

  <?php require '../template/footer.php'; ?>
</body>
</html>
