<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Inscription</title>
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
            <h3>Votre Compte</h3>
        </div>
        <div class="card-body">
            <form action="update.php" method="post">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label for="username" class="mb-3">Pseudo</label>
                            <input type="text" required class="form-control" id="username" name="username" value="<?= $_SESSION['user']['username']?>" placeholder="Pseudo">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="password" class="mb-3">Mot de passe</label>
                            <input type="password" required class="form-control" id="password" name="password" placeholder="Modifier mot de passe">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="email" class="mb-3">Email</label>
                            <input type="email" required class="form-control" id="email" name="email" placeholder="Email" value="<?= $_SESSION['user']['email']?>">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <?php if (isset($_SESSION['error']) && $_SESSION['error']) : ?>
                        <div class="col-auto me-2 mt-2">
                            <p><?= $_SESSION['error']?></p>
                        </div>
                    <?php endif; ?>
                    <div class="col-auto me-2 mt-2">
                        <button type="submit" name="submit" class="btn btn-primary align-self-end">Modifier</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include './component/footer.php'; ?>
</body>

</html>
