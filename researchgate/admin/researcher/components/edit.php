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

$edit_topic = ((isset($_POST['res-topic']) && $_POST['res-topic'] != '') ? sanitize($_POST['res-topic']) : '');
$edit_sub_field = ((isset($_POST['subField']) && $_POST['subField'] != '') ? sanitize($_POST['subField']) : '');
$edit_topic_cat = ((isset($_POST['catTopic']) && $_POST['catTopic'] != '') ? sanitize($_POST['catTopic']) : '');
$edit_shortnote = ((isset($_POST['description']) && $_POST['description'] != '') ? sanitize($_POST['description']) : '');
$edit_res_field = ((isset($_POST['parent']) && $_POST['parent'] != '') ? sanitize($_POST['parent']) : '');
$errors = array();
$tid = (int)$_GET['edit'];

if (isset($_GET['edit'])) {
	$id = (int)$_GET['edit'];
	$userQuery = $db->query("SELECT * FROM `propose_topic` WHERE topic_id = '{$id}'");
	$users = mysqli_fetch_assoc($userQuery);

	$topic = $users['topic'];
	$sub_field = $users['sub_field'];
	$topic_cat = $users['topic_category'];
	$topic_cat = $users['topic_category'];
	$res_field = $users['res_field'];

	$note = $users['short_note'];
}

