<?php
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"></a><p class="text-white " style="padding-top: 10px">La Boulanj</p>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-md-auto gap-2">
                <li class="nav-item rounded">
                    <a class="nav-link active" aria-current="page" href="/index.php"><i class="bi bi-house-fill me-2"></i>Home</a>
                </li>
                <li class="nav-item rounded">
                    <a class="nav-link" href="/commandes.php?"><i class="bi bi-sort-up me-2"></i>Commandes</a>
                </li>
                <li class="nav-item rounded">
                    <a class="nav-link" href="/panier.php"><i class="bi bi-cart me-2"></i>Panier</a>
                </li>
                <li class="nav-item dropdown rounded">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-fill me-2"></i>Profile</a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <?php if(isset($_SESSION['user']) && $_SESSION['user']) : ?>
                            <li><a class="dropdown-item" href="/account.php">Account</a></li>
                            <?php if ($_SESSION['user']['admin']) : ?>
                                <li><a class="dropdown-item" href="/admin.php">Admin</a></li>
                            <?php endif; ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/logic/logout.php">Logout</a></li>
                        <?php else : ?>
                            <li><a class="dropdown-item" href="/login.php">Login</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/register.php">Register</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

