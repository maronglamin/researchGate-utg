<?php
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
require_once(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "simple-query.php");

if (!is_logged_in()) {
    login_error_redirect();
}
include(ROOT . DS . "core" . DS . "head-admin.php");

include(ROOT . DS . "admin" . DS . "publisher" . DS . "dashboard" . DS . "aside.php");
include(ROOT . DS . "admin" . DS . "publisher" . DS . "dashboard" . DS . "top-nav.php");
$sql = $db->query("SELECT
                        i.res_topic topic_id,
                        i.res_id AS res_name,
                        p.topic AS res_topics,
                        p.submit_topic AS date_submitted,
                        p.topic_category AS cat,
                        p.topic_id topic_ids,
                        p.published AS pub,
                        p.submit_topic AS date_upload
                    FROM
                        report_uploads i
                    LEFT JOIN propose_topic p ON
                        i.res_topic = p.topic_id 
                    WHERE i.report_accept = 1");
$tcount = mysqli_num_rows($sql);

?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-uppercase">ongoing research topics</h1>
        <div class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Topics count: <?= $tcount ?></div>
    </div>
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">All Reviewed Research Papers</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Investigator</th>
                            <th>Research Topic</th>
                            <th>Research Type</th>
                            <th>Date submitted</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($sub_info = mysqli_fetch_assoc($sql)) :
                            $res = $sub_info['res_name'];
                            $resID = $sub_info['res_name'];
                            $result = $db->query("SELECT * FROM `researchers` WHERE id = '{$res}'");
                            $res_info = mysqli_fetch_assoc($result);
                            $db->query("SELECT `published` FROM `propose_topic` WHERE `user_ids` = '{$resID}'");
                        ?>

                            <tr>
                                <td><?= $res_info['full_name']; ?></td>
                                <td><?= ($sub_info['res_topics']); ?></td>
                                <td><?= ($sub_info['cat'] == '1') ? 'Personalized Paper' : 'Collaborated Paper'; ?></td>
                                <td><?= month_day_year_formate($sub_info['date_upload']); ?></td>
                                <?php if ($sub_info['pub'] == '0') : ?>
                                    <td><a href="action.php?pub=<?= $sub_info['topic_ids']; ?>" class="btn btn-primary btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-info"></i>
                                            </span>
                                            <span class="text">Publish</span>
                                        </a></td>
                                <?php else : ?>
                                    <td>
                                        <div>
                                            <span class="text">Published</span>
                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "footer.php");
ob_get_flush();
