<?php
$page_title = 'Logout';
$page_description = '';
require_once __DIR__ . '/../../CLASS_CRUD/auth.class.php';
$auth = new Auth();
$auth->logout();
header('Location: /../../front/html/deconnexion.php');