<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
if (!is_logged_in()) {
    error_redirect('../index.php');
}

if (isset($_GET['acceptAbst'])) {

    $get_topic = (int)sanitize($_GET['acceptAbst']);
    $rev_id = $user_data['id'];
    $sql = $db->query("SELECT * FROM `propose_topic` WHERE topic_id = '{$get_topic}'");
    $topic_sql = mysqli_fetch_assoc($sql);
    $res_id = (int)$topic_sql['user_ids'];

    $check_topic = (int)sanitize($_GET['acceptAbst']);

    $row = $db->query("SELECT * FROM `res_uploads` WHERE `res_topic` = '{$check_topic}'");
    $result = mysqli_num_rows($row);

    if ($result == 0) {
        $_SESSION['error_mesg'] .= 'action Denied! Researcher do not Upload FILES.';
        header('Location: preview.php?prevTopic=' . $get_topic);
    } else {
        $db->query("INSERT INTO `rev_comments`(`res_id`, `topic_id`, `rev_id`) VALUES ('{$res_id}', '{$get_topic}', '{$rev_id}')");
        $db->query("UPDATE `res_uploads` SET abst_accept = '1' WHERE `res_topic` = '{$get_topic}'");
        $_SESSION['success_mesg'] .= 'The abstract paper is now accepted, the researcher can now upload the draft file';
        header('Location: preview.php?prevTopic=' . $get_topic);
    }
}

if (isset($_GET['acceptDraft'])) {

    $get_topic = (int)sanitize($_GET['acceptDraft']);
    $rev_id = $user_data['id'];
    $sql = $db->query("SELECT * FROM `propose_topic` WHERE topic_id = '{$get_topic}'");
    $topic_sql = mysqli_fetch_assoc($sql);
    $res_id = (int)$topic_sql['user_ids'];

    $check_topic = (int)sanitize($_GET['acceptDraft']);

    $row = $db->query("SELECT * FROM `draft_uploads` WHERE `res_topic` = '{$check_topic}'");
    $result = mysqli_num_rows($row);

    if ($result == 0) {
        $_SESSION['error_mesg'] .= 'action Denied! Researcher do not Upload FILES.';
        header('Location: preview.php?prevTopic=' . $get_topic);
    } else {
        $db->query("INSERT INTO `draft_rev_comment` (`res_id`, `topic_id`, `rev_id`) VALUES ('{$res_id}', '{$get_topic}', '{$rev_id}')");
        $db->query("UPDATE `draft_uploads` SET abst_accept = '1' WHERE `res_topic` = '{$get_topic}'");
        $_SESSION['success_mesg'] .= 'The draft paper is now accepted, the researcher can now upload the report file';
        header('Location: preview.php?prevTopic=' . $get_topic);
    }
}

if (isset($_GET['rejAbst'])) {

    $get_topic = (int)sanitize($_GET['rejAbst']);
    $rev_id = $user_data['id'];
    $sql = $db->query("SELECT * FROM `propose_topic` WHERE topic_id = '{$get_topic}'");
    $topic_sql = mysqli_fetch_assoc($sql);
    $res_id = (int)$topic_sql['user_ids'];

    // $db->query("DELETE FROM `rev_comments` WHERE `topic_id` = '{$get_topic}'");
    $db->query("UPDATE `res_uploads` SET `abst_accept` = '2' WHERE `res_topic` = '{$get_topic}'");
    $_SESSION['success_mesg'] .= 'The abstract paper is now in REJECTED list to be reviewed again';
    header('Location: preview.php?prevTopic=' . $get_topic);
}

if (isset($_GET['rejDraft'])) {

    $get_topic = (int)sanitize($_GET['rejDraft']);
    $rev_id = $user_data['id'];
    $sql = $db->query("SELECT * FROM `propose_topic` WHERE topic_id = '{$get_topic}'");
    $topic_sql = mysqli_fetch_assoc($sql);
    $res_id = (int)$topic_sql['user_ids'];

    // $db->query("DELETE FROM `draft_rev_comment` WHERE `topic_id` = '{$get_topic}'");
    $db->query("UPDATE `draft_uploads` SET `accept_draft` = '2' WHERE `res_topic` = '{$get_topic}'");
    $_SESSION['success_mesg'] .= 'The draft paper is now in REJECTED list to be reviewed again';
    header('Location: preview.php?prevTopic=' . $get_topic);
}

if (isset($_POST['res_mesg'])) {
    $res = (isset($_POST['mesg']) ? sanitize($_POST['mesg']) : '');
    $res_topic = (isset($_POST['res_topic']) ? sanitize($_POST['res_topic']) : '');

    $db->query("UPDATE `rev_comments` SET `recommend_mesg` = '{$res}' WHERE topic_id = '{$res_topic}'");
    $_SESSION['success_mesg'] .= 'Message sent';
    header('Location: preview.php?prevTopic=' . $res_topic);
}

if (isset($_POST['res_draft_mesg'])) {
    $res = (isset($_POST['mesg']) ? sanitize($_POST['mesg']) : '');
    $res_topic = (isset($_POST['res_topic']) ? sanitize($_POST['res_topic']) : '');

    $db->query("UPDATE `draft_rev_comment` SET `recomment_mesg` = '{$res}' WHERE `topic_id` = '{$res_topic}'");
    $_SESSION['success_mesg'] .= 'Message sent';
    header('Location: preview.php?prevTopic=' . $res_topic);
}

if (isset($_GET['acceptReport'])) {

    $get_topic = (int)sanitize($_GET['acceptReport']);
    $check_topic = (int)sanitize($_GET['acceptReport']);

    $row = $db->query("SELECT * FROM `report_uploads` WHERE `res_topic` = '{$check_topic}'");
    $result = mysqli_num_rows($row);

    if ($result == 0) {
        $_SESSION['error_mesg'] .= 'action Denied! Researcher do not Upload FILES.';
        header('Location: preview.php?prevTopic=' . $get_topic);
    } else {
        $db->query("UPDATE `report_uploads` SET report_accept = '1' WHERE `res_topic` = '{$get_topic}'");
        $_SESSION['success_mesg'] .= 'The REPORT paper is now accepted, the research paper will be available for publication when the publisher released it.';
        header('Location: preview.php?prevTopic=' . $get_topic);
    }
}

if (isset($_GET['rejReport'])) {

    $get_topic = (int)sanitize($_GET['rejReport']);
    $check_topic = (int)sanitize($_GET['rejReport']);

    $row = $db->query("SELECT * FROM `report_uploads` WHERE `res_topic` = '{$check_topic}'");
    $result = mysqli_num_rows($row);

    if ($result == 0) {
        $_SESSION['error_mesg'] .= 'action Denied! Researcher do not Upload REPORT FILES.';
        header('Location: preview.php?prevTopic=' . $get_topic);
    } else {
        $db->query("UPDATE `report_uploads` SET `report_accept` = '2' WHERE `res_topic` = '{$get_topic}'");
        $_SESSION['success_mesg'] .= 'The REPORT paper is now in the REJECTED list.';
        header('Location: preview.php?prevTopic=' . $get_topic);
    }
}

if (isset($_POST['report_mesg'])) {
    $res = (isset($_POST['mesg']) ? sanitize($_POST['mesg']) : '');
    $res_topic = (isset($_POST['res_topic']) ? sanitize($_POST['res_topic']) : '');

    $db->query("UPDATE `report_uploads`SET `report_rev_comment` = '{$res}' WHERE res_topic = '{$res_topic}'");
    $_SESSION['success_mesg'] .= 'Message sent';
    header('Location: preview.php?prevTopic=' . $res_topic);
}
