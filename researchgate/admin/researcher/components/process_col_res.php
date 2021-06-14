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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_GET['register_col'])) {
        $main_res_id = (int)$user_data['id'];
        $collaborator_id = (int)sanitize($_POST['res_email']);
        $receiver_id = (int)sanitize($_POST['res_email']);
        $topic_id = (int)sanitize($_POST['topic_id']);
        $notify = sanitize(($_POST['description']));

        if ($_POST) {
            $db->query("INSERT INTO collaboratory_res(`res_id`,`main_res`,`res_col_topic_id`) VALUES('{$collaborator_id}','{$main_res_id}','{$topic_id}' )");
            $db->query("INSERT INTO notify_mesg (`receiver_id`,`mesg`) VALUES('{$receiver_id}', '{$notify}')");
            header('Location: choose.php');
            exit();
        }
    }

    $researcher = (isset($_POST['searchEmail']) ? sanitize($_POST['searchEmail']) : '');
    $sql = "SELECT * FROM researchers";
    if ($researcher == '') {
        $sql .= " WHERE email = ''";
    } else {
        $sql .= " WHERE email = '{$researcher}'";
    }

    $searchQuery = $db->query($sql);
    $searchEmpty = $db->query($sql);
    $search = $db->query($sql);


    $main_res_topic_id = $user_data['id'];
    $topic_choose = $db->query("SELECT * FROM propose_topic WHERE user_ids = '{$main_res_topic_id}'");

    ob_get_flush();
?>
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data from the search</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_fetch_assoc($searchEmpty) == '') : ?>
                                <tr>
                                    <td>Name not Available from the search</td>
                                    <td>No email match this search</td>
                                </tr>
                            <?php endif; ?>
                            <?php while ($res_details = mysqli_fetch_assoc($searchQuery)) : ?>
                                <tr>
                                    <td><?= $res_details['full_name']; ?></td>
                                    <td><?= $res_details['email']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <form action="process_col_res.php?register_col=1" method="post">
                    <?php while ($id = mysqli_fetch_assoc($search)) : ?>
                        <div class="form-group col-12">
                            <label for="res_email">Comfirm Name:</label>
                            <select class="form-control" id="res_email" name="res_email">
                                <option value="<?= $id['id']; ?>" <?= ((isset($_POST['res_email']) && $_POST['res_email'] == $id['id']) ? ' selected' : ''); ?>><?= $id['full_name']; ?></option>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label for="notification">Notify Your Collaborator</label>
                            <textarea id="description" name="description" class="form-control"></textarea>
                            <small><strong>message</strong> your collaborators that you added them to your paper</small>
                        </div>
                    <?php endwhile; ?>

                    <div class="form-group col-12">
                        <label for="res_email">Select Your collaboration topic:</label>
                        <select class="form-control" id="topic_id" name="topic_id">
                            <option value="" <?= ((isset($_POST['topic_id']) && $_POST['topic_id'] == '') ? ' selected' : ''); ?>></option>
                            <?php while ($id = mysqli_fetch_assoc($topic_choose)) : ?>
                                <?php if ($id['topic_category'] != '1') : ?>
                                    <option value="<?= $id['topic_id']; ?>" <?= ((isset($_POST['topic_id']) && $_POST['topic_id'] == $id['id']) ? ' selected' : ''); ?>><?= $id['topic']; ?></option>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" name="add_res" class="btn btn-lg btn-primary">Add researcher</button>
                </form>
            </div>
        </div>
    </div>

<?php } ?>
<?php include(ROOT . DS . "admin" . DS . "researcher" . DS . "components" . DS . "footer.php"); ?>