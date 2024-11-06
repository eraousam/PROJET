<?php
// Commencer une session pour gérer la connexion des utilisateurs
session_start();

// Message par défaut (vide)
$login_message = "";

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Connexion à la base de données (remplace avec tes propres informations de connexion)
    $conn = new mysqli('localhost', 'root', '', 'alaziz_btp');

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }

    // Requête SQL pour vérifier si l'utilisateur existe (tu dois sécuriser les données)
    $sql = "SELECT * FROM clients WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Connexion réussie
        $_SESSION['email'] = $email;  // Stocker l'email de l'utilisateur dans la session
        $login_message = "Connexion réussie, bienvenue!";
    } else {
        // Échec de connexion
        $login_message = "Email ou mot de passe incorrect.";
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AL-AZIZ BTP - Accueil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .header {
            background-color: #007BFF;
            color: white;
            text-align: center;
            padding: 50px 0;
        }

        .header h1 {
            margin: 0;
            font-size: 3rem;
        }

        .header p {
            font-size: 1.5rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .login-section, .housing-section, .contact-section {
            background-color: white;
            padding: 30px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .btn-login {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-login:hover {
            background-color: #0056b3;
        }

        .login-section p {
            margin-top: 10px;
        }

        .login-section a {
            color: #007BFF;
            text-decoration: none;
        }

        .login-section a:hover {
            text-decoration: underline;
        }

        /* Section housing */
        .housing-section img {
            width: 100%;
            max-width: 250px;
            margin: 10px;
        }

        .housing-section h2 {
            text-align: center;
        }

        .housing-grid {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .contact-section {
            text-align: center;
        }

        .contact-section h2 {
            margin-bottom: 20px;
        }

        .social-links a {
            margin: 0 10px;
            font-size: 1.5rem;
            text-decoration: none;
            color: #007BFF;
        }

        .social-links a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>

    <!-- En-tête du site -->
    <div class="header">
        <h1>Bienvenue dans AL-AZIZ BTP</h1>
        <p>Votre partenaire de confiance pour la construction et l'architecture</p>
    </div>

    <div class="container">

        <!-- Section Connexion des clients -->
        <section class="login-section">
            <h2>Connexion des clients</h2>

            <!-- Afficher un message de connexion (succès ou échec) -->
            <?php if (!empty($login_message)): ?>
                <p><?php echo $login_message; ?></p>
            <?php endif; ?>

            <!-- Formulaire de connexion -->
            <form action="" method="POST" class="login-form">
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn-login">Se connecter</button>
            </form>

            <!-- Lien pour s'inscrire -->
            <p>Pas encore de compte ? <a href="register.php">S'inscrire</a></p>
        </section>

        <!-- Section Plans de maisons -->
        <section class="housing-section">
            <h2>Sélectionnez votre type d'habitat</h2>
            <div class="housing-grid">
                <div>
                    <img src="r+1.jpg" alt="Maison R+1">
                    <p>Maison R+1</p>
                </div>
                <div>
                    <img src="r+2.jpg" alt="Maison R+2">
                    <p>Maison R+2</p>
                </div>
                <div>
                    <img src="r+3.jpg" alt="Maison R+3">
                    <p>Maison R+3</p>
                </div>
                <div>
                    <img src="r+4.jpg" alt="Maison R+4">
                    <p>Maison R+4</p>
                </div>
            </div>
        </section>

        <!-- Section Contact et réseaux sociaux -->
        <section class="contact-section">
            <h2>Contactez-nous</h2>
            <p>Passer une commande au 772325318 ou joignez-nous par email à <a href="mailto:souarebtp@gmail.com">souarebtp@gmail.com</a></p>
            <div class="social-links">
                <a href="#">Facebook</a>
                <a href="#">WhatsApp</a>
                <a href="#">Instagram</a>
                <a href="#">Telegram</a>
            </div>
        </section>

    </div>

</body>
</html>
