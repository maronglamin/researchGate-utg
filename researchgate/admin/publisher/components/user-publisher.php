<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
if (!is_logged_in()) {
    login_error_redirect();
}
include(ROOT . DS . "core" . DS . "head-admin.php");

include(ROOT . DS . "admin" . DS . "publisher" . DS . "dashboard" . DS . "aside.php");
include(ROOT . DS . "admin" . DS . "publisher" . DS . "dashboard" . DS . "top-nav.php");
require_once(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "simple-query.php");
// auto_refresh_page('admin/publisher/components/user-publisher.php');
?>


<div class="container-fluid">
    <div class="row">
        <?php while ($pub_user = mysqli_fetch_assoc($publisher)) : ?>
            <div class="col-lg-6">

                <!-- Dropdown Card Example -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"><?= $pub_user['full_name']; ?><?= ($pub_user['permitted'] == '0') ? ' (Publisher not permitted)' : ''; ?></h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">More Options:</div>
                                <?php if ($pub_user['permitted'] == '0') : ?>
                                    <a class="dropdown-item" href="simple-query.php?permit_publisher=<?= $pub_user['id']; ?>">Pemit</a>
                                <?php endif; ?>
                                <a class="dropdown-item" href="#">Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?= PROOT ?>admin/img/undraw_profile.svg" alt="">
                        </div>
                    </div>
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Published Counts: 23 papers</h6>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>


<?php include(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "footer.php"); ?>