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

if (isset($_GET['resId']) && ($_GET['fieldId'])) {
    $field = $_GET['fieldId'];
    $resId = $_GET['resId'];
    // get all reviewers related to that field of researching 
    $reviewers = $db->query("SELECT
                                    i.full_name AS 'rev_name',
                                    i.id AS 'revId',
                                    i.last_login as loginInfo,
                                    p.category AS 'fields',
                                    p.id AS fId
                                FROM
                                    reviewers i
                                LEFT JOIN res_area p ON
                                    i.rev_field = p.id
                                WHERE
                                    p.id = $field"); ?>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Get reviewers for Your Resesarchers</h1>
            <a href="<?= PROOT ?>admin/publisher/components/assig_rev_topic.php" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-sm text-white-50"></i>Cancel</a>
        </div>
        <div class="col-lg-12">
            <!-- Default Card Example -->
            <div class="card mb-4">
                <div class="card-header">
                    Reviewers in the SELECTIONS
                </div>
                <div class="card-body">
                    <form action="#" method="post">
                        <div class="row">
                            <div>
                                <?php
                                if ($_POST) {
                                    $reviewer = (isset($_POST['revchecked']) ? sanitize($_POST['revchecked']) : '');
                                    $db->query("INSERT INTO `res_rev_process` (`researcher_id`,`rev_id`) VALUES ('{$resId}','{$reviewer}') ");
                                    $_SESSION['success_mesg'] .= 'The researcher and reviewer(s) are now connected';
                                    header('Location: ' . PROOT . 'admin/publisher/components/assig_rev_topic.php');
                                }
                                ?>
                            </div>

                            <label for="catTopic">Select A Reviewer</label>
                            <select class="form-control" id="revchecked" name="revchecked">
                                <option value="" <?= ((isset($_POST['revchecked']) && $_POST['revchecked'] == '') ? ' selected' : ''); ?>></option>
                                <?php while ($data = mysqli_fetch_assoc($reviewers)) : ?>
                                    <option value="<?= $data['revId']; ?>" <?= ((isset($_POST['revchecked']) && $_POST['revchecked'] == $data['revId']) ? ' selected' : ''); ?>><?= $data['rev_name']; ?></option>
                                <?php endwhile; ?>
                            </select>
                            <small>The options shows the reviewers, choose and later add another</small>


                        </div>
                        <br>
                        <div>
                            <input type="submit" value="Add" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } else {
?>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Researcher's informations</h1>
            <a href="#" data-toggle="modal" data-target="#addcat" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-sm text-white-50"></i> Add Research Fields</a>
        </div>
    </div>
    <?php while ($res_field = mysqli_fetch_assoc($res_fields)) :
        $uniqu_id = $res_field['id'];
        $sub_infos = $db->query("SELECT
            i.topic_category AS 'res_type',
            i.submit_topic AS 'date',
            i.sub_field AS 'res_field',
            i.user_ids as researcher,
            i.topic AS res_topic,
            p.category AS 'fields',
            p.id AS fId
        FROM
            propose_topic i
        LEFT JOIN 
            res_area p 
        ON
            i.res_field = p.id
        WHERE
            res_field = '{$uniqu_id}'");
    ?>
        <div class="container-fluid">
            <!-- Collapsable Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample-<?= $res_field['id']; ?>" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $res_field['category']; ?></h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample-<?= $res_field['id']; ?>">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Research Type</th>
                                        <th>Specified field of research</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($sub_info = mysqli_fetch_assoc($sub_infos)) : ?>

                                        <tr>
                                            <td><?= ($sub_info['res_type'] == '1') ? 'Personalized Research Paper' : 'Collaborated Research Paper'; ?></td>
                                            <td><?= ($sub_info['res_topic']); ?></td>
                                            <td><a href="assig_rev_topic.php?resId=<?= $sub_info['researcher']; ?>&fieldId=<?= $sub_info['fId']; ?>" class="btn btn-primary btn-sm btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-info-circle"></i>
                                                    </span>
                                                    <span class="text">Get Reviewer</span>
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
    <?php endwhile; ?>

<?php include(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "footer.php");
    include(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "modal_add_cat.php");
    ob_get_flush();
}
