<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
if (!is_logged_in()) {
    error_redirect('../index.php');
}

include(ROOT . DS . "core" . DS . "head-admin.php");

include(ROOT . DS . "admin" . DS . "reviewers" . DS . "dashboard" . DS . "aside.php");
include(ROOT . DS . "admin" . DS . "reviewers" . DS . "dashboard" . DS . "topnav.php");

include(ROOT . DS . "admin" . DS . "reviewers" . DS . "components" . DS . "footer.php");
