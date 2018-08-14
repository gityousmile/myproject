<?php
  $total = $_POST['total'];
  session_start();
  $_SESSION['total'] = $total;
  echo $_SESSION['total'];
?>