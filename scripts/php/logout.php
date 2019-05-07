<?php
  session_start();
  unset($_SESSION['user']);
  unset($_SESSION['targetname']);
  session_destroy();
  header("Location: ../../pages/logout.html");
?>