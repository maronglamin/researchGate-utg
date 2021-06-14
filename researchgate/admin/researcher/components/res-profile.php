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
$id = $user_data['id'];

$check_user = $user_data['id'];
$check = $db->query("SELECT * FROM `res_profile` WHERE `res_id` = $check_user");
$image = mysqli_fetch_assoc($check);
$check_result = mysqli_num_rows($check);

$path = PROOT . "admin/researcher/components/" . $image['path'];
// dnd($path);
if (isset($_POST['save'])) {
    // name of the uploaded file
    $filename = $_FILES['pdfFile']['name'];

    $destination = 'p_images' . DS . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['pdfFile']['tmp_name'];
    $size = $_FILES['pdfFile']['size'];

    if (!in_array($extension, ['jpg', 'png'])) {
        $errors;
    } elseif ($_FILES['pdfFile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        $errors;
    }

    if ($filename == '') {
        $errors;
    }
    if (!empty($errors)) {
        $_SESSION['error_mesg'] .= 'We have detected an ERRORS your inputs or we have the material of the selected topic, please try again';
        header('Location: res-profile.php');
    } else {
        if (move_uploaded_file($file, $destination)) {
            $sql = $db->query("INSERT INTO `res_profile` (`res_id`, `path`) VALUES ('$id', '$destination')");
            $_SESSION['success_mesg'] .= "File uploaded successfully";
            header('Location: ' . PROOT . 'admin/researcher/components/res-profile.php');
        } else {
            $_SESSION['error_mesg'] .= "Fail to upload file";
            header('Location: ' . PROOT . 'admin/researcher/components/res-profile.php');
        }
    }
}
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User profile.</h1>
        <!-- <input type="file" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="text-white-50"></i> Edit Profile</input> -->
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User profile photo</h6>
        </div>
        <div class="card-body">
            <div class="text-center">
                <form action="res-profile.php" method="post" enctype="multipart/form-data">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Photo Uploads</h1>
                        <input type="submit" name="save" Value="Save" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                    </div>
                    <?php if ($check_result == 0) : ?>
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?= PROOT ?>admin/img/undraw_profile.svg" alt="">
                        <div class="col-sm-4 offset-sm-4 form-group">
                            <label for="img">Upload Photo</label>
                            <input type="file" id="img" name="pdfFile" class="btn btn-primary">
                        </div>
                    <?php else : ?>
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?= $path ?>" alt=""> <br>
                        <div class="col-sm-4 offset-sm-4 form-group">
                            <button type="button" name="save" Value="Save" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">Edit</button>
                        </div>
                    <?php endif; ?>

                </form>
            </div>
        </div>
    </div>

</div>

<?php include(ROOT . DS . "admin" . DS . "researcher" . DS . "components" . DS . "footer.php");
ob_get_flush();
?>