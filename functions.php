<?php

function getDb() {
    return new PDO('mysql:host=localhost;dbname=rplace;charset=utf8', 'root', '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
}
