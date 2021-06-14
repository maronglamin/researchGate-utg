<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
if (!is_logged_in()) {
    error_redirect('../index');
}

include(ROOT . DS . "core" . DS . "head-admin.php");
require_once(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "simple-query.php");

include(ROOT . DS . "admin" . DS . "researcher" . DS . "dashboard" . DS . "aside.php");
include(ROOT . DS . "admin" . DS . "researcher" . DS . "dashboard" . DS . "topnav.php");

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Publications</h1>
    <p class="mb-4">You publication History</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Publication List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Topic</th>
                            <th>Date Submitted</th>
                            <th>Field</th>
                            <th>Category</th>
                            <th>Published Date</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Topic</th>
                            <th>Date Topic Submitted</th>
                            <th>Field</th>
                            <th>Category</th>
                            <th>Published Date</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php while ($topic_fields = mysqli_fetch_assoc($results_topic)) :
                            $id_resArea = $topic_fields['res_field'];
                            $field = $db->query("SELECT * FROM res_area WHERE id = '{$id_resArea}'");
                            $fields = mysqli_fetch_assoc($field);
                        ?>

                            <tr>
                                <td><?= $topic_fields['topic']; ?></td>
                                <td><?= month_day_year_formate($topic_fields['submit_topic']); ?></td>
                                <td><?= $fields['category'] ?></td>
                                <td><?= $topic_fields['sub_field']; ?></td>
                                <td>coming soon</td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php include(ROOT . DS . "admin" . DS . "researcher" . DS . "components" . DS . "footer.php"); ?>