<?php
require_once 'functions.php';

if (isset($_POST['quantity'])) {
    changeOrder($_POST['id'], $_POST['quantity']);
    header('Location: ' . $_POST['url']);
} else {
    header('Location: index.php');
}
