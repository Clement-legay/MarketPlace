<?php
require_once 'class/products.php';
require_once 'class/category.php';
require_once 'class/cartProduct.php';
require_once 'class/comments.php';
require_once 'class/user.php';

function getDb() {
    return new PDO('mysql:host=localhost;dbname=marketplace;charset=utf8', 'root', '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
}

function getProducts() {
    $db = getDb();
    $stmt = $db->prepare('SELECT * FROM products ORDER BY id DESC');
    $stmt->execute();
    $products = $stmt->fetchAll();

    $validProducts = [];

    foreach ($products as $product){
        $validProducts[] = new products(
            $product['id'],
            $product['name'],
            $product['society'],
            getGlobalRating($product['id']),
            $product['price'],
            $product['description'],
            $product['image'],
            $product['category']
        );
    }

    return $validProducts;
}

function getProductsFiltered($search, $category) {
    $db = getDb();
    if ($category == 0) {
        $stmt = $db->prepare('SELECT * FROM products WHERE name LIKE :searched ORDER BY id DESC');
    } else {
        $stmt = $db->prepare('SELECT * FROM products WHERE name LIKE :searched AND category = :category ORDER BY id DESC');
        $stmt->bindValue(':category', $category);
    }
    $stmt->bindValue(':searched', '%' . $search . '%');
    $stmt->execute();
    $products = $stmt->fetchAll();

    $validProducts = [];

    foreach ($products as $product){
        $validProducts[] = new products(
            $product['id'],
            $product['name'],
            $product['society'],
            getGlobalRating($product['id']),
            $product['price'],
            $product['description'],
            $product['image'],
            $product['category']
        );
    }

    return $validProducts;
}

function getProduct($id)
{
    $db = getDb();
    $stmt = $db->prepare('SELECT * FROM products WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $product = $stmt->fetch();

    return new products(
        $product['id'],
        $product['name'],
        $product['society'],
        getGlobalRating($product['id']),
        $product['price'],
        $product['description'],
        $product['image'],
        $product['category']
    );
}

function getGlobalRating($id)
{
    $db = getDb();
    $stmt = $db->prepare('SELECT AVG(stars) FROM comments WHERE productId = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $rating = $stmt->fetch();

    return $rating[0] == null ? 0 : ceil($rating[0]);
}

function getUser($id)
{
    $db = getDb();
    $stmt = $db->prepare('SELECT * FROM user WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $user = $stmt->fetch();

    return new user(
        $user['id'],
        $user['username'],
        $user['password'],
        $user['email'],
        $user['admin']
    );
}



function login($email, $password) {
    $db = getDb();
    $stmt = $db->prepare('SELECT * FROM user WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $users = $stmt->fetchAll();

    foreach ($users as $user) {
        if (password_verify($password, $user['password'])) {
            return $user;
        }
    }
    return false;

}

function getCategories() {
    $db = getDb();
    $stmt = $db->prepare('SELECT * FROM category');
    $stmt->execute();

    $categories = $stmt->fetchAll();

    $validCategories = [];

    foreach ($categories as $category){
        $validCategories[] = new Category(
            $category['id'],
            $category['name'],
            $category['description'],
            $category['image']
        );
    }

    return $validCategories;
}

function addProduct($name,  $price, $description, $image, $category) {
    $db = getDb();
    $stmt = $db->prepare('INSERT INTO products (name, price, description, image, category) VALUES (:nameproduct, :price, :description, :image, :category)');
    $stmt->bindParam(':nameproduct', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':category', $category);
    $stmt->execute();
}

function addCategory($name) {
    $db = getDb();
    $stmt = $db->prepare('INSERT INTO category (name) VALUES (:nameCat)');
    $stmt->bindParam(':nameCat', $name);
    $stmt->execute();
}

function addUser($email, $password, $username) {
    $db = getDb();
    $stmt = $db->prepare('SELECT * FROM user WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $emailExist = $stmt->fetch();

    if (!isset($emailExist['id'])) {
        $password = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $db->prepare('INSERT INTO user (email, password, username) VALUES (:email, :password, :username)');
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return true;
    } else {
        $_SESSION['error'] = 'Email already exist';
        return false;
    }
}

function updateUser($id, $email, $password, $username) {
    $db = getDb();
    $stmt = $db->prepare('SELECT * FROM user WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();

    if (isset($user['id'])) {
        $password = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $db->prepare('UPDATE user SET email = :email, password = :password, username = :username WHERE id = :id');

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return true;
    } else {
        $_SESSION['error'] = 'Email not found';
        return false;
    }
}

function getCategory($id)
{
    $db = getDb();
    $stmt = $db->prepare('SELECT * FROM category WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $category = $stmt->fetch();

    return new Category(
        $category['id'],
        $category['name'],
        $category['description'],
        $category['image']
    );
}
function getCategoryOthers($id) {
    $db = getDb();
    $stmt = $db->prepare('SELECT * FROM products WHERE category = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $categoryItems = $stmt->fetchAll();

    $validCategoryItems = [];

    foreach ($categoryItems as $categoryItem) {
        $validCategoryItems[] = new products(
            $categoryItem['id'],
            $categoryItem['name'],
            $categoryItem['society'],
            $categoryItem['itemsLeft'],
            $categoryItem['price'],
            $categoryItem['description'],
            $categoryItem['image'],
            $categoryItem['category']
        );
    }

    return $validCategoryItems;
}

function getCartUser($id) {
    $db = getDb();
    $stmt = $db->prepare('SELECT * FROM cartproduct WHERE idUser = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $cart = $stmt->fetchAll();

    $validCart = [];

    foreach ($cart as $item) {
        $validCart[] = new cartProduct(
            $item['id'],
            getProduct($item['idProduct']),
            $item['idUser'],
            $item['count']
        );

    }

    return $validCart;
}

function addcartProduct($idUser, $idProduct) {
    $db = getDb();
    $stmt = $db->prepare('SELECT * FROM cartproduct WHERE idUser = :idUser AND idProduct = :idProduct');
    $stmt->bindParam(':idUser', $idUser);
    $stmt->bindParam(':idProduct', $idProduct);
    $stmt->execute();
    $cart = $stmt->fetch();

    if (!isset($cart['id'])) {
        $stmt = $db->prepare('INSERT INTO cartproduct (idUser, idProduct) VALUES (:idUser, :idProduct)');
        $stmt->bindParam(':idUser', $idUser);
        $stmt->bindParam(':idProduct', $idProduct);
        $stmt->execute();
    } else {
        $stmt = $db->prepare('UPDATE cartproduct SET count = count + 1 WHERE id = :id');
        $stmt->bindParam(':id', $cart['id']);
        $stmt->execute();
    }
}

function getURL() {
    return 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

function getComments($id) {
    $db = getDb();
    $stmt = $db->prepare('SELECT * FROM comments WHERE productId = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $comments = $stmt->fetchAll();

    $validComments = [];

    foreach ($comments as $comment) {
        $validComments[] = new comments(
            $comment['id'],
            getUser($comment['userId']),
            $comment['productId'],
            $comment['comment'],
            $comment['stars'],
            $comment['date']
        );
    }

    return $validComments;
}

function addComment($idUser, $idProduct, $comment, $stars) {
    $db = getDb();
    $date = date('Y-m-d H:i:s');
    $stmt = $db->prepare('INSERT INTO comments (userId, productId, comment, stars, date) VALUES (:userId, :productId, :comment, :stars, :dateNow)');
    $stmt->bindParam(':userId', $idUser);
    $stmt->bindParam(':productId', $idProduct);
    $stmt->bindParam(':comment', $comment);
    $stmt->bindParam(':stars', $stars);
    $stmt->bindParam(':dateNow', $date);
    $stmt->execute();
}

function changeOrder($id, $num) {
    $db = getDb();
    if ($num == 0) {
        $stmt = $db->prepare('DELETE FROM cartproduct WHERE id = :id');
    } else {
        $stmt = $db->prepare('UPDATE cartproduct SET count = :num WHERE id = :id');
        $stmt->bindParam(':num', $num);
    }
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}