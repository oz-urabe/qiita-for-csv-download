<?php

// show all errors.
error_reporting(-1);

$pdo = new PDO('mysql:dbname=pdo_test', 'root', 'secret');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

header('Content-type: text/csv; charset=utf-8');
