<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/researchgate/core/db.php';

// publisher query 
$publisher = $db->query("SELECT * FROM administrators WHERE deleted = 0 ORDER BY id DESC");


// Query on the number of Permitted Reviewers
$permitted_Reviewers = $db->query("SELECT * FROM reviewers WHERE deleted = 0 AND permitted = 1");
$p_reviewers = mysqli_num_rows($permitted_Reviewers);

// Query on the number of unPermitted Reviewers
$pending_Reviewers = $db->query("SELECT * FROM reviewers WHERE deleted = 0 AND permitted = 0");
$pen_reviewers = mysqli_num_rows($pending_Reviewers);

// Query on the number of Permitted researchers
$permitted_researchers = $db->query("SELECT * FROM researchers WHERE deleted = 0 AND permitted = 1");
$p_res = mysqli_num_rows($permitted_researchers);

// Query on the number of unPermitted researcher
$pending_res = $db->query("SELECT * FROM researchers WHERE deleted = 0 AND permitted = 0");
$pen_res = mysqli_num_rows($pending_res);

// while loop data 
$sql_rev = "SELECT * FROM reviewers WHERE deleted != 1 AND permitted != 1 ORDER BY id DESC";
$results_rev = $db->query($sql_rev);

$sql_res = "SELECT * FROM researchers WHERE deleted != 1 AND permitted != 1 ORDER BY id DESC";
$results_res = $db->query($sql_res);

// check permitted researchers for publisher viewers 
$sql_res_p = "SELECT * FROM researchers WHERE deleted != 1 AND permitted = 1 ORDER BY id DESC";
$results_res_permit = $db->query($sql_res_p);



$id = $user_data['id'];
$sql_topic = "SELECT * FROM propose_topic WHERE user_ids = $id ORDER BY topic_id DESC";
$results_topic = $db->query($sql_topic);
$r_topic = $db->query($sql_topic);
$rs_topic = $db->query($sql_topic);

// $abst_topic = mysqli_fetch_assoc($results_topic);

if (isset($_GET['pending'])) {
    $id = sanitize($_GET['pending']);
    $db->query("UPDATE reviewers SET permitted = 1 WHERE id = '$id'");
    $_SESSION['success_mesg'] = 'The User Has been permitted';
    header('Location: user-permision.php');
    exit;
}

if (isset($_GET['pend'])) {
    $id = sanitize($_GET['pend']);
    $db->query("UPDATE researchers SET permitted = 1 WHERE id = '$id'");
    $_SESSION['success_mesg'] = 'The User Has been permitted';
    header('Location: user-permision.php');
    exit;
}

if (isset($_GET['permit_publisher'])) {
    $id = sanitize($_GET['permit_publisher']);
    $db->query("UPDATE administrators SET permitted = 1 WHERE id = '$id'");
    $_SESSION['success_mesg'] = 'The User Has been permitted';
    header('Location: user-publisher.php');
    exit;
}


// get the upload cat 
$select_type = $db->query("SELECT * FROM `upload_type`");


$parentQuery = $db->query("SELECT * FROM res_area WHERE root_id = 0 ORDER BY id");

// selecting topic category as either collaborated or single research paper query 
$topic_Query = $db->query("SELECT * FROM topic_category ORDER BY id");

// select patners to a research paper 
$main_id = $user_data['id'];
$res_patner = $db->query("SELECT * FROM collaboratory_res WHERE main_res = '{$main_id}' ORDER BY id DESC");

// select patners to a research paper 
$sub_patner = $user_data['id'];
$res_sub_patner = $db->query("SELECT * FROM collaboratory_res WHERE res_id = '{$sub_patner}' ORDER BY id DESC");

