<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
require_once(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "simple-query.php");

include(ROOT . DS . "core" . DS . "head.php");

$name = ((isset($_POST['name'])) ? sanitize($_POST['name']) : '');
$email = ((isset($_POST['email'])) ? sanitize($_POST['email']) : '');
$password = ((isset($_POST['password'])) ? sanitize($_POST['password']) : '');
$confirm = ((isset($_POST['confirm'])) ? sanitize($_POST['confirm']) : '');
$res_area = ((isset($_POST['field_id'])) ? sanitize($_POST['field_id']) : '');
$errors = array();
?>
<div class="site-section">
    <div class="container">


        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-center">PUBLISHER REGISTRATION</h6>
                    </div>
                    <div class="card-body">
                        <div>
                            <?php
                            if ($_POST) {

                                $emailQuery = $db->query("SELECT * FROM reviewers WHERE email = '$email'");
                                $emailCount = mysqli_num_rows($emailQuery);


                                if ($emailCount != 0) {
                                    $errors[] = 'that email exist in our database';
                                }

                                $required = array('name', 'email', 'password', 'confirm', 'field_id');
                                foreach ($required as $fields) {
                                    if ($_POST[$fields] == '') {
                                        $errors[] = 'You must fill out all fields marked with start(*).';
                                        break;
                                    }
                                }
                                if (strlen($password) < 6) {
                                    $errors[] = 'the password must be at least 6 characters.';
                                }
                                if ($password != $confirm) {
                                    $errors[] = 'Your password does not match the confirmation';
                                }
                                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    $errors[] = 'You must enter a valid email address';
                                }
                                if (!empty($errors)) {
                                    echo display_errors($errors);
                                } else {
                                    // add user
                                    $hashed = password_hash($password, PASSWORD_DEFAULT);
                                    $insert = "INSERT INTO reviewers (`full_name`,`email`,`password`,`rev_field`) VALUES('{$name}','{$email}','{$hashed}', '{$res_area}')";
                                    $db->query($insert);
                                    $_SESSION['success_mesg'] = 'Registration successful.';
                                    header('Location: ../index.php');
                                }
                            }
                            ?>
                        </div>
                        <form action="register-reviwers.php" method="post">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="name">Full Name *</label>
                                    <input type="text" name="name" id="name" class="form-control form-control" value="<?= $name ?>">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" name="email" id="email" class="form-control form-control" value="<?= $email ?>">
                                    <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="password">Password *</label>
                                    <input type="password" name="password" id="password" class="form-control form-control" value="<?= $password ?>">
                                    <small class="form-text text-muted"><strong>Warning! </strong>Use mixed combination of characters.</small>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="confirm">Re-type Password *</label>
                                    <input type="password" name="confirm" id="confirm" class="form-control form-control" value="<?= $confirm ?>">
                                </div>
                                <div class="form-group col-12">
                                    <label for="res_email">Select Your field of which you will review paper *</label>
                                    <select class="form-control" id="field_id" name="field_id">
                                        <option value="" <?= ((isset($_POST['field_id']) && $_POST['field_id'] == '') ? ' selected' : ''); ?>></option>
                                        <?php while ($id = mysqli_fetch_assoc($parentQuery)) : ?>
                                            <option value="<?= $id['id']; ?>" <?= ((isset($_POST['field_id']) && $_POST['field_id'] == $id['id']) ? ' selected' : ''); ?>><?= $id['category']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                    <small><strong>Warning</strong> You will not be able to review other field that you don't select</small>
                                </div>
                                <!-- <div class="col-md-12 form-group">
                                    <label for="confirm">more field coming soon *</label>
                                    <input type="password" id="confirm" class="form-control form-control" value="<?= $confirm ?>">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="confirm">more field coming soon *</label>
                                    <input type="password" id="confirm" class="form-control form-control" value="<?= $confirm ?>">
                                </div> -->
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <input type="submit" value="Register" class="btn btn-primary btn-lg px-5">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Don't have an acount? <a href="<?= PROOT ?>admin/reviewers/index.php">Login!</a></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>