<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
include(ROOT . DS . "core" . DS . "head.php");
include(ROOT . DS . "views" . DS . "top-nav" . DS . "slide-nav.php");
include(ROOT . DS . "views" . DS . "top-nav" . DS . "nav-list.php");
?>

<br><br>
<div class="site-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-center">LOGIN TO THE SYSTEM AS </h6>
                    </div>
                    <div class="card-body">
                        <div class="feature-1-content">
                            <h2>RESEARCHERS</h2>
                            <p>Login as a resarcher and start writing research papers in manner that best suit your field of studies.</p>
                            <p><a href="<?= PROOT ?>admin/researcher/index.php" class="btn btn-primary px-4 rounded-0">Access Now</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>