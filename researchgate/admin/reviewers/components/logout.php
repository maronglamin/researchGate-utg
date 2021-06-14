<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
unset($_SESSION['REVIEWER_SESSIONS']);
$_SESSION['success_mesg'] = 'Hope you enjoy working research';
header('Location: ../index.php');
