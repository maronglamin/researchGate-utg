<?php
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
// require_once(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "simple-query.php");
include(ROOT . DS . "core" . DS . "head-admin.php");
include(ROOT . DS . "views" . DS . "top-nav" . DS . "nav.php");

$pub = $db->query("SELECT
                        i.full_name AS 'res_name',
                        p.sub_field AS specific_field,
                        p.user_ids AS researcher,
                        p.submit_topic AS date_submitted,
                        p.topic_category AS res_type,
                        p.topic AS resTopic,
                        p.topic_id as tid
                    FROM
                        researchers i
                    LEFT JOIN propose_topic p ON
                        i.id = p.user_ids
                    WHERE
                        p.published = 1
");

if (isset($_GET['readInfo'])) {

    $res_topic = (int)$_GET['readInfo'];
    $result = $db->query("SELECT * FROM `report_uploads` WHERE `res_topic` = '{$res_topic}'");
    $file = mysqli_fetch_assoc($result);
    $filepath = ROOT . DS . "admin" . DS . "researcher" . DS . "components" . DS .  $file['name_docu'];
    $pathname = ROOT . DS . "admin" . DS . "researcher" . DS . "components" . DS .  $file['name_docu'];
    // // dnd($filepath);

    header("Content-type: application/pdf");
    header('Content-Disposition: inline; filename="' . $filepath . '"');
    header('Content-Transfer-Encodeing: binary');
    header('Accept-Ranges: bytes');
    @readfile($pathname);
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Publications</h1>
    <p class="mb-4">List of all published research documents</p>

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
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Topic</th>
                            <th>Date Topic Submitted</th>
                            <th>Field</th>
                            <th>Details</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php while ($topic_fields = mysqli_fetch_assoc($pub)) : ?>

                            <tr>
                                <td><?= $topic_fields['resTopic']; ?></td>
                                <td><?= month_day_year_formate($topic_fields['date_submitted']); ?></td>
                                <td><?= $topic_fields['specific_field']; ?></td>
                                <td>
                                    <a href="publications.php?readInfo=<?= $topic_fields['tid']; ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-info btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-flag"></i>
                                        </span>
                                        <span class="text">Read Material</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
    include(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "footer.php");
    ob_get_flush();
