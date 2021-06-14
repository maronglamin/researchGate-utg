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
        header('Location: ' . PROOT . 'admin/researcher/components/res-desc.php');
        $_SESSION['error_mesg'] .= 'There was file uploaded by this reseacher';
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
        header('Location: ' . PROOT . 'admin/researcher/components/res-desc.php');
        $_SESSION['error_mesg'] .= 'There was file uploaded by this reseacher';
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
        header('Location: ' . PROOT . 'admin/researcher/components/res-desc.php');
        $_SESSION['error_mesg'] .= 'There was file uploaded by this reseacher';
    } else {
        header("Content-type: application/pdf");
        header('Content-Disposition: inline; filename="' . $filepath . '"');
        header('Content-Transfer-Encodeing: binary');
        header('Accept-Ranges: bytes');
        @readfile($pathname);
    }
}

if (isset($_GET['deleteAbst'])) {
    $file_id = (int)$_GET['deleteAbst'];
    $result = $db->query("SELECT * FROM `res_uploads` WHERE `res_topic` = '{$file_id}'");
    $file = mysqli_fetch_assoc($result);
    $filepath =  ROOT . DS . 'admin/researcher/components/' . $file['name_docu'];

    if ($file == '') {
        header('Location: ' . PROOT . 'admin/researcher/components/res-desc.php');
        $_SESSION['error_mesg'] .= 'You did not upload a file.';
    } else {
        unlink($filepath);
        $db->query("DELETE FROM `res_uploads` WHERE res_topic = '{$file_id}'");
        header('Location: edit.php?edit=' . $file_id);
        $_SESSION['success_mesg'] = 'Deletion successful.';
    }
}

if (isset($_GET['deleteDraft'])) {
    $draft_id = (int)$_GET['deleteDraft'];
    $result = $db->query("SELECT * FROM `draft_uploads` WHERE `res_topic` = '{$draft_id}'");
    $file = mysqli_fetch_assoc($result);
    $filepath =  ROOT . DS . 'admin/researcher/components/' . $file['name_docu'];

    if ($file == '') {
        header('Location: ' . PROOT . 'admin/researcher/components/res-desc.php');
        $_SESSION['error_mesg'] .= 'You did not upload a file.';
    } else {
        unlink($filepath);
        $db->query("DELETE FROM `draft_uploads` WHERE res_topic = '{$draft_id}'");
        header('Location: view-details.php');
        $_SESSION['success_mesg'] = 'Deletion successful.';
    }
}
if (isset($_GET['deleteReport'])) {
    $report_id = (int)$_GET['deleteReport'];
    $result = $db->query("SELECT * FROM `report_uploads` WHERE `res_topic` = '{$report_id}'");
    $file = mysqli_fetch_assoc($result);
    $filepath =  ROOT . DS . 'admin/researcher/components/' . $file['name_docu'];

    if ($file == '') {
        header('Location: ' . PROOT . 'admin/researcher/components/res-desc.php');
        $_SESSION['error_mesg'] .= 'You did not upload a file.';
    } else {
        unlink($filepath);
        $db->query("DELETE FROM `report_uploads` WHERE `res_topic` = '{$report_id}'");
        header('Location: view-details.php');
        $_SESSION['success_mesg'] = 'Deletion successful.';
    }
}
