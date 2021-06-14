<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';
include(ROOT . DS . "core" . DS . "head.php");
include(ROOT . DS . "views" . DS . "top-nav" . DS . "slide-nav.php");
include(ROOT . DS . "views" . DS . "top-nav" . DS . "nav-list.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = (int)sanitize($_GET['resInfo']);
    $sql = mysqli_fetch_assoc($db->query("SELECT * FROM `researchers` WHERE id ='{$id}'"));
    $topics = $db->query("SELECT * FROM `propose_topic` WHERE `user_ids` = '{$id}'");
?>
    <div class="site-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">Researcher: <?= $sql['full_name']; ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?= PROOT ?>admin/img/undraw_profile.svg" alt="">
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <h2 class="section-title-underline">
                                        <span>Join Date</span>
                                    </h2>
                                    <?= month_day_year_formate($sql['join_data']) ?>
                                </div>
                                <div class="col-md-4">
                                    <h2 class="section-title-underline">
                                        <span>Last Join Date</span>
                                    </h2>
                                    <?= month_day_year_formate($sql['last_login']) ?>
                                </div>
                                <div class="col-md-4">
                                    <h2 class="section-title-underline">
                                        <span>Permission</span>
                                    </h2>
                                    <?php if ($sql['permitted'] == 1) : ?>
                                        Actively participant
                                    <?php else : ?>
                                        Not participant on resGate
                                    <?php endif; ?>
                                </div>
                            </div><br>
                            <div class="row mb-5 justify-content-center">
                                <div class="col-lg-12 mb-5">
                                    <h2 class="section-title-underline mb-5">
                                        <span>Research Topics</span>
                                    </h2>
                                    <?php while ($topic = mysqli_fetch_assoc($topics)) : ?>
                                        <span class="icon-star2 text-warning"></span> <?= $topic['topic']; ?> <br>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }
?>