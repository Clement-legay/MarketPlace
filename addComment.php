<?php

require_once 'functions.php';

addComment($_POST['userId'], $_POST['productId'], $_POST['comment'], $_POST['rating']);

header('Location: product.php?id=' . $_POST['productId']);