if (isset($_GET['post'])) {
	$id = (int)$_GET['post'];
	if (isset($_POST['save_change'])) {
		$required = array('res-topic', 'subField', 'catTopic', 'description');
		foreach ($required as $fields) {
			if ($_POST[$fields] == '') {
				$errors[] = 'You must fill out all fields marked with start(*).';
				break;
			}
		}
		if (!empty($errors)) {
			echo display_errors($errors);
			header('Location: abst_views.php');
			$_SESSION['error_mesg'] = 'editing errors, please check your inputs';
		} else {
			$db->query("UPDATE `propose_topic` SET `topic`= '{$edit_topic}', `sub_field` = '{$edit_sub_field}', `topic_category` = '{$edit_topic_cat}', `res_field` = '{$edit_res_field}', `short_note` = '{$edit_shortnote}' WHERE `topic_id` = '{$id}'");
			$_SESSION['success_mesg'] = 'Edit successful.';
			header('Location: abst_views.php');
		}
	}
}
?>
<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Editing Work Sheet.</h1>
		<a href="<?= PROOT ?>admin/researcher/components/abst_views.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="text-white-50"></i> Cancel Edit</a>
	</div>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary text-center">Research Profile Edit</h6>
		</div>
		<div class="card-body">
			<form action="edit.php?post=<?= $tid ?>" method="post">
				<div class="form-group text-right">
					<button type="submit" name="save_change" class="btn btn-success"><i class="fas fa-save fa-sm text-white-50"></i> Save</button>
				</div>
				<div class="row">
					<div class="form-group col-sm-8">
						<label for="topic"><strong>Research Topic</strong></label>
						<input type="text" id="topic" name="res-topic" class="form-control" value="<?= $topic ?>">
					</div>
					<div class="form-group col-sm-4">
						<label for="parent">Research field</label>
						<select class="form-control" id="parent" name="parent">
							<option value="" <?= ((isset($_POST['parent']) && $_POST['parent'] == '') ? ' selected' : ''); ?>></option>
							<?php while ($pa = mysqli_fetch_assoc($parentQuery)) : ?>
								<option value="<?= $pa['id']; ?>" <?= (($res_field == $pa['id']) ? ' selected' : ''); ?>><?= $pa['category']; ?></option>
							<?php endwhile; ?>
						</select>
					</div>
					<div class="form-group col-sm-4">
						<label for="sub"><strong>Sub Research Field</strong></label>
						<input type="text" id="sub" name="subField" class="form-control" value="<?= $sub_field ?>">

						<label for="catTopic"><strong>Select research category</strong></label>
						<select class="form-control" id="catTopic" name="catTopic">
							<option value="" <?= ((isset($_POST['catTopic']) && $_POST['catTopic'] == '') ? ' selected' : ''); ?>></option>
							<?php while ($p = mysqli_fetch_assoc($topic_Query)) : ?>
								<option value="<?= $p['id']; ?>" <?= (($topic_cat == $p['id']) ? ' selected' : ''); ?>><?= $p['topic_category']; ?></option>
							<?php endwhile; ?>
						</select>
					</div>
					<div class="form-group col-sm-8">
						<label for="description">Short for the Reviewer</label>
						<textarea id="description" name="description" class="form-control" rows="3"><?= $note ?></textarea>
					</div>
				</div>
				<h6 class="h3 mb-0 text-primary text-center">Research Uploaded Materials</h6><br>
				<div class="row">
					<div class="col-lg-4">
						<div class="card shadow mb-4">
							<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
								<h6 class="m-0 font-weight-bold text-primary">Abstract Document</h6>
							</div>
							<div class="card-body">
								<div class="col-lg-12">
									<div class="text-center">
										<a href="readMethod.php?readFile=<?= $tid ?>" target="_blank" rel="noopener noreferrer"><img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?= PROOT ?>assets/img/download.svg" alt=""></a>
									</div>
									<div class="d-sm-flex align-items-center justify-content-between mb-4">
										<h6 class="text-gray-800">Preview</h6>
										<a href="readMethod.php?readFile=<?= $tid ?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-eye fa-sm text-white-50"></i> View PDF file</a>
									</div>
									<div class="d-sm-flex align-items-center justify-content-between mb-4">
										<h6 class="text-gray-800">Delete file</h6>
										<a href="readMethod.php?deleteAbst=<?= $tid ?>" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-trash fa-sm text-white-50"></i> Delete Abstract</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="card shadow mb-4">
							<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
								<h6 class="m-0 font-weight-bold text-primary">Draft Document</h6>
							</div>
							<div class="card-body">
								<div class="col-lg-12">
									<div class="text-center">
										<a href="readMethod.php?readDraft=<?= $tid ?>" target="_blank" rel="noopener noreferrer"><img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?= PROOT ?>assets/img/download.svg" alt=""></a>
									</div>
									<div class="d-sm-flex align-items-center justify-content-between mb-4">
										<h6 class="text-gray-800">Preview</h6>
										<a href="readMethod.php?readDraft=<?= $tid ?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-eye fa-sm text-white-50"></i> View PDF file</a>
									</div>
									<div class="d-sm-flex align-items-center justify-content-between mb-4">
										<h6 class="text-gray-800">Delete file</h6>
										<a href="readMethod.php?deleteDraft=<?= $tid ?>" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-trash fa-sm text-white-50"></i> Delete Darft</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="card shadow mb-4">
							<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
								<h6 class="m-0 font-weight-bold text-primary">Report Document</h6>
							</div>
							<div class="card-body">
								<div class="col-lg-12">
									<div class="text-center">
										<a href="readMethod.php?readReportFile=<?= $tid ?>" target="_blank" rel="noopener noreferrer"><img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?= PROOT ?>assets/img/download.svg" alt=""></a>
									</div>
									<div class="d-sm-flex align-items-center justify-content-between mb-4">
										<h6 class="text-gray-800">Preview</h6>
										<a href="readMethod.php?readReportFile=<?= $tid ?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-eye fa-sm text-white-50"></i> View PDF file</a>
									</div>
									<div class="d-sm-flex align-items-center justify-content-between mb-4">
										<h6 class="text-gray-800">Delete file</h6>
										<a href="readMethod.php?deleteReport=<?= $tid ?>" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-trash fa-sm text-white-50"></i> Delete report</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php include(ROOT . DS . "admin" . DS . "researcher" . DS . "components" . DS . "footer.php");
ob_get_flush();
?>