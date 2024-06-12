<?php
require_once("../../Database.php");
require_once("../repositories/UserRepository.php");


$database = new Database();
$this ->pdo = $database->connect(); 

$roleRepository = new RoleRepository();
