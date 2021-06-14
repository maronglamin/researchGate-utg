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

if (isset($_GET['sent'])) {
    $sent_id = (isset($_POST['sent_id']) ? sanitize($_POST['sent_id']) : '');
    $mesg = (isset($_POST['message']) ? sanitize($_POST['message']) : '');
    $id = $user_data['id'];

    if ($_POST) {
        $db->query("INSERT INTO `notify_mesg` (`receiver_id`, `mesg`, `sender_id`) VALUES ('$sent_id', '$mesg', '$id')");
        header('Location: choose.php');
    }
}
if (isset($_GET['mesg'])) {
    $received_id = $_GET['mesg'];
?>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Let's constantly send messages to collaborators</h1>
            <a href="<?= PROOT ?>admin/researcher/components/choose.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">Cancel messaging</a>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h6 class="m-0 font-weight-bold text-primary">Instant message to your collaborator</h6>
                    </div>
                    <form action="choose.php?sent=1" method="post">
                        <div class="col-lg-12 form-group">
                            <input type="hidden" name="sent_id" value="<?= $received_id ?>">
                            <label for="message">Compose a message to your partner in research</label>
                            <textarea id="message" name="message" rows="6" class="form-control"></textarea>
                        </div>
                        <div class="col-lg-12 form-group">
                            <input type="submit" value="Send" class="btn btn-success">
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
            <h1 class="h3 mb-0 text-gray-800">Collaboratory Research Work.</h1>
            <a href="<?= PROOT ?>admin/researcher/components/add_col_res.php?addres=<?= $id; ?>" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="text-white-50"></i> Add Researchers</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Collective research papers (you are the main researcher)</h6>
            </div>
            <div class="card-body">
                <h1 class="h3 mb-0 text-gray-800 text-primary">Your partners in a research.</h1>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Partner Names</th>
                                <th>Email</th>
                                <th>Topic Collaborated</th>
                                <th>Notifications</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($patner_data = mysqli_fetch_assoc($res_patner)) :
                                // researcher info query 
                                $patner_id = $patner_data['res_id'];
                                $field = $db->query("SELECT * FROM researchers WHERE id = '{$patner_id}'");
                                $patner = mysqli_fetch_assoc($field);

                                // research topic query  
                                $patner_id = $patner_data['res_col_topic_id'];
                                $col_topic_field = $db->query("SELECT * FROM propose_topic WHERE topic_id = '{$patner_id}'");
                                $topic_patner = mysqli_fetch_assoc($col_topic_field);
                            ?>

                                <tr>
                                    <td><?= $patner['full_name']; ?></td>
                                    <td><?= $patner['email']; ?></td>
                                    <td><?= $topic_patner['topic'] ?></td>
                                    <td><a href="choose.php?mesg=<?= $patner['id']; ?>" class="btn btn-info btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-info-circle"></i>
                                            </span>
                                            <span class="text">Notify</span>
                                        </a></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">You are involved in this paper(s)</h6>
            </div>
            <div class="card-body">
                <h1 class="h3 mb-0 text-gray-800 text-primary">Your Associated researcher.</h1>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Main Resesarcher</th>
                                <th>Email</th>
                                <th>Topic Collaborated</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($sub_patner_data = mysqli_fetch_assoc($res_sub_patner)) :
                                // researcher info query 
                                $patner_ids = $sub_patner_data['main_res'];
                                $field = $db->query("SELECT * FROM researchers WHERE id = '{$patner_ids}'");
                                $patners = mysqli_fetch_assoc($field);

                                // research topic query  
                                $patner_ids = $sub_patner_data['res_col_topic_id'];
                                $collabo_topic_field = $db->query("SELECT * FROM propose_topic WHERE topic_id = '{$patner_ids}'");
                                $topic_patners = mysqli_fetch_assoc($collabo_topic_field);
                            ?>
                                <tr>
                                    <td><?= $patners['full_name']; ?></td>
                                    <td><?= $patners['email']; ?></td>
                                    <td><?= $topic_patners['topic']; ?></td>
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