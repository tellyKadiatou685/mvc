<?php
namespace App\Controller;

use App\Service\AuthService;

class LoginController {
    private $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    public function login() {
        $errors = [];
        $error = null;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $remember = isset($_POST['remember']);

            // Validation
            if (empty($email)) {
                $errors['email'] = "L'email est requis";
            }
            if (empty($password)) {
                $errors['password'] = "Le mot de passe est requis";
            }

            if (empty($errors)) {
                $user = $this->authService->verifyCredentials($email, $password);

                if ($user) {
                    $_SESSION['user'] = [
                        'email' => $user['email'],
                        'role' => $user['role']
                    ];
                    
                    if ($remember) {
                        setcookie('remember_email', $email, time() + (30 * 24 * 60 * 60), '/');
                    }
                    
                    header("Location: /dashboard");
                    exit;
                } else {
                    $error = "Email ou mot de passe incorrect";
                }
            }
        }

        // Inclure la vue
        require_once __DIR__ . '/../View/login.php';
    }
}
?>