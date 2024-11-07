<?php
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (empty($nom)) {
        $errors['nom'] = "Le nom est requis.";
    } elseif (!preg_match('/^[a-zA-Z]/', $nom)) {
        $errors['nom'] = "Le nom doit commencer par une lettre.";
    } elseif (strlen($nom) < 5 || strlen($nom) > 15) {
        $errors['nom'] = "Le nom doit contenir entre 5 et 15 lettres.";
    }

    if (empty($prenom)) {
        $errors['prenom'] = "Le prénom est requis.";
    }

    if (empty($email)) {
        $errors['email'] = "L'email est requis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'email n'est pas valide.";
    }

    if (empty($message)) {
        $errors['message'] = "Le message est requis.";
    }

    if (empty($errors)) {
        // Traitement des données du formulaire
        echo "<p class='success-message'>Votre message a été envoyé avec succès.</p>";
    } else {
        // Afficher les erreurs
        foreach ($errors as $field => $error) {
            echo "<p class='error-message'>$error</p>";
        }
    }
}
?>
