<?php
session_start();
require_once 'functions.php';


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = login($email, $password);
    if ($user) {
        $_SESSION['user'] = $user;
        header('Location: index.php');
    } else {
        echo "<p>Wrong username or password</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <script rel="script" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php include './component/header.php'; ?>
<div class="d-flex vh-100 justify-content-center align-items-center">
            <div class="card w-50 h-50">
                <div class="card-header">
                    <h3>Connexion</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                            <div class="form-group mb-3">
                                <label for="email" class="mb-3">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="mb-3">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-auto me-2 mt-2">
                                    <button type="submit" name="submit" class="btn btn-primary align-self-end">Connexion</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>

</div>
<?php include './component/footer.php'; ?>
</body>

</html>
</!DOCTYPE>