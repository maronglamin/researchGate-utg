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
    if (isset($_GET['add_res'])) {
        $errors = array();
        $name = (isset($_POST['name']) ? sanitize($_POST['name']) : '');
        $email = (isset($_POST['email']) ? sanitize($_POST['email']) : '');
        $password = 'researcher';
        $password = trim($password);
        $role = 'researcher';

        if ($_POST) {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $emailQuery = $db->query("SELECT * FROM researchers WHERE email = '$email'");
            $emailCount = mysqli_num_rows($emailQuery);

            if ($emailCount != 0) {
                $errors[] = 'That email exist in our database';
            }

            $required = array('name', 'email');
            foreach ($required as $fields) {
                if ($_POST[$fields] == '') {
                    $errors[] = 'You must fill out all fields marked with start(*).';
                    break;
                }
            }

            if (!empty($errors)) {
                echo display_errors($errors); ?>
                <script>
                    jQuery('document').ready(function() {
                        jQuery('#errors').html('<?= $display ?>');
                    });
                </script>
    <?php  } else {
                $db->query("INSERT INTO researchers (`full_name`,`email`,`password`,`role`) VALUES('{$name}','{$email}','{$hashed}','{$role}')");
                $db->query("UPDATE researchers SET `permitted` = '1'");

                header('Location: choose.php');
            }
        }
    }
    ob_get_flush();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    ?>
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Add Collaboratory Researchers</h1>
        <p class="mb-4">Note: By default, upon adding Researchers: you becomes the main researcher and others are partners to your paper</p>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Collaboratory Form</h6>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <form action="process_col_res.php" method="post">
                        <div class="input-group">
                            <input type="email" id="email" name="searchEmail" class="form-control bg-light border-0 small" placeholder="Search researcher Email address" aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div><br>
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Register researcher if not signed up to the system</h1>
                    <p class="mb-4">you can register researchers and it will add to collaboration </p>
                    <p class="mb-4">Inform your new add partner of their password. The default password is: <strong>researcher</strong></p>
                    <form action="add_col_res.php?add_res=1" method="post">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="name">Full Name(*)</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                            <div class="form-group col-6">
                                <label for="email">Email Name(*)</label>
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                            <input type="submit" class="btn btn-xs btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php include(ROOT . DS . "admin" . DS . "researcher" . DS . "components" . DS . "footer.php"); ?>