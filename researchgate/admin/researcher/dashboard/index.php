<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
if (!is_logged_in()) {
    error_redirect('../index');
}
require_once(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "simple-query.php");
include(ROOT . DS . "core" . DS . "head-admin.php");

include(ROOT . DS . "admin" . DS . "researcher" . DS . "dashboard" . DS . "aside.php");
include(ROOT . DS . "admin" . DS . "researcher" . DS . "dashboard" . DS . "topnav.php");
include(ROOT . DS . "admin" . DS . "researcher" . DS . "dashboard" . DS . "dashboard.php");

include(ROOT . DS . "admin" . DS . "researcher" . DS . "components" . DS . "footer.php");
