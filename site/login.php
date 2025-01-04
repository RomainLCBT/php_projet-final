<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <!--header-->
    <header class="bg-primary shadow text-white fixed-top d-flex align-items-center container-fluid ps-0" style="height: 7vh">
        <img src="../img/logo.png" alt="Logo" class="me-2" style="height: 7vh">
    </header>

    <!--container-->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
            <h1 class="text-center mb-4">Connexion</h1>
            <form action="../php/process_login.php" method="POST">

                <!-- Champ pour l'email -->
                <div class="mb-3">
                    <label class="form-label">Adresse e-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre e-mail" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>
                </div>



                <!-- Champ pour le mot de passe -->
                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                    <div class="invalid-feedback">
                        Veuillez entrer une adresse e-mail valide (avec un "@" et un ".").
                    </div>
                </div>



                <!-- Bouton de connexion -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </div>
                <div>
                    <input type="checkbox" id="rester_co" name="rester_co">
                    <label>Restez connecté</label>
                </div>


                <!-- Lien d'inscription -->
                <div class="text-center mt-3">
                    <a href="register.html" class="text-decoration-none">Créer un compte</a><br>
                </div>
            </form>
        </div>
    </div>
</body>

</html>