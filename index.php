<?php
session_start();

require_once './functions.php';
//header('location: ./login.php');
if (isset($_GET['search']) && isset($_GET['category'])) {
    $products = getProductsFiltered($_GET['search'], $_GET['category']);
} else {
    $products = getProducts();
}

$categories = getCategories();
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

    <div class="search-bg d-flex justify-content-center align-items-center">
        <form method="get" action="">
            <label>
                <?php if (isset($_GET['search'])) : ?>
                    <input value="<?= $_GET['search']?>" class="form-control rounded" type="text" name="search" placeholder="Rechercher un article">
                <?php else : ?>
                    <input class="form-control rounded" type="text" name="search" placeholder="Rechercher un article">
                <?php endif; ?>
            </label>
            <label>
                <select name="category" class="form-control rounded">
                    <option value="0">Tous</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </label>

            <button style="background: none; border: none">
                <span class="input-group-text border-0" id="search-addon">
                    <i class="bi-search"></i>
                </span>
            </button>
        </form><br>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-4">
                <h3 class="text-black-50">Nos produits phares</h3>
                <hr class="dropdown-divider">
            </div>
        </div>
        <div class="row">
            <?php foreach ($products as $product) { ?>
                <div class="col-6 p-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <img class="card-img" src="<?= $product->getImage() ?>" alt="Card image cap">
                                </div>
                                <div class="col-8">
                                    <div class="row justify-content-between">
                                        <div class="col-auto"><h5 class="card-title"><?= $product->getName() ?></h5></div>
                                        <div class="col-auto">
                                            <?php for ($i = 0; $i < $product->getItemsLeft(); $i++): ?>
                                                <i class="bi bi-star-fill"></i>
                                            <?php endfor; ?>
                                            <?php for ($i = $product->getItemsLeft(); $i < 5; $i++): ?>
                                                <i class="bi bi-star"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    <p class="card-text" style="font-size: 16px"><?= strlen($product->getDescription()) >= 200 ? substr($product->getDescription(), 0, 200) . '...' : $product->getDescription() ?></p>
                                    <div class="row">
                                        <div class="col-auto">
                                            <span class="price ms-4 me-5"><?= number_format($product->getPrice(),2)?>€</span>
                                        </div>
                                        <div class="col-auto">
                                            <a href="./product.php?id=<?= $product->getId() ?>" class="btn btn-primary">Voir le produit</a>
                                        </div>
                                        <div class="col-auto">
                                            <form method="post" action="addCart.php">
                                                <input type="hidden" value="<?= getURL()?>" name="url">
                                                <button value="<?= $product->getId()?>" name="addCart" type="submit" class="btn btn-primary"><span class="bi-cart"></span></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<!--    <p class="text-black-50 fw-bold">Les meilleures produits livrées chez vous ! Café froid, Pain rassi et plus encore !</p>-->

    <?php include './component/footer.php'; ?>
    </body>

    </html>
</!DOCTYPE>