<?php
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
if (isset($_GET['abtInfo'])) {
    $abt_topic = (int)$_GET['abtInfo'];
    $result = $db->query("SELECT * FROM `res_uploads` WHERE `res_topic` = '{$abt_topic}'");
    $file = mysqli_fetch_assoc($result);
    $filepath =  $file['name_docu'];
    $pathname =  $file['name_docu'];

    if ($file == '') {
        header('Location: ' . PROOT . 'admin/researcher/components/res-desc.php');
        $_SESSION['error_mesg'] .= 'You did not upload an abstract file, please upload a file from here and if this is an error, consult our team of engineers';
    } else {
        header("Content-type: application/pdf");
        header('Content-Disposition: inline; filename="' . $filepath . '"');
        header('Content-Transfer-Encodeing: binary');
        header('Accept-Ranges: bytes');
        @readfile($pathname);
    }
}

if (isset($_GET['draftInfo'])) {
    $draft_topic = (int)$_GET['draftInfo'];
    $result = $db->query("SELECT * FROM `draft_uploads` WHERE `res_topic` = '{$draft_topic}'");
    $file = mysqli_fetch_assoc($result);
    $filepath =  $file['name_docu'];
    $pathname =  $file['name_docu'];

    if ($file == '') {
        header('Location: ' . PROOT . 'admin/researcher/components/res-desc.php');
        $_SESSION['error_mesg'] .= 'You did not upload the draft file, please upload a file from here and if this is an error, consult our team of engineers';
    } else {
        header("Content-type: application/pdf");
        header('Content-Disposition: inline; filename="' . $filepath . '"');
        header('Content-Transfer-Encodeing: binary');
        header('Accept-Ranges: bytes');
        @readfile($pathname);
    }
}

if (isset($_GET['paperInfo'])) {
    $abt_topic = (int)$_GET['paperInfo'];
    $result = $db->query("SELECT * FROM `report_uploads` WHERE `res_topic` = '{$abt_topic}'");
    $file = mysqli_fetch_assoc($result);
    $filepath =  $file['name_docu'];
    $pathname =  $file['name_docu'];

    if ($file == '') {
        header('Location: ' . PROOT . 'admin/researcher/components/res-desc.php');
        $_SESSION['error_mesg'] .= 'You did not upload the final report file, please upload a file from here and if this is an error, consult our team of engineers';
    } else {
        header("Content-type: application/pdf");
        header('Content-Disposition: inline; filename="' . $filepath . '"');
        header('Content-Transfer-Encodeing: binary');
        header('Accept-Ranges: bytes');
        @readfile($pathname);
    }
}
ob_get_flush();
