<?php
namespace App\Service;

class LoginValidationService {
    public function validate($data) {
        $errors = [];

        if (empty($data['email'])) {
            $errors['email'] = "L'email est requis";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Format d'email invalide";
        }

        if (empty($data['password'])) {
            $errors['password'] = "Le mot de passe est requis";
        }

        return $errors;
    }

    public function verifyCredentials($pdo, $email, $password) {
        $stmt = $pdo->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function saveRememberToken($pdo, $userId, $token) {
        $stmt = $pdo->prepare("UPDATE users SET remember_token = ? WHERE id = ?");
        return $stmt->execute([$token, $userId]);
    }
}