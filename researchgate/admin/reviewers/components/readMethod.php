<?php
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';


if (isset($_GET['readFile'])) {
    $abt_topic = (int)$_GET['readFile'];
    $result = $db->query("SELECT * FROM `res_uploads` WHERE `res_topic` = '{$abt_topic}'");
    $file = mysqli_fetch_assoc($result);
    $filepath =  ROOT . DS . 'admin/researcher/components/' . $file['name_docu'];
    $pathname = ROOT . DS .  'admin/researcher/components/' . $file['name_docu'];

    if ($file == '') {
        header('Location: preview.php?prevTopic=' . $abt_topic);
        $_SESSION['error_mesg'] .= 'There was no file uploaded by this reseacher';
    } else {
        header("Content-type: application/pdf");
        header('Content-Disposition: inline; filename="' . $filepath . '"');
        header('Content-Transfer-Encodeing: binary');
        header('Accept-Ranges: bytes');
        @readfile($pathname);
    }
}

if (isset($_GET['readDraft'])) {
    $abt_topic = (int)$_GET['readDraft'];
    $result = $db->query("SELECT * FROM `draft_uploads` WHERE `res_topic` = '{$abt_topic}'");
    $file = mysqli_fetch_assoc($result);
    $filepath =  ROOT . DS . 'admin/researcher/components/' . $file['name_docu'];
    $pathname = ROOT . DS .  'admin/researcher/components/' . $file['name_docu'];

    if ($file == '') {
        header('Location: preview.php?prevTopic=' . $abt_topic);
        $_SESSION['error_mesg'] .= 'There was no file uploaded by this reseacher';
    } else {
        header("Content-type: application/pdf");
        header('Content-Disposition: inline; filename="' . $filepath . '"');
        header('Content-Transfer-Encodeing: binary');
        header('Accept-Ranges: bytes');
        @readfile($pathname);
    }
}


if (isset($_GET['readReportFile'])) {
    $abt_topic = (int)$_GET['readReportFile'];
    $result = $db->query("SELECT * FROM `report_uploads` WHERE `res_topic` = '{$abt_topic}'");
    $file = mysqli_fetch_assoc($result);
    $filepath =  ROOT . DS . 'admin/researcher/components/' . $file['name_docu'];
    $pathname = ROOT . DS .  'admin/researcher/components/' . $file['name_docu'];

    if ($file == '') {
        header('Location: preview.php?prevTopic=' . $abt_topic);
        $_SESSION['error_mesg'] .= 'There was no file uploaded by this reseacher';
    } else {
        header("Content-type: application/pdf");
        header('Content-Disposition: inline; filename="' . $filepath . '"');
        header('Content-Transfer-Encodeing: binary');
        header('Accept-Ranges: bytes');
        @readfile($pathname);
    }
}
