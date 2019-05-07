<?php
  session_start();
  if($_SESSION['user'] != $_SESSION['targetname'] || empty($_SESSION['user']) || empty($_SESSION['targetname'])) {
    header("Location: ../../index.php");
  }
?>
