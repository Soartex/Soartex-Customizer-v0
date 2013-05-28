<?php
//check user login
session_start(); 
if(!$_SESSION['logged']){ 
    header("Location: ../"); 
    exit; 
} 
?>