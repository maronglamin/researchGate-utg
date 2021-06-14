<?php
ob_start();
$cat = ((isset($_POST['cat'])) ? sanitize($_POST['cat']) : '');
$password = trim($cat);
$errors = array();
if ($_POST) {

    $required = array('cat');
    foreach ($required as $fields) {
        if ($_POST[$fields] == '') {
            $errors[] = 'You must fill out all fields';
            break;
        }
    }

    $db->query("INSERT INTO `res_area`(`category`) VALUES('{$cat}')");
    header("Location: " . PROOT . 'admin/publisher/components/assig_rev_topic.php');
}
ob_get_flush();
?>
<!-- Logout Modal-->
<div class="modal fade" id="addcat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add more Research fields to ResGate</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    <div class="col-lg-12 form-group">
                        <label for="cat">Category Name:</label>
                        <input type="text" name="cat" class="form-control">
                        <small>This category is what makes it easier to select your REVIEWERS</small>
                    </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <input type="submit" value="Add" class="btn btn-primary">
            </div>
            </form>
        </div>
    </div>
</div>