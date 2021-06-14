<?php
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
if (!is_logged_in()) {
    error_redirect('../index');
}

include(ROOT . DS . "core" . DS . "head-admin.php");
require_once(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "simple-query.php");

include(ROOT . DS . "admin" . DS . "researcher" . DS . "dashboard" . DS . "aside.php");
include(ROOT . DS . "admin" . DS . "researcher" . DS . "dashboard" . DS . "topnav.php");

if (isset($_GET['paperInfo'])) {
    $tId = (int)$_GET['paperInfo'];
?>
    <div class="col-lg-12">
        <h1 class="h3 mb-1 font-weight-bold text-primary text-uppercase">writing a research paper</h1>
        <div class="card mb-4">
            <div class="card-header font-weight-bold text-uppercase">documentations</div>
            <div class="card-body">
                <form class="form" action="abst_views.php?paper=1" method="post">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="description">Write in full text as it will show exactly on preview</label>
                            <textarea id="description" name="description" class="form-control" rows="20"></textarea>
                            <small>please leave a space between your paragraphs by using the ENTER KEY on your keyboard</small>
                        </div>
                    </div>
                    <input type="hidden" name="user_id" id="user_id" value="<?= $user_data['id']; ?>">
                    <input type="hidden" name="t_id" id="t_id" value="<?= $tId ?>">
                    <input type="submit" class="btn btn-success btn-lg">
                </form>
            </div>
        </div>
    </div>
    </div>

<?php } else { ?>
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Abstract Views on upload</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All abstract uploads</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Topic</th>
                                <th>Date Submitted</th>
                                <th>Abstract</th>
                                <th>Draft</th>
                                <th>Research</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($topic_fields = mysqli_fetch_assoc($abt_topic)) : ?>
                                <tr>
                                    <td><?= $topic_fields['topic']; ?></td>
                                    <td><?= month_day_year_formate($topic_fields['submit_topic']); ?></td>
                                    <td><a href="abt_desc_view.php?abtInfo=<?= $topic_fields['topic_id']; ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-info btn-icon-split">
                                            <span class="icon text-white-50"><i class="fas fa-eye"></i></span>
                                            <span class="text">Abstract</span>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="abt_desc_view.php?draftInfo=<?= $topic_fields['topic_id']; ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-secondary btn-icon-split">
                                            <span class="icon text-white-50"><i class="fas fa-eye"></i></span>
                                            <span class="text">Draft</span>
                                        </a>
                                    </td>
                                    <td><a href="abt_desc_view.php?paperInfo=<?= $topic_fields['topic_id']; ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-warning btn-icon-split">
                                            <span class="icon text-white-50"><i class="fas fa-eye"></i></span>
                                            <span class="text">Report</span>
                                        </a></td>
                                    <td><a href="edit.php?edit=<?= $topic_fields['topic_id']; ?>" class="btn btn-sm btn-primary btn-icon-split">
                                            <span class="icon text-white-50"><i class="fas fa-edit"></i> </span>
                                            <span class="text">Edit</span>
                                        </a></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php }
include(ROOT . DS . "admin" . DS . "researcher" . DS . "components" . DS . "footer.php");
ob_get_flush(); ?>