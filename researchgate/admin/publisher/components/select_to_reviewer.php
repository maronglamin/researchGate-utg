<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
require_once(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "simple-query.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $rev_user = mysqli_fetch_assoc($results_res_permit);
    $id = $rev_user['id'];

    $rev_id = $user_data['id'];
    $data = array();
    $data[] = array(
        'rev_id' => $rev_id,
        'seen on selection' => 1,
    );
    $requested = json_encode($data);
    $db->query("UPDATE propose_topic SET interested_rev = $requested  WHERE user_ids = '$id'");
    $_SESSION['success_mesg'] = 'Action successfull. The researcher in your list';
    header('Location: res-permit.php');
    exit;
}
