<?php
namespace App\Service;

class AuthService {
    private $users = [
        [
            'email' => 'admin@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => 'admin'
        ],
        [
            'email' => 'user@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => 'user'
        ]
    ];

    public function verifyCredentials($email, $password) {
        foreach ($this->users as $user) {
            if ($user['email'] === $email && password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false;
    }
}
?>