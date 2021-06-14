<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-uppercase">activity dashboard</h1>
    </div>

    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">RESEARCHER'S QUICK SETTINGS</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!-- <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <!-- <div class="dropdown-header">Make an action:</div>
                        <a class="dropdown-item" href="select_to_reviewer.php?details_select=<?= $rev_user['id']; ?>">Add to review List</a>
                        <a class="dropdown-item" href="#"></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Leave a message to the resescher</a> -->
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?= PROOT ?>admin/img/undraw_profile.svg" alt="">
                </div>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="text-xs font-weight-bold text-primary text-uppercase mb-0">publications</h1>
                        <a href="<?= PROOT ?>admin/researcher/components/publications-list.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-sm text-white-50"></i>View Details</a>
                    </div>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="text-xs font-weight-bold text-success text-uppercase mb-0">Upload Your Research Description</h1>
                        <a href="<?= PROOT ?>admin/researcher/components/res-desc.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-sm text-white-50"></i>Upload Now</a>
                    </div>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="text-xs font-weight-bold text-info text-uppercase mb-0">collaborations on research</h1>
                        <a href="<?= PROOT ?>admin/researcher/components/choose.php" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-sm text-white-50"></i>Learn more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                publications</div>
                            <a href="#" class="h5 mb-0 font-weight-bold text-gray-800">views coming soon</a>
                        </div>
                        <!-- <div class="col-auto">
                            <a href="#"><i class="fas fa-calendar fa-2x text-gray-300"></i></a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                research topics</div>
                            <a href="#" class="h5 mb-0 font-weight-bold text-gray-800"><?= $topic_counts ?> Topics</a>
                        </div>
                        <!-- <div class="col-auto">
                            <a href="#"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Tasks Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Reviewers to your papers
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $rev_counts ?> Show Interest </div>
                                </div>
                                <!-- <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <!-- <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <!-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>