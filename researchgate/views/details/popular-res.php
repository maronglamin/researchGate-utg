<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';

$sql = $db->query("SELECT * FROM `researchers` WHERE `status` = 1");

?>
<div class="site-section">
    <div class="container">


        <div class="row mb-5 justify-content-center text-center">
            <div class="col-lg-6 mb-5">
                <h2 class="section-title-underline mb-3">
                    <span>RESEARCH & DEVELOPMENT</span>
                </h2>
                <p>Top and most recent researches conducted and published on RESGATE. Find RESEARCHERS that write those papers</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="owl-slide-3 owl-carousel">
                    <?php while ($result = mysqli_fetch_assoc($sql)) :
                        $res_id = $result['id'];
                        $res_topic = $db->query("SELECT * FROM `propose_topic` WHERE `user_ids` = '{$res_id}'");
                        $res_info = mysqli_fetch_assoc($res_topic);
                    ?>
                        <div class="course-1-item">
                            <figure class="thumnail"><br>
                                <a href="#"> <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?= PROOT ?>admin/img/undraw_profile.svg" alt=""></a>
                                <!-- <div class="price">$99.00</div> -->
                                <div class="category">
                                    <h3><?= $result['full_name']; ?></h3>
                                </div>
                            </figure>
                            <div class="course-1-content pb-4">
                                <h2>Research Topic</h2>
                                <h2><?= $res_info['topic']; ?></h2>
                                <div class="rating text-center mb-3">
                                    <span class="icon-star2 text-warning"></span>
                                    <span class="icon-star2 text-warning"></span>
                                </div>
                                <p class="desc mb-4">
                                    <?php
                                    $desc = $res_info['short_note'];
                                    if (strlen($desc) > 50)
                                        echo substr($desc, 0, 155) . '...';
                                    ?>
                                </p>
                                <p><a href="<?= PROOT ?>views/details/details.php?resInfo=<?= $res_id ?>" class="btn btn-primary rounded-0 px-4">More About The Researcher</a></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</div>