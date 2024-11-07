<?php
session_start();

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Mon Application</a>
            <div class="navbar-nav ms-auto">
                <span class="nav-link text-white">
                    <?php echo htmlspecialchars($user['email']); ?> 
                    (<?php echo htmlspecialchars($user['role']); ?>)
                </span>
                <a href="logout.php" class="nav-link">Déconnexion</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1>Bienvenue sur votre tableau de bord</h1>
                <p>Vous êtes connecté en tant que <?php echo htmlspecialchars($user['role']); ?></p>
            </div>
        </div>
    </div>
</body>
</html>