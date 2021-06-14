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
                            <?php while ($rev_user = mysqli_fetch_assoc($results_res_permit)) : ?>
                                <tr>
                                    <td><?= $rev_user['full_name']; ?></td>
                                    <td><?= $rev_user['email']; ?></td>
                                    <td><?= $rev_user['join_data']; ?></td>
                                    <td><?= $rev_user['role']; ?></td>
                                    <td><?= ($rev_user['status'] == '1') ? 'Active' : ''; ?></td>
                                    <td><a href="get_res_detail.php?details=<?= $rev_user['id']; ?>" class="btn btn-info btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-info-circle"></i>
                                            </span>
                                            <span class="text">Details</span>
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

<?php include(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "footer.php"); ?>