// absract views upon uploading the document 
$abt_id = $user_data['id'];
$abt_ids = $user_data['id'];
// $abt_data = $db->query("SELECT * FROM docux_work WHERE res_id = $abt_id");
// $abts_data = mysqli_fetch_assoc($abt_data);
$abt_topic = $db->query("SELECT * FROM propose_topic WHERE user_ids = $abt_ids ORDER BY user_ids DESC");


// notification query for researchers upon adding them to paper 
$receiver_id = $user_data['id'];
$notication_mesg = $db->query("SELECT * FROM notify_mesg WHERE receiver_id = '{$receiver_id}' ORDER BY notify_id");
$count_mesg = mysqli_num_rows($notication_mesg);


// get topic categories for the reviewers to see difference research topic areas that interest them 
if (isset($_GET['cat'])) {
    $cat_id = sanitize($_GET['cat']);
} else {
    $cat_id = '';
}
$topic_category = $db->query("SELECT * FROM `propose_topic` WHERE res_field = '$cat_id'");


if (isset($_GET['interest'])) {
    $interest_topic_id = (int)sanitize($_GET['interest']);
    $reviewer_id = $user_data['id'];

    $db->query("INSERT INTO `review_interest`(`reviewer_id`, `topic_interested_id`) VALUES ('{$reviewer_id}','{$interest_topic_id}')");
    header('Location: ' . PROOT . 'admin' . DS . 'reviewers' . DS . 'components' . DS . 'interest_papers.php');
}

// do not allow showing reviewer's interest to a paper more than once. 
$rev_int_id = $user_data['id'];
$check_interest = $db->query("SELECT * FROM `review_interest` WHERE reviewer_id = $rev_int_id");
$check_values = mysqli_fetch_assoc($check_interest);

// select the researcher from the interested topic viewes table 
$reviewer_int_id = $user_data['id'];
// get the topic his is interested to 
$rev_int = $db->query("SELECT i.topic_interested_id as 'res_topics',
                            i.reviewer_id as reviewer,
                            i.published as rel,
                            p.sub_field as specific_field, 
                            p.user_ids as researcher, 
                            p.submit_topic as date_submitted,
                            p.topic_category as res_type,
                            p.topic as resTopic
                        FROM 
                            review_interest i
                        LEFT JOIN
                            propose_topic p
                        ON
                            i.topic_interested_id = p.topic_id WHERE reviewer_id = '{$reviewer_int_id}' ORDER BY date_submitted DESC");

$res_topic_count = $user_data['id'];
$topic_count = $db->query("SELECT * FROM `propose_topic` WHERE user_ids = '{$res_topic_count}'");
$topic_counts = mysqli_num_rows($topic_count);

$res_id_count = $user_data['id'];
$reviewed_topic_count = $db->query("SELECT
                                        pt.user_ids AS res_id,
                                        ri.reviewer_id AS reviwer
                                    FROM
                                        propose_topic pt
                                    LEFT JOIN review_interest ri ON
                                        ri.topic_interested_id = pt.topic_id
                                    WHERE
                                        user_ids = '{$res_id_count}'");
$rev_counts = mysqli_num_rows($reviewed_topic_count);

// show publication 


// count the research areas for the publisher's dashboard 
$res_cat = mysqli_num_rows($db->query("SELECT * FROM `res_area` ORDER BY `id` ASC"));


$rev_tab = $db->query("SELECT * FROM `reviewers` ORDER BY `reviewers`.`join_data` DESC");

$res_tab = $db->query("SELECT * FROM `researchers` ORDER BY `researchers`.`join_data` DESC");

$res_fields = $db->query("SELECT * FROM `res_area` ORDER BY `id` ASC");


// get assign researchers
$assign_id = $user_data['id'];
$assign = $db->query("SELECT distinct `date_assig`, `researcher_id`, `rev_id`, `published` FROM `res_rev_process` WHERE rev_id = '{$assign_id}'");


// get res upload info 
$uploads = $user_data['id'];
$res_upload = $db->query("SELECT * FROM `res_uploads` WHERE res_id = $uploads");
