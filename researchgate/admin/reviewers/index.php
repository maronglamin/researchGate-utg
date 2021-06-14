<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
include(ROOT . DS . "core" . DS . "head.php");
$email = ((isset($_POST['email'])) ? sanitize($_POST['email']) : '');
$email = trim($email);
$password = ((isset($_POST['password'])) ? sanitize($_POST['password']) : '');
$password = trim($password);
$errors = array();
?>


<div class="site-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-center">Login Action</h6>
                    </div>
                    <div class="card-body">
                        <form action="index.php" method="post">
                            <div class="row">
                                <!-- display the form validation here, when it occur  -->
                                <div>
                                    <?php
                                    if ($_POST) {
                                        //form validation
                                        if (empty($_POST['email']) || empty($_POST['password'])) {
                                            $errors[] = 'You must provide email and password.';
                                        }

                                        //validate email
                                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                            $errors[] = 'You must enter a valid email';
                                        }
                                        //checking password's length
                                        if (strlen($password) < 6) {
                                            $errors[] = 'Password must be at least 6 character.';
                                        } //check if the email exist in the database
                                        $query = $db->query("SELECT * FROM reviewers WHERE email = '$email'");
                                        $user = mysqli_fetch_assoc($query);
                                        $userCount = mysqli_num_rows($query);

                                        if ($userCount < 1) {
                                            $errors[] = 'That record doesn\' t exist in the database';
                                        } // check if user is deleted 
                                        $delquery = $db->query("SELECT * FROM reviewers WHERE email = '$email' AND deleted != 0");
                                        $counter = mysqli_num_rows($delquery);


                                        if ($counter >= 1) {
                                            $errors[] = 'We have block your usage to the system, PLEASE contact us';
                                        }

                                        $permitQuery = $db->query("SELECT * FROM reviewers WHERE email = '$email' AND permitted = 0");
                                        $counterPermission = mysqli_num_rows($permitQuery);

                                        if ($counterPermission >= 1) {
                                            $errors[] = 'You not permiited yet to login to the system. Please wait until you are permitted';
                                        }

                                        if (!password_verify($password, $user['password'])) {
                                            $errors[] = 'the password does not match our records. please try again.';
                                        }

                                        if (!empty($errors)) {
                                            echo display_errors($errors);
                                        } else {
                                            //log user in
                                            $user_id = $user['id'];
                                            login_reviewer($user_id);
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-lg" value="<?= $email ?>">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control form-control-lg" value="<?= $password ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <input type="submit" value="Log In" class="btn btn-primary btn-lg px-5">
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Don't have an acount? <a href="<?= PROOT ?>admin/reviewers/components/register-reviwers.php">SIGN UP!</a></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>