<?php 
require 'db.php';
session_destroy();
header('Location: ../frontend/login.html');
