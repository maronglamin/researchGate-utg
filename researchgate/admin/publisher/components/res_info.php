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

if (isset($_GET['add'])) {
    $add = (int)sanitize($_GET['add']);
    $db->query("UPDATE `researchers` SET `status` = '1' WHERE `id` = '{$add}'");
    header('Location: res_info.php?resId=' . $add);
}

if (isset($_GET['remove'])) {
    $add = (int)sanitize($_GET['remove']);
    $db->query("UPDATE `researchers` SET `status` = '0' WHERE `id` = '{$add}'");
    header('Location: res_info.php?resId=' . $add);
}

if (isset($_GET['resId'])) {
    $resId = (int)sanitize($_GET['resId']);
    $researcherId = (int)sanitize($_GET['resId']);
    $rId = (int)sanitize($_GET['resId']);


    $res_info = $db->query("SELECT
                    i.topic_category AS 'res_type',
                    i.submit_topic AS 'date',
                    i.sub_field AS 'res_field',
                    i.user_ids AS researcher,
                    i.topic AS res_topic,
                    i.topic_id AS tId,
                    i.res_field AS division,
                    i.topic_category AS res_type,
                    i.short_note AS note,
                    r.full_name AS res_name,
                    r.last_login AS lasted_seen
            FROM
                    propose_topic i
            LEFT JOIN researchers r ON
                    i.user_ids = r.id
            WHERE
                    r.id = '{$resId}' ORDER BY r.id DESC");
    $result = mysqli_fetch_assoc($res_info);
    $result_count = mysqli_num_rows($res_info);

    $count_reviewed = $db->query("SELECT * FROM `report_uploads` WHERE res_id = '{$researcherId}' AND `report_accept` = '1'");
    $count_result = mysqli_num_rows($count_reviewed);

    $setVisible = $db->query("SELECT * FROM `researchers` WHERE id = $rId");
    $resultVisible = mysqli_fetch_assoc($setVisible);


?>
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Researcher's Records</h1>
                <?php if ($resultVisible['status'] == 0) : ?>
                    <a href="res_info.php?add=<?= $rId; ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="text-white-50"></i> Set Visible</a>
                <?php else : ?>
                    <a href="res_info.php?remove=<?= $rId; ?>" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="text-white-50"></i> Set Hidden</a>
                <?php endif; ?>
            </div>
            <!-- Default Card Example -->
            <div class="card mb-4">
                <div class="card-header text-uppercase">
                    Final Upload
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="col-lg-12">
                                        <div class="text-center">
                                            <a href="readMethod.php?readFile=<?= $res_topic ?>"><img class="img-fluid px-3 px-sm-4 mt-3 mb-4 rounded-circle" style="width: 25rem;" src="<?= PROOT ?>admin/img/undraw_profile.svg" alt=""></a>
                                            <div class="font-weight-bold text-info"><?= $result['res_name']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">First Uploaded Docs</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h6 class="text-primary">Abstract</h6>
                                            <div class="text-center">
                                                <a href="readMethod.php?readFile=<?= $result['tId']; ?> target=" _blank"><img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?= PROOT ?>assets/img/download.svg" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <h6 class="text-primary">Report</h6>
                                            <div class="text-center">
                                                <a href="readMethod.php?readReportFile=<?= $result['tId']; ?>" target="_blank"><img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?= PROOT ?>assets/img/download.svg" alt=""></a>
                                            </div>
                                        </div>
                                        <small><strong>First Research Topic:</strong><br> <?= $result['res_topic']; ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Full information of the researcher</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="col-lg-12">
                                        <div class="row">

                                            <!-- Earnings (Monthly) Card Example -->
                                            <div class="col-xl-6 col-md-6 mb-4">
                                                <div class="card border-left-primary shadow h-100 py-2">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                                    Sent Topics by <?= $result['res_name']; ?></div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $result_count ?> Papers</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Earnings (Monthly) Card Example -->
                                            <div class="col-xl-6 col-md-6 mb-4">
                                                <div class="card border-left-success shadow h-100 py-2">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                                    Reviewed Papers</div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_result ?> research</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <h1 class="h3 mb-0 text-gray-800">Paper Details </h1>
                                        <div class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Lasted Seen <?= ($result['lasted_seen'] == '0000-00-00 00:00:00') ? 'Never Logged In' : month_time($result['lasted_seen']); ?></div>
                                    </div>
                                    <!-- full information of the researcher  -->
                                    <?php while ($results = mysqli_fetch_assoc($res_info)) : ?>
                                        <p><strong class="text-uppercase">research topic</strong><br> <?= $results['res_topic']; ?></p>
                                    <?php endwhile; ?>

                                    <h1 class="h3 mb-0 text-gray-800">Description given upon submitting research topic.</h1><br>
                                    <p><?= (($result['note'] == '') ? 'No description from the researcher' : $result['note']); ?></p>
                                </div>

                            </div>
                        </div>
                    </div>

                <?php } ?>


                <?php include(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "footer.php");
