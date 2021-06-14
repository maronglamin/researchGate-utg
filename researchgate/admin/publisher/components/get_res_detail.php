<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
require_once(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "simple-query.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!is_logged_in()) {
        login_error_redirect();
    }
    include(ROOT . DS . "core" . DS . "head-admin.php");

    include(ROOT . DS . "admin" . DS . "publisher" . DS . "dashboard" . DS . "aside.php");
    include(ROOT . DS . "admin" . DS . "publisher" . DS . "dashboard" . DS . "top-nav.php");


    $res_id = $_GET['details'];
    $res_sql = $db->query("SELECT * FROM `researchers` WHERE id = $res_id AND deleted = 0 ");
    $res_topic = $db->query("SELECT * FROM `propose_topic` WHERE user_ids = $res_id");

?>
    <div class="container-fluid">
        <?php while ($rev_user = mysqli_fetch_assoc($res_sql)) : ?>
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800"><?= $rev_user['full_name']; ?></h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="text-white-50"></i> Joined: <?= $rev_user['join_data']; ?></a>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="text-white-50"></i> lasted seen: <?= $rev_user['last_login']; ?></a>
            </div>


            <div class="row">
                <?php while ($propose_item = mysqli_fetch_assoc($res_topic)) :
                    // the query that select the research area id from the proposal table to the res_area 
                    $res_area =  $propose_item['res_field'];
                    $topic_result = $db->query("SELECT * FROM `res_area` WHERE id = $res_area");
                    $topic_value = mysqli_fetch_assoc($topic_result);
                ?>
                    <div class="col-lg-6">
                        <!-- Dropdown Card Example -->
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary"><?= $topic_value['category']; ?></h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Make an action:</div>
                                        <a class="dropdown-item" href="select_to_reviewer.php?details_select=<?= $rev_user['id']; ?>">Add to review List</a>
                                        <!-- <a class="dropdown-item" href="#"></a> -->
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Leave a message to the resescher</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <h6 class="m-0 font-weight-bold text-primary">Sub field to the research area</h6>
                                <?= $propose_item['sub_field']; ?>

                                <h6 class="m-0 font-weight-bold text-primary">Short note from the researcher...</h6>
                                <?= $propose_item['short_note']; ?>

                                <h6 class="m-0 font-weight-bold text-primary">Research Topic.</h6>
                                <?= $propose_item['topic']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">

                        <!-- Default Card Example -->
                        <div class="card mb-4">
                            <div class="card-header">
                                Default Card Example
                            </div>
                            <div class="card-body">
                                This card uses Bootstrap's default styling with no utility classes added. Global
                                styles are the only things modifying the look and feel of this default card example.
                            </div>
                        </div>

                    </div>
                <?php endwhile; ?>
            <?php endwhile; ?>
            </div>
    </div>
<?php include(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "footer.php");
} ?>