<?php
session_start();

require_once './functions.php';
//header('location: ./login.php');

$product = getProduct($_GET['id']);
$category = getCategory($product->getCategory());
$categoryOthers = getCategoryOthers($category->getId());
if (isset($_SESSION['user']) && $_SESSION['user']) {
    $cartUser = getCartUser($_SESSION['user']['id']);
    $cartUserLength = 0;
    foreach ($cartUser as $cartProduct) {
        $cartUserLength += $cartProduct->getCount();
    }
}
$comments = getComments($_GET['id']);
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
    <script>
       function caroussel() {
           var i;
           var x = document.getElementsByClassName("mySlides");
           for (i = 0; i < x.length; i++) {
               x[i].style.display = "none";
           }
           myIndex++;
           if (myIndex > x.length) {myIndex = 1}
           x[myIndex-1].style.display = "block";
           setTimeout(caroussel, 2000);
       }
    </script>
</head>
<body>
<?php include './component/header.php'; ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-8">
            <div class="row mt-5 pb-3">
                <div class="col-4">
                    <img src="<?= $product->getImage()?>" alt="<?= $product->getName()?>" class="img-fluid">
                </div>
                <div class="col-8">
                    <h3><?= $product->getName()?></h3>
                    <p><?= $product->getDescription()?></p>
                    <p>Prix : <?= number_format($product->getPrice(), 2)?>€</p>
                    <p>Categorie : <?= $category->getName()?></p>
                    <form method="post" action="addCart.php">
                        <input type="hidden" value="<?= getURL()?>" name="url">
                        <button value="<?= $product->getId()?>" name="addCart" type="submit" class="btn btn-primary">Ajouter au panier</button>
                    </form>
                </div>
            </div>
            <hr>
            <div class="row">
                <h3>Commentaires</h3>
                <div class="col-12 mb-3">
                    <div class="card p-3 pb-0">
                        <form action="addComment.php" method="post">
                            <div class="form-group">
                                <label for="comment">Commentaire</label>
                                <textarea required name="comment" id="comment" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="rating">Note</label>
                                <select name="rating" id="rating" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <input type="hidden" value="<?= $_SESSION['user']['id']?>" name="userId">
                            <input type="hidden" value="<?= $_GET['id']?>" name="productId">
                            <div class="row justify-content-end">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary mt-2 mb-2">Envoyer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php foreach ($comments as $comment): ?>
                    <div class="col-12 mb-3">
                        <div class="card p-4 pb-0">
                            <div class="row justify-content-between">
                                <div class="col-auto">
                                    <p><?= $comment->getUserId()->getUsername()?></p>
                                </div>
                                <div class="col-auto">
                                    <?php for ($i = 0; $i < $comment->getStars(); $i++): ?>
                                        <i class="bi bi-star-fill"></i>
                                    <?php endfor; ?>
                                    <?php for ($i = $comment->getStars(); $i < 5; $i++): ?>
                                        <i class="bi bi-star"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <div class="row">
                                    <p><?= $comment->getComment()?></p>
                            </div>
                            <div class="row justify-content-end p-0 m-0">
                                <div class="col-auto">
                                    <p class="text-black-50"><?= $comment->getDate()?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-around">
                        <?php if (isset($_SESSION['user']) && $_SESSION['user']): ?>
                            <div class="col-auto"><h5>Votre Panier</h5></div>
                            <div class="col-auto"><p><i class="bi bi-cart me-1"></i><?= $cartUserLength ?> article(s)</p></div>
                        <?php else: ?>
                            <div class="col-auto"><h5>Panier</h5></div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body p-3">
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']): ?>
                        <?php if ($cartUserLength == 0): ?>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto">
                                            <?php if (isset($_SESSION['user']) && $_SESSION['user']): ?>
                                                <p>Votre panier est vide</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php foreach ($cartUser as $cartItem): ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-content-center">
                                            <div class="col-3">
                                                <img src="<?= $cartItem->getProduct()->getImage()?>" alt="<?= $cartItem->getProduct()->getName()?>" class="img-fluid">
                                            </div>
                                            <div class="col-6">
                                                <p><?= $cartItem->getProduct()->getName()?></p>
                                                <p>Prix : <?= number_format($cartItem->getProduct()->getPrice(), 2)?>€</p>
                                            </div>
                                            <div class="col-3">
                                                <form method="post" action="changeCart.php">
                                                    <input type="hidden" name="id" value="<?= $cartItem->getId()?>">
                                                    <input type="hidden" name="url" value="<?= getURL()?>">
                                                    <label for="quantity"></label>
                                                    <input type="number" name="quantity" min="0" value="<?= $cartItem->getCount()?>" class="form-control">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    <a href="#" class="mt-3 btn-primary btn">Valider</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-auto">
                                        <p>Vous n'êtes pas connecté</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-9">
                    <h3>Dans la même catégorie</h3>
                <hr>
                </div>
                <?php foreach ($categoryOthers as $product) : ?>
                    <div class="col-12 p-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img class="card-img" src="<?= $product->getImage() ?>" alt="Card image cap">
                                    </div>
                                    <div class="col-8">
                                        <h5 class="card-title"><?= $product->getName() ?></h5>
                                        <p class="card-text" style="font-size: 14px"><?= strlen($product->getDescription()) >= 50 ? substr($product->getDescription(), 0, 50) . '...' : $product->getDescription() ?></p>
                                        <div class="row align-content-center ">
                                            <div class="col-6">
                                                <span style="font-size: 14px" class="price ms-4 me-5"><?= number_format($product->getPrice(),2)?>€</span>
                                            </div>
                                            <div class="col-3">
                                                <a  href="./product.php?id=<?= $product->getId() ?>" class="btn btn-primary">Voir</a>
                                            </div>
                                            <div class="col-3">
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
                <?php endforeach;?>
            </div>
        </div>
    </div>

</div>
<?php include './component/footer.php'; ?>
</body>

</html>

