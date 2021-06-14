<?php
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';

if (isset($_GET['loadFile'])) {
    $abt_topic_dowload = (int)$_GET['loadFile'];
    $resultdownload = $db->query("SELECT * FROM `res_uploads` WHERE `res_topic` = '{$abt_topic_dowload}'");
    $file = mysqli_fetch_assoc($resultdownload);
    $filepath =  ROOT . DS . 'admin/researcher/components/' . $file['name_docu'];
    $pathname = ROOT . DS .  'admin/researcher/components/' . $file['name_docu'];

    if ($file != '') {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($pathname));
        readfile($pathname);
    } else {
        header('Location: preview.php?prevTopic=' . $abt_topic_dowload);
        $_SESSION['error_mesg'] .= 'There was file uploaded by this reseacher';
    }
}

if (isset($_GET['loadDraft'])) {
    $abt_topic_dowload = (int)$_GET['loadDraft'];
    $resultdownload = $db->query("SELECT * FROM `draft_uploads` WHERE `res_topic` = '{$abt_topic_dowload}'");
    $file = mysqli_fetch_assoc($resultdownload);
    $filepath =  ROOT . DS . 'admin/researcher/components/' . $file['name_docu'];
    $pathname = ROOT . DS .  'admin/researcher/components/' . $file['name_docu'];

    if ($file != '') {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($pathname));
        readfile($pathname);
    } else {
        header('Location: preview.php?prevTopic=' . $abt_topic_dowload);
        $_SESSION['error_mesg'] .= 'There was file uploaded by this reseacher';
    }
}

if (isset($_GET['loadReportFile'])) {
    $abt_topic_dowload = (int)$_GET['loadReportFile'];
    $resultdownload = $db->query("SELECT * FROM `report_uploads` WHERE `res_topic` = '{$abt_topic_dowload}'");
    $file = mysqli_fetch_assoc($resultdownload);
    $filepath = ROOT . DS . 'admin/researcher/components/' . $file['name_docu'];
    $pathname = ROOT . DS . 'admin/researcher/components/' . $file['name_docu'];

    if ($file != '') {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($pathname));
        readfile($pathname);
    } else {
        header('Location:  preview.php?prevTopic=' . $abt_topic_dowload);
        $_SESSION['error_mesg'] .= 'There was file uploaded by this reseacher';
    }
}
