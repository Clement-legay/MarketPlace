<?php
require 'functions.php';

$result = addUser($_POST['email'], $_POST['password'], $_POST['username']);

if ($result) {
    header('Location: /login.php');
} else {
    header('Location: /inscription.php');
}
