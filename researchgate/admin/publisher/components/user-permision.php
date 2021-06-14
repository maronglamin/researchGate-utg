<?php
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
if (!is_logged_in()) {
    login_error_redirect();
}
include(ROOT . DS . "core" . DS . "head-admin.php");

include(ROOT . DS . "admin" . DS . "publisher" . DS . "dashboard" . DS . "aside.php");
include(ROOT . DS . "admin" . DS . "publisher" . DS . "dashboard" . DS . "top-nav.php");
require_once(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "simple-query.php");

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User Access Analysis</h1>
    </div>

    <div class="row">

        <!-- permmited reviewers card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Permitted Reviewers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $p_reviewers ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- pending reviewer -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pending Reviewers
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pen_reviewers ?></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!--permitted researchers -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                permitted researchers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $p_res ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Pending researcher  -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Researchers </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pen_res ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">REVIEWERS ACCESS ACTION</h1>
            <p class="mb-4">For security reasons, users on all level must wait for permission to start using the system. Only users on pending will be displayed here and permit or be leave like that </p>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Permit Reviewers Upon Registering</h6>
                </a>
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date joined</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date joined</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php while ($rev_user = mysqli_fetch_assoc($results_rev)) : ?>
                                        <td><?= $rev_user['full_name']; ?></td>
                                        <td><?= $rev_user['email']; ?></td>
                                        <td><?= $rev_user['join_data']; ?></td>
                                        <td><?= $rev_user['role']; ?></td>
                                        <td><?= ($rev_user['status'] == '0') ? 'pending' : ''; ?></td>
                                        <td><a href="simple-query.php?pending=<?= $rev_user['id']; ?>" class="btn btn-primary btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-flag"></i>
                                                </span>
                                                <span class="text">Permit</span>
                                            </a></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->


        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">RESEARCHER ACCESS ACTION</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardRes" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardRes">
                    <h6 class="m-0 font-weight-bold text-primary">Permit RESEARCHER upon registering</h6>
                </a>
                <div class="collapse show" id="collapseCardRes">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date joined</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date joined</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php while ($res_user = mysqli_fetch_assoc($results_res)) : ?>
                                        <tr>
                                            <td><?= $res_user['full_name']; ?></td>
                                            <td><?= $res_user['email']; ?></td>
                                            <td><?= $res_user['join_data']; ?></td>
                                            <td><?= $res_user['role']; ?></td>
                                            <td><?= ($res_user['status'] == '0') ? 'pending' : ''; ?></td>
                                            <td><a href="simple-query.php?pend=<?= $res_user['id']; ?>" class="btn btn-primary btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-flag"></i>
                                                    </span>
                                                    <span class="text">Permit</span>
                                                </a></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->



    </div>
</div>

<?php include(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "footer.php");
ob_get_flush();
?>