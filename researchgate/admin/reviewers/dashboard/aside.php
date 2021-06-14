<?php
require_once(ROOT . DS . "admin" . DS . "publisher" . DS . "components" . DS . "simple-query.php");
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <!-- <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-laugh-wink"></i>
         </div> -->
        <div class="sidebar-brand-text mx-3">ResGate-UTG Reviewer</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= PROOT ?>admin/reviewers/dashboard/index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Check Assigned Researcher
    </div>

    <li class="nav-item">
        <a class="nav-link" href="<?= PROOT ?>admin/reviewers/components/res_view.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Your Researchers</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>PROPOSALS</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Catergories:</h6>
                <?php while ($field = mysqli_fetch_assoc($parentQuery)) : ?>
                    <a class="collapse-item" href="<?= PROOT ?>admin/reviewers/components/field_category.php?cat=<?= $field['id']; ?>"><?= $field['category']; ?></a>
                <?php endwhile; ?>
            </div>
        </div>
    </li> -->

    <!-- Nav Item - Utilities Collapse Menu -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Quick Actions</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Research Materials:</h6>
                <a class="collapse-item" href="<?= PROOT ?>admin/reviewers/components/app_res_docu.php">Reseacrch Papers</a>
                <a class="collapse-item" href="<?= PROOT ?>admin/reviewers/components/accept_paper.php">Approve Papers</a>
            </div>
        </div>
    </li> Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        User Interest
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Documentry</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Reviewer's info:</h6>
                <a class="collapse-item" href="#">Stories in the field(s)</a>
                <a class="collapse-item" href="#">Edit Story</a>
                <a class="collapse-item" href="#">Add teams</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Archives:</h6>
                <a class="collapse-item" href="#">View your Reviews</a>
            </div>
        </div>
    </li> -->

    <!-- Nav Item - Charts -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="<?= PROOT ?>admin/reviewers/components/interest_papers.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Interest Review Papers</span></a>
    </li> -->

    <!-- Nav Item - Tables -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-table"></i>
            <span>Users and Logs</span></a>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <!-- <div class="sidebar-card">
         <p class="text-center mb-2"><strong>ResGate-UTG</strong> is a platform for researchers within UTG and those outside the domain!</p>
     </div> -->

</ul>
<!-- End of Sidebar -->