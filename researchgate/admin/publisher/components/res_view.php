<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
require_once(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "simple-query.php");

if (!is_logged_in()) {
    login_error_redirect();
}
include(ROOT . DS . "core" . DS . "head-admin.php");

include(ROOT . DS . "admin" . DS . "publisher" . DS . "dashboard" . DS . "aside.php");
include(ROOT . DS . "admin" . DS . "publisher" . DS . "dashboard" . DS . "top-nav.php");
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Researcher's informations</h1>
        <a href="<?= PROOT ?>admin/publisher/dashboard/index.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-sm text-white-50"></i> exit</a>
    </div>
    <!-- Content Row -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Permitted Researchers</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Reviewer's Full Name</th>
                            <th>Last Login</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($res_data = mysqli_fetch_assoc($res_tab)) : ?>

                            <tr>
                                <td><?= $res_data['full_name']; ?></td>
                                <td><?= ($res_data['last_login'] == '0000-00-00 00:00:00') ? 'Never Logged In' : month_day_year_formate($res_data['last_login']); ?></td>
                                <td><a href="res_info.php?resId=<?= $res_data['id']; ?>" class="btn btn-primary btn-sm btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-info-circle"></i>
                                        </span>
                                        <span class="text">More Info</span>
                                    </a></td>
                                </a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "footer.php");
