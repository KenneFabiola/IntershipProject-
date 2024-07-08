<?php
// require_once("../../Database.php");
// require_once("../repositories/UserRepository.php");

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'Database.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'UserRepository.php';


$database = new Database();
$this ->pdo = $database->connect(); 

$roleRepository = new RoleRepository();
