<?php
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
if (!is_logged_in()) {
    error_redirect('../index');
}
require_once(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "simple-query.php");
include(ROOT . DS . "core" . DS . "head-admin.php");

include(ROOT . DS . "admin" . DS . "researcher" . DS . "dashboard" . DS . "aside.php");
include(ROOT . DS . "admin" . DS . "researcher" . DS . "dashboard" . DS . "topnav.php");
// require_once(ROOT . DS . "admin" . DS . "researcher" . DS . "components" . DS . "proposal.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $field = sanitize($_POST['parent']);
    $sub_field = sanitize($_POST['child']);
    $restopic = sanitize($_POST['restopic']);
    $descri = sanitize($_POST['description']);
    $user_id = sanitize($_POST['user_id']);
    $topic_category = sanitize($_POST['catTopic']);


    $required = array('restopic', 'child', 'parent', 'catTopic');
    foreach ($required as $fields) {
        if ($_POST[$fields] == '') {
            $errors[] = '<strong>You must fill out all required fields.</strong>';
            break;
        }
    }

    if (!empty($errors)) {
        echo display_errors($errors);
    } else {

        $db->query("INSERT INTO propose_topic (`topic_category`,`user_ids`,`res_field`,`sub_field`,`topic`,`short_note`) VALUES('$topic_category','$user_id','$field','$sub_field','$restopic','$descri')");
        header('Location: abst_views.php');
    }
}

ob_get_flush();
?>
<div class="container-fluid">
    <h1 class="h3 mb-1 text-gray-800 text-uppercase">Research specification</h1>
    <p class="mb-4">Our reviewers are in different section and each specilize in a perticular field of studies. please choose apropariately for reviewers to qiuckly take action to your reasearch topic.</p>
    <div class="row">

        <div class="col-lg-12">

            <!-- Default Card Example -->
            <div class="card mb-4">
                <div class="card-header text-uppercase">
                    research topic
                </div>
                <div class="card-body">
                    <form class="form" action="res-topics.php" method="post" enctype="multipart/form-data">
                        <div id="errors"></div>
                        <div class="row">
                            <div class="form-group col-sm-8">
                                <label for="parent">Research field (required)</label>
                                <select class="form-control" id="parent" name="parent">
                                    <option value="" <?= ((isset($_POST['parent']) && $_POST['parent'] == '') ? ' selected' : ''); ?>></option>
                                    <?php while ($parent = mysqli_fetch_assoc($parentQuery)) : ?>
                                        <option value="<?= $parent['id']; ?>" <?= ((isset($_POST['parent']) && $_POST['parent'] == $parent['id']) ? ' selected' : ''); ?>><?= $parent['category']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="chlid">Sub level (required)</label>
                                <input ytpe="text" id="child" class="form-control" name="child">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="restopic">Clearly state research topic (required)</label>
                                <input type="text" id="restopic" name="restopic" class="form-control">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="catTopic">Select research category (required)</label>
                                <select class="form-control" id="catTopic" name="catTopic">
                                    <option value="" <?= ((isset($_POST['catTopic']) && $_POST['catTopic'] == '') ? ' selected' : ''); ?>></option>
                                    <?php while ($parent = mysqli_fetch_assoc($topic_Query)) : ?>
                                        <option value="<?= $parent['id']; ?>" <?= ((isset($_POST['catTopic']) && $_POST['catTopic'] == $parent['id']) ? ' selected' : ''); ?>><?= $parent['topic_category']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="description">Description (short note about your topic)</label>
                                <textarea id="description" name="description" class="form-control" rows="5"></textarea>
                                <small>(Optional) Leave a short note for the reviewers of your research topic</small>
                            </div>
                        </div>
                        <input type="hidden" name="user_id" id="user_id" value="<?= $user_data['id']; ?>">
                        <input type="submit" class="btn btn-success btn-lg">
                    </form>
                </div>
            </div>

        </div>
    </div>
    <?php include(ROOT . DS . "admin" . DS . "researcher" . DS . "components" . DS . "footer.php"); ?>