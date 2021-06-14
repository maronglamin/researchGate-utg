<?
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
if (!is_logged_in()) {
    login_error_redirect();
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $res_publish = (int)sanitize($_GET['pub']);
    $db->query("UPDATE `propose_topic` SET `published` = 1 WHERE `topic_id` = '{$res_publish}'");
    header('Location: publish-paper.php');
    $_SESSION['success_mesg'] .= 'Paper published';
}