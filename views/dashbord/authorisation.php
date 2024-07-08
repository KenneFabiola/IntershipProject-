<?php

 if(!isset($_SESSION['password']) || !isset($_SESSION['username'])) {
  header('Content-Type: application/json');
  echo json_encode(['error' => 'unauthorized']);
  die();
}

if($_SESSION['role'] !==1 && $_SESSION['role'] !==2 ) {
  {
     header('Content-Type: application/json');
      echo json_encode(['error' => 'unauthorized']);
      die();
  }

}

 
?>