<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
include(ROOT . DS . "core" . DS . "head.php");
include(ROOT . DS . "views" . DS . "top-nav" . DS . "slide-nav.php");
include(ROOT . DS . "views" . DS . "top-nav" . DS . "nav-list.php");
include(ROOT . DS . "views" . DS . "top-nav" . DS . "header-nav.php");

include(ROOT . DS . "views" . DS . "details" . DS . "main-work.php");
include(ROOT . DS . "views" . DS . "details" . DS . "about-res.php");
include(ROOT . DS . "views" . DS . "details" . DS . "popular-res.php");
include(ROOT . DS . "views" . DS . "details" . DS . "reviewers.php");
include(ROOT . DS . "views" . DS . "details" . DS . "res-step-format.php");
// include(ROOT . DS . "views" . DS . "details" . DS . "new-update.php");

include(ROOT . DS . "views" . DS . "subscribe" . DS . "form.php");

include(ROOT . DS . "views" . DS . "details" . DS . "footer.php");



include(ROOT . DS . "core" . DS . "script.php");
