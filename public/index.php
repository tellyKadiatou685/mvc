<?php
session_start();

// Utilisateurs en dur
$users = [
    [
        'email' => 'admin@example.com',
        'password' => 'admin123',
        'role' => 'admin'
    ],
    [
        'email' => 'user@example.com',
        'password' => 'user123',
        'role' => 'user'
    ]
];

$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // Vérification des identifiants
    foreach ($users as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            $_SESSION['user'] = [
                'email' => $user['email'],
                'role' => $user['role']
            ];
            // Redirection vers le tableau de bord
            header("Location: dashboard.php");
            exit;
        }
    }
    
    // Si on arrive ici, les identifiants sont incorrects
    $error = "Email ou mot de passe incorrect";
}

// Si l'utilisateur est déjà connecté, rediriger vers le dashboard
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}

require_once __DIR__ . '/../src/View/login.php';
?>