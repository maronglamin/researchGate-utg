<?php

define('DB_HOST_NAME', "127.0.0.1");
define('DB_USER', "root");
define('DB_PASSWORD', "");
define('DB_NAME', "resGate");

// define('DB_HOST_NAME', "sql209.epizy.com");
// define('DB_USER', "epiz_26985044");
// define('DB_PASSWORD', "gmRNQd7gKfzwQ");
// define('DB_NAME', "epiz_26985044_resGate");



$db = mysqli_connect(DB_HOST_NAME, DB_USER, DB_PASSWORD, DB_NAME);

if (mysqli_connect_errno()) {
    echo "Data batabase connection fail with the fellowing errors: " . mysqli_connect_error();
    die();
}

// start session 
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/config/config.php';
require_once(ROOT . DS . "function" . DS . "helpers.php");
require_once(ROOT . DS . "function" . DS . "sql.function.php");

/*
    ResGate user's sessions
*/

if (isset($_SESSION['PUBLISHER_SESSIONS'])) {
    $user_id = $_SESSION['PUBLISHER_SESSIONS'];
    $query = $db->query("SELECT * FROM administrators WHERE id = '$user_id'");
    $user_data = mysqli_fetch_assoc($query);
    $fn = explode(' ', $user_data['full_name']);
    $user_data['first'] = $fn[0];
} elseif (isset($_SESSION['REVIEWER_SESSIONS'])) {
    $user_id = $_SESSION['REVIEWER_SESSIONS'];
    $query = $db->query("SELECT * FROM reviewers WHERE id = '$user_id'");
    $user_data = mysqli_fetch_assoc($query);
    $fn = explode(' ', $user_data['full_name']);
    $user_data['first'] = $fn[0];
} elseif (isset($_SESSION['RESEARCHER_SESSIONS'])) {
    $user_id = $_SESSION['RESEARCHER_SESSIONS'];
    $query = $db->query("SELECT * FROM researchers WHERE id = '$user_id'");
    $user_data = mysqli_fetch_assoc($query);
    $fn = explode(' ', $user_data['full_name']);
    $user_data['first'] = $fn[0];
}

if (isset($_SESSION['success_mesg'])) {
    echo '<div class="alert alert-success alert-dismissible text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Message!</strong>' . ' ' . $_SESSION['success_mesg'] . '</div>';
    unset($_SESSION['success_mesg']);
}
if (isset($_SESSION['error_mesg'])) {
    echo '<div class="alert alert-danger alert-dismissible text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong>' . ' ' . $_SESSION['error_mesg'] . '</div>';
    unset($_SESSION['error_mesg']);
}
