<?php
header('Content-Type: application/json');


require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'Database.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'AuthentificateService.php';


class AuthentificateController
{
    private $authentificate_service;

    public function __construct()
    {
        $this->authentificate_service = new AuthentificateService();
    }

    public function login()
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $username = $_POST['username'];
            $password = $_POST['password'];

            // Validate input
            if (!$username || !$password) {
                echo json_encode(['error' => 'Missing username or password']);
                return;
            }

            // Attempt login
            $connexion = $this->authentificate_service->login($username, $password);

            if ($connexion) {
                $_SESSION['id'] = $connexion->getId();
                $_SESSION['username'] = $connexion->getUsername();
                $_SESSION['password'] = $connexion->getPwd();
                $_SESSION['role'] = $connexion->getRoleId();
                

                if (method_exists($connexion, 'getRoleId')) {
                    $_SESSION['role'] = $connexion->getRoleId();

                    // Redirect based on user role
                    if ($connexion->getRoleId() === 1) {
                        header('Location: ../../views/dashbord/dashbord.php');
                        
                    } elseif ($connexion->getRoleId() === 2) {
                        header('Location: ../../views/dashbord/dashbord.php');
                    } elseif ($connexion->getRoleId() === 3) {
                        header('Location: ../../views/student.php');
                    } else {
                        echo "<script>alert('unknown role')</script>";
                    }
                } else {
                    
                    header('Location: ../../views/student.php');
                }

                echo json_encode(['success' => 'Authentication successful. Welcome, ' . $_SESSION['role']]);
            } else {
                echo json_encode(['error' => 'Failed to authenticate. Check your username and your password.']);
            }
        } catch (PDOException $e) {
            echo json_encode(['error' => 'PDOException: ' . $e->getMessage()]);
        }
    }

  
    public function logout() {
        if(isset($_POST['logout'])) {
            $this->authentificate_service->logout();
            header('location:../../views/index.php');
            exit();
        }
    }

}


// Initialisation et exécution du contrôleur
$database = new Database();
$pdo = $database->connect();
$controller = new AuthentificateController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->login();
} 
if(isset($_POST['logout'])) {
    $controller->logout();
}
