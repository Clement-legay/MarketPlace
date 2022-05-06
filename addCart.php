<?php
session_start();
require_once 'functions.php';

if (isset($_POST['addCart'])) {
    addcartProduct($_SESSION['user']['id'], $_POST['addCart']);
    header('Location: ' . $_POST['url']);
} else {
    header('Location: /index.php');
}


