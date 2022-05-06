<?php
require_once 'functions.php';

updateUser($_SESSION['user']['id'], $_POST['name'], $_POST['email'], $_POST['password']);