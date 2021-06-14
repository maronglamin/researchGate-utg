<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
if (!is_logged_in()) {
    error_redirect('../index.php');
}
require_once(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "simple-query.php");
include(ROOT . DS . "core" . DS . "head-admin.php");
include(ROOT . DS . "admin" . DS . "reviewers" . DS . "dashboard" . DS . "aside.php");
include(ROOT . DS . "admin" . DS . "reviewers" . DS . "dashboard" . DS . "topnav.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $res_topic = (int)sanitize($_GET['prevTopic']);
    $sql_res_info = $db->query("SELECT
                                            i.id AS 'res_id',
                                            i.full_name AS res_name,
                                            p.topic_id AS res_topic,
                                            p.topic AS res_topics,
                                            p.submit_topic AS date_submitted,
                                            p.topic_category as cat
                                    FROM
                                            researchers i
                                    LEFT JOIN propose_topic p ON
                                        i.id = p.user_ids
                                    WHERE
                                        topic_id = '{$res_topic}'
        ");
    $research_data = mysqli_fetch_assoc($sql_res_info);
    $data_array = array();
    $data_array[] = $research_data;
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Paper Details </h1>
            <a href="<?= PROOT ?>admin/reviewers/components/res_view.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Go Back To Review List</a>
        </div>
        <div class="contaner">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Basic Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Research Paper</h6>
                        </div>
                        <?php foreach ($data_array as $data) :
                            $col_topic_id = $data['res_topic'];
                            $tid = $db->query("SELECT
                                                        r.res_id AS resId,
                                                        r.main_res AS PI,
                                                        r.res_col_topic_id AS colTopic,
                                                        res.full_name AS res_name,
                                                        res.email as Email
                                                FROM
                                                        `collaboratory_res` r 
                                                LEFT JOIN researchers res 
                                                ON 
                                                        r.res_id = res.id 
                                                WHERE 
                                                    res_col_topic_id = '{$col_topic_id}'");
                        ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="text-center">
                                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?= PROOT ?>admin/img/undraw_profile.svg" alt="">
                                        </div>
                                        <div class="large text-gray-500 text-center">The principal Investigator: <?= $data['res_name']; ?></div>
                                    </div>
                                    <div class="col-lg-8">
                                        <h6 class="m-0 font-weight-bold text-primary">Research Topic Details</h6>
                                        <div class="small text-gray-500">Date of submitting the research topic: <?= month_day_year_formate($data['date_submitted']); ?></div>
                                        <h6 class="m-1 font-weight-bold text-primary">Research Topic</h6>
                                        <div class="large text-gray-500"><?= $data['res_topics']; ?></div>
                                        <h6 class="m-1 font-weight-bold text-primary">Research Type</h6>
                                        <div class="large text-gray-500"><?= (($data['cat'] == '1') ? 'Personalized Researcher Paper' : 'Collaborated Researcher Paper'); ?></div>
                                        <?php
                                        if ($data['cat'] == '2') {
                                            echo '<h6 class="m-1 font-weight-bold text-primary">Researchers in the collaboration</h6>';
                                        ?>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>collaborators</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php while ($tid_val = mysqli_fetch_assoc($tid)) {
                                                        echo '<tr><td><div class="large text-gray-500">' . $tid_val['res_name'] . '</td></div></tr>';
                                                    }
                                                }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                    </div>

                                </div>


                            <?php endforeach; ?>
                            </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $sql = $db->query("SELECT * FROM `rev_comments` WHERE `topic_id` = '{$res_topic}'");
            $empty_check = mysqli_fetch_assoc($sql);
            $sql_count = mysqli_num_rows($sql);
            ?>
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Abstract Document</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <!-- <h1 class="h3 mb-0">Actions</h1> -->
                                <?php if ($sql_count == 0) : ?>
                                    <a href="actionfile.php?acceptAbst=<?= $res_topic ?>" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">Approve Work</a>
                                <?php else : ?>
                                    <a class="btn btn-sm btn-primary shadow-sm" href="#" data-toggle="modal" data-target="#sendMesgModal">Comments</a>
                                    <a href="actionfile.php?rejAbst=<?= $res_topic ?>" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">Reject Work</a>
                                <?php endif; ?>
                            </div>
                            <div class="text-center">
                                <a href="readMethod.php?readFile=<?= $res_topic ?>" target="_blank" rel="noopener noreferrer"><img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?= PROOT ?>assets/img/download.svg" alt=""></a>
                            </div>
                            <!-- <div class="large text-gray-500 text-right"><button class>Download</button></div> -->
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h6 class="text-gray-800">Preview File</h6>
                                <a href="readMethod.php?readFile=<?= $res_topic ?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-eye fa-sm text-white-50"></i> View PDF file</a>
                            </div>

                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h6 class="text-gray-800">Download File</h6>
                                <a href="download.php?loadFile=<?= $res_topic ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Download</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $sql = $db->query("SELECT * FROM `draft_rev_comment` WHERE `topic_id` = '{$res_topic}'");
            $empty_check = mysqli_fetch_assoc($sql);
            $sql_count = mysqli_num_rows($sql);
            ?>

            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Draft File</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <!-- <h1 class="h3 mb-0">Actions</h1> -->
                                <?php if ($sql_count == 0) : ?>
                                    <a href="actionfile.php?acceptDraft=<?= $res_topic ?>" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">Approve Work</a>
                                <?php else : ?>
                                    <a class="btn btn-sm btn-primary shadow-sm" href="#" data-toggle="modal" data-target="#sendDraftModal">Comments</a>
                                    <a href="actionfile.php?rejDraft=<?= $res_topic ?>" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">Reject Work</a>
                                <?php endif; ?>
                            </div>
                            <div class="text-center">
                                <a href="readMethod.php?readDraft=<?= $res_topic ?>" target="_blank" rel="noopener noreferrer"><img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?= PROOT ?>assets/img/download.svg" alt=""></a>
                            </div>
                            <!-- <div class="large text-gray-500 text-right"><button class>Download</button></div> -->
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h6 class="text-gray-800">Preview File</h6>
                                <a href="readMethod.php?readDraft=<?= $res_topic ?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-eye fa-sm text-white-50"></i> View PDF file</a>
                            </div>

                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h6 class="text-gray-800">Download File</h6>
                                <a href="download.php?loadDraft=<?= $res_topic ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Download</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $sql = $db->query("SELECT * FROM `report_uploads` WHERE `res_topic` = '{$res_topic}'");
            $empty_check_2 = mysqli_fetch_assoc($sql);
            // $sql_count = mysqli_num_rows($sql);   
            ?>
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Research Report Documents</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <!-- <h1 class="h3 mb-0 text-gray-800">Review Actions</h1> -->
                                <?php if ($empty_check_2['report_accept'] != 1) : ?>
                                    <a class="btn btn-sm btn-warning" href="actionfile.php?acceptReport=<?= $res_topic ?>">Accept report</a>
                                <?php else : ?>
                                    <a href="actionfile.php?rejReport=<?= $res_topic ?>" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">Reject Work</a>
                                <?php endif; ?>
                                <?php if ($empty_check_2['report_rev_comment'] == null) : ?>
                                    <a class="btn btn-sm btn-primary shadow-sm" href="#" data-toggle="modal" data-target="#sendReoprtMesgModal">Comments</a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="readMethod.php?readReportFile=<?= $res_topic ?>" target="_blank" rel="noopener noreferrer"><img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?= PROOT ?>assets/img/download.svg" alt=""></a>
                        </div>
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h6 class="text-gray-800">Preview File</h6>
                            <a href="readMethod.php?readReportFile=<?= $res_topic ?>" target="_blank" rel="noopener noreferrer" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-eye fa-sm text-white-50"></i> View PDF file</a>
                        </div>

                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h6 class="text-gray-800">Download File</h6>
                            <a href="download.php?loadReportFile=<?= $res_topic ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Download</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">

            <?php
            $abst_mesg_sql = $db->query("SELECT * FROM `rev_comments` WHERE topic_id = '{$res_topic}'");
            $result = mysqli_fetch_assoc($abst_mesg_sql);

            $abst_mesg_sqls = $db->query("SELECT * FROM `report_uploads` WHERE res_topic = '{$res_topic}'");
            $results = mysqli_fetch_assoc($abst_mesg_sqls);

            $draft_mesg_sqls = $db->query("SELECT * FROM `draft_rev_comment` WHERE topic_id = '{$res_topic}'");
            $resultsDraft = mysqli_fetch_assoc($draft_mesg_sqls);
            ?>
            <?php if ($result['recommend_mesg'] != '') : ?>
                <div class="col-lg-4">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Abstract Meesage sent</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="col-lg-12">
                                <p><?= $result['recommend_mesg']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($resultsDraft['recomment_mesg'] != '') : ?>
                <div class="col-lg-4">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Draft Meesage sent</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="col-lg-12">
                                <p><?= $resultsDraft['recomment_mesg']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($results['report_rev_comment'] != '') : ?>
                <div class="col-lg-4">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Final Report Meesage sent</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="col-lg-12">
                                <p><?= $results['report_rev_comment']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    </div>
    <div class="modal fade" id="sendMesgModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Direct messages to your Researcher</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="actionfile.php" method="post">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label for="mesg">Message</label>
                                    <textarea name="mesg" id="mesg" class="form-control" rows="5"></textarea>
                                </div>
                                <input type="submit" name="res_mesg" value="send" class="btn btn-sm btn-primary">
                                <input type="hidden" name="res_topic" value="<?= $res_topic ?>">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal draft  -->
    <div class="modal fade" id="sendDraftModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Direct messages to your Researcher</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="actionfile.php" method="post">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label for="mesg">Message</label>
                                    <textarea name="mesg" id="mesg" class="form-control" rows="5"></textarea>
                                </div>
                                <input type="submit" name="res_draft_mesg" value="send" class="btn btn-sm btn-primary">
                                <input type="hidden" name="res_topic" value="<?= $res_topic ?>">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal for the report file  -->
    <div class="modal fade" id="sendReoprtMesgModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Report notication to your Researcher</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="actionfile.php" method="post">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label for="mesg">Message</label>
                                    <textarea name="mesg" id="mesg" class="form-control" rows="5"></textarea>
                                </div>
                                <input type="submit" name="report_mesg" value="send" class="btn btn-sm btn-primary">
                                <input type="hidden" name="res_topic" value="<?= $res_topic ?>">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php }
include(ROOT . DS . "admin" . DS . "reviewers" . DS . "components" . DS . "footer.php"); ?>