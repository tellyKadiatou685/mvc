<?php

class DashboardController {
    public function index() {
        // Vérification supplémentaire de la connexion
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        require_once __DIR__ . '/../View/dashboard.php';
    }
}
?>