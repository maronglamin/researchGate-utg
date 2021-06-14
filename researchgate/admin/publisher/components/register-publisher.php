<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
include(ROOT . DS . "core" . DS . "head.php");

$name = ((isset($_POST['name'])) ? sanitize($_POST['name']) : '');
$email = ((isset($_POST['email'])) ? sanitize($_POST['email']) : '');
$password = ((isset($_POST['password'])) ? sanitize($_POST['password']) : '');
$confirm = ((isset($_POST['confirm'])) ? sanitize($_POST['confirm']) : '');
$errors = array();
?>
<div class="site-section">
    <div class="container">


        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-center">PUBLISHER REGISTRATION</h6>
                    </div>
                    <div class="card-body">
                        <form action="register-publisher.php" method="post">
                            <div>
                                <?php
                                if ($_POST) {

                                    $emailQuery = $db->query("SELECT * FROM administrators WHERE email = '$email'");
                                    $emailCount = mysqli_num_rows($emailQuery);


                                    if ($emailCount != 0) {
                                        $errors[] = 'That email exist in our database';
                                    }

                                    $required = array('name', 'email', 'password', 'confirm');
                                    foreach ($required as $fields) {
                                        if ($_POST[$fields] == '') {
                                            $errors[] = 'You must fill out all fields marked with star(*).';
                                            break;
                                        }
                                    }
                                    if (strlen($password) < 6) {
                                        $errors[] = 'The password must be at least 6 characters.';
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
                                        $insert = "INSERT INTO administrators (`full_name`,`email`,`password`) VALUES('$name','$email','$hashed')";
                                        $db->query($insert);
                                        $_SESSION['success_mesg'] = 'Registration successful.';
                                        header('Location: ../index.php');
                                    }
                                }
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="name">Full Name *</label>
                                    <input type="text" name="name" id="name" class="form-control form-control-lg" value="<?= $name ?>">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-lg" value="<?= $email ?>">
                                    <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="password">Password *</label>
                                    <input type="password" name="password" id="password" class="form-control form-control-lg" value="<?= $password ?>">
                                    <small class="form-text text-muted"><strong>Warning! </strong>Use mixed combination of characters.</small>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="confirm">Re-type Password *</label>
                                    <input type="password" name="confirm" id="confirm" class="form-control form-control-lg" value="<?= $confirm ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <input type="submit" value="Register" class="btn btn-primary btn-lg px-5">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Don't have an acount? <a href="<?= PROOT ?>admin/publisher/">SIGN UP!</a></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>