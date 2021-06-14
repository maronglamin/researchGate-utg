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

$errors = array();
$user = (isset($_POST['user_id']) ? sanitize($_POST['user_id']) : '');
$user_topic = (isset($_POST['topic_id']) ? sanitize($_POST['topic_id']) : '');
$type_topic = (isset($_POST['type_id']) ? sanitize($_POST['type_id']) : '');

$topic_validate = $db->query("SELECT * FROM `res_uploads` WHERE `res_topic` = '{$user_topic}'");
$validate = mysqli_num_rows($topic_validate);


// Uploads files
if (isset($_POST['save'])) {

    if ($validate != 0) {
        $errors;
    }

    // name of the uploaded file
    $filename = $_FILES['pdfFile']['name'];


    // destination of the file on the server
    if ($type_topic == '1') {
        $destination = 'uploadFiles/' . $user . '-' . $user_topic . '-' . $filename;
    } elseif ($type_topic == '2') {
        $destination = 'draftFiles/' . $user . '-' . $user_topic . '-' . $filename;
    } else {
        $destination = 'reportFiles/' . $user . '-' . $user_topic . '-' . $filename;
    }
    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['pdfFile']['tmp_name'];
    $size = $_FILES['pdfFile']['size'];

    if (!in_array($extension, ['pdf'])) {
        $errors;
    } elseif ($_FILES['pdfFile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        $errors;
    }

    if ($filename == '') {
        $errors;
    }
    if (!empty($errors)) {
        $_SESSION['error_mesg'] .= 'We have detected an ERRORS your inputs or we have the material of the selected topic, please try again';
        header('Location: res-desc.php');
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            if ($type_topic == '1') {
                $sql = $db->query("INSERT INTO `res_uploads` (`res_topic`, `res_id`, `name_docu`, `size`, `downloads`) VALUES ('$user_topic', '$user', '$destination', '$size', 0)");
            } elseif ($type_topic == '2') {
                $sql = $db->query("INSERT INTO `draft_uploads` (`res_topic`, `res_id`, `name_docu`, `size`, `downloads`) VALUES ('$user_topic', '$user', '$destination', '$size', 0)");
            } else {
                $sql = $db->query("INSERT INTO `report_uploads` (`res_topic`, `res_id`, `name_docu`, `size`, `downloads`) VALUES ('$user_topic', '$user', '$destination', '$size', 0)");
            }

            $_SESSION['success_mesg'] .= "File uploaded successfully";
            header('Location: ' . PROOT . 'admin/researcher/components/abst_views.php');
        } else {
            $_SESSION['error_mesg'] .= "Fail to upload file";
            header('Location: ' . PROOT . 'admin/researcher/components/res-desc.php');
        }
    }
}

ob_get_flush();
?>

<div class="col-lg-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Upload Research Materials</h1>
    </div>
    <!-- Default Card Example -->
    <div class="card mb-4">
        <div class="card-header text-uppercase">
            Uploading a PDF file
        </div>
        <div class="card-body">
            <form class="form" action="res-desc.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="res_email"><strong>Select the RESEARCH topic (required)</strong></label>
                        <select class="form-control" id="topic_id" name="topic_id">
                            <option value="" <?= ((isset($_POST['topic_id']) && $_POST['topic_id'] == '') ? ' selected' : ''); ?>></option>
                            <?php while ($id = mysqli_fetch_assoc($r_topic)) : ?>
                                <option value="<?= $id['topic_id']; ?>" <?= ((isset($_POST['topic_id']) && $_POST['topic_id'] == $id['id']) ? ' selected' : ''); ?>><?= $id['topic']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label for="res_email"><strong>Select the file category for upload</strong></label>
                        <select class="form-control" id="type_id" name="type_id">
                            <option value="" <?= ((isset($_POST['type_id']) && $_POST['type_id'] == '') ? ' selected' : ''); ?>></option>
                            <?php while ($id = mysqli_fetch_assoc($select_type)) : ?>
                                <option value="<?= $id['type_id']; ?>" <?= ((isset($_POST['type_id']) && $_POST['type_id'] == $id['id']) ? ' selected' : ''); ?>><?= $id['type_name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="description">The Upload Abstract Document (required)</label>
                        <input type="file" id="pdfFile" name="pdfFile" class="form-control">
                    </div>
                </div>
                <input type="hidden" name="user_id" id="user_id" value="<?= $user_data['id']; ?>">
                <input type="submit" id="uploadPDF" name="save" value="Upload" class="btn btn-success">
            </form>
        </div>
    </div>
</div>

</div>
<?php
include(ROOT . DS . "admin" . DS . "researcher" . DS . "components" . DS . "footer.php"); ?>