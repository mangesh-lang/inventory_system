<?php
if(session_status() === PHP_SESSION_NONE){ session_start(); }
require_once __DIR__.'/db.php';
require_once __DIR__.'/functions.php';
if(!isset($_SESSION['user_id'])){ header('Location: '.$base_url.'login.php'); exit(); }
function require_role($roles){
    if(!in_array($_SESSION['role'], (array)$roles)){
        header('Location: ../unauthorized.php'); exit();
    }
}
?>
