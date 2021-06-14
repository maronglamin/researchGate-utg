<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
if (!is_logged_in()) {
    error_redirect('../index.php');
}
require_once(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "simple-query.php");

include(ROOT . DS . "core" . DS . "head-admin.php");
include(ROOT . DS . "admin" . DS . "reviewers" . DS . "dashboard" . DS . "aside.php");
include(ROOT . DS . "admin" . DS . "reviewers" . DS . "dashboard" . DS . "topnav.php");
?>
<!-- page content  -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Researcher papers </h1>
        <!-- <a href="<?= PROOT ?>admin/reviewers/components/interest_papers.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"></a> -->
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Researchers Assign to you</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>The Research Topics</th>
                            <th>Date Assigned</th>
                            <th>Research Type</th>
                            <th>Related field of Research</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($topic_fields = mysqli_fetch_assoc($assign)) :
                            $id_resArea = $topic_fields['researcher_id'];
                            $field = $db->query("SELECT * FROM `propose_topic` WHERE user_ids = '{$id_resArea}'");
                            $fields = mysqli_fetch_assoc($field);
                        ?>

                            <tr>
                                <td><?= $fields['topic']; ?></td>
                                <td><?= month_day_year_formate($topic_fields['date_assig']); ?></td>
                                <td><?= ($fields['topic_category'] == '1') ? 'Personalized Paper' : 'Collaborated Paper' ?></td>
                                <td><?= $fields['sub_field']; ?></td>
                                <td><a href="preview.php?prevTopic=<?= $fields['topic_id']; ?>" class="btn btn-primary btn-sm btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-flag"></i>
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

<?php include(ROOT . DS . "admin" . DS . "reviewers" . DS . "components" . DS . "footer.php");
