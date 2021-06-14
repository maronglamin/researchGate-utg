 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
         <!-- <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div> -->
         <div class="sidebar-brand-text mx-3">ResGate-UTG Administrator</sup></div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item active">
         <a class="nav-link" href="<?= PROOT ?>admin/publisher/dashboard/index.php">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Dashboard</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Access control level
     </div>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
             <i class="fas fa-fw fa-cog"></i>
             <span>User levels</span>
         </a>
         <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">catergories to ResGate:</h6>
                 <a class="collapse-item" href="<?= PROOT ?>admin/publisher/components/rev_view.php">Reviewers</a>
                 <a class="collapse-item" href="<?= PROOT ?>admin/publisher/components/res_view.php">Researchers</a>
             </div>
         </div>
     </li>

     <!-- Nav Item - Utilities Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
             <i class="fas fa-fw fa-wrench"></i>
             <span>Quick Actions</span>
         </a>
         <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Act on ResGate USERS:</h6>
                 <a class="collapse-item" href="<?= PROOT ?>admin/publisher/components/assig_rev_topic.php">Assign reviewers</a>
                 <a class="collapse-item" href="ongoing_res.php">Ongoing Research</a>
                 <a class="collapse-item" href="publish-paper.php">Publish Research Paper</a>
             </div>
         </div>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">
     <!-- Heading -->
     <!-- <div class="sidebar-heading">
         User Logs
     </div> -->
     <!-- Nav Item - Pages Collapse Menu -->
     <!-- <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
             <i class="fas fa-fw fa-folder"></i>
             <span>Documentations</span>
         </a>
         <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Reviewers:</h6>
                 <a class="collapse-item" href="#">Stories in the field(s)</a>
                 <a class="collapse-item" href="#">Resume</a>
                 <div class="collapse-divider"></div>
                 <h6 class="collapse-header">Researchers:</h6>
                 <a class="collapse-item" href="#">Reviewed Publication</a>
                 <a class="collapse-item" href="<?= PROOT ?>admin/publisher/components/res-permit.php">Permitted Researchers</a>
             </div>
         </div>
     </li> -->

     <!-- Nav Item - Charts -->
     <!-- <li class="nav-item">
         <a class="nav-link" href="#">
             <i class="fas fa-fw fa-chart-area"></i>
             <span>Satistics</span></a>
     </li> -->

     <!-- Nav Item - Tables -->
     <li class="nav-item">
         <a class="nav-link" href="<?= PROOT ?>admin/publisher/components/user-permision.php">
             <i class="fas fa-fw fa-table"></i>
             <span>User Permissions</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

     <!-- Sidebar Message -->
     <div class="sidebar-card">
         <p class="text-center mb-2"><strong>ResGate-UTG</strong> is a platform for researchers within UTG and those outside the domain!</p>
     </div>

 </ul>
 <!-- End of Sidebar -->