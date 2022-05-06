<?php
session_start();
require_once 'functions.php';


if (!isset($_SESSION['user']) || !$_SESSION['user']['admin']) {
    header('Location: index.php');
}

if (isset($_GET['add_product']) && $_GET['add_product'] == 1) {
    if (isset($_POST['add_product'])) {
        addProduct($_POST['name'], $_POST['price'], $_POST['description'], $_POST['image'], $_POST['category']);
        $_POST['add_product'] = 0;
    }
}

if (isset($_GET['add_category']) && $_GET['add_category'] == 1) {
    if (isset($_POST['add_category'])) {
        addCategory($_POST['name']);
        $_POST['add_category'] = 0;
    }
}

if (isset($_POST['retour'])) {
    if (isset($_POST['add_product'])) {
        $_GET['add_product'] = 0;
    } elseif (isset($_POST['add_category'])) {
        unset($_GET['add_category']);
    }

    $_POST['retour'] = 0;
}

$categories = getCategories();
$products = getProducts();
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
    <div class="card w-50 h-60">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <h3>Admin</h3>
                </div>
                <?php if (isset($_GET['add_product']) || isset($_GET['add_category'])) :?>
                <div class="col-auto">
                        <button onclick="window.location= 'http://laboulanj/admin.php'" class="btn btn-primary">Retour</button>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="card-body">
            <?php if (!isset($_GET['add_product']) && !isset($_GET['add_category'])) : ?>
            <form method="get" class="mt-5">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h5 class="card-title text-center">Select what you wanna add</h5>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary btn-large" value="1" name="add_product">Add product</button>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary btn-large" value="1" name="add_category">Add category</button>
                    </div>
                </div>
            </form>
            <?php elseif (isset($_GET['add_product'])) : ?>
                <form method="post" action="">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="card-title text-center">Add a product</h5>
                        </div>
                        <div class="col-6">
                            <label for="name">Name</label>
                            <input required class="form-control rounded" type="text" name="name" id="name">
                        </div>
                        <div class="col-6">
                            <label for="price">Price</label>
                            <input required class="form-control rounded" min="0" step=".01" type="number" name="price" id="price">
                        </div>
                        <div class="col-12">
                            <label for="description">Description</label>
                            <textarea required name="description" id="description" class="form-control rounded"></textarea>
                        </div>
                        <div class="col-6">
                            <label for="image">Image (link)</label>
                            <input required class="form-control rounded" type="text" name="image" id="image">
                        </div>
                        <div class="col-6">
                            <label for="category">Category</label>
                            <select required class="form-control rounded" name="category" id="category">
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?php echo $category->getId(); ?>"><?php echo $category->getName(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="row justify-content-center mt-3">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary btn-large" name="add_product">Add product</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php else : ?>
                <form method="post">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="card-title text-center">Add a category</h5>
                        </div>
                        <div class="col-12">
                            <label for="name">Name</label>
                            <input required class="form-control rounded" type="text" name="name" id="name">
                        </div>
                        <div class="col-12">
                            <div class="row justify-content-center mt-3">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary btn-large" name="add_category">Add category</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php include './component/footer.php'; ?>
</body>

</html>
</!DOCTYPE>
