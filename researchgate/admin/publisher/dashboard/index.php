<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
require_once(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "simple-query.php");

if (!is_logged_in()) {
    login_error_redirect();
}
include(ROOT . DS . "core" . DS . "head-admin.php");

include(ROOT . DS . "admin" . DS . "publisher" . DS . "dashboard" . DS . "aside.php");
include(ROOT . DS . "admin" . DS . "publisher" . DS . "dashboard" . DS . "top-nav.php");
include(ROOT . DS . "admin" . DS . "publisher" . DS . "dashboard" . DS . "notice.php");
// include(ROOT . DS . "admin" . DS . "publisher" . DS . "dashboard" . DS . "running-project.php");
// include(ROOT . DS . "admin" . DS . "publisher" . DS . "dashboard" . DS . "featured-mesg.php");


include(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "footer.php");
