<header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

    <div class="container">
        <div class="d-flex align-items-center">
            <div class="site-logo">
                <a href="<?PROOT?>admin/publisher/index.php" class="d-block">
                    <img src="<?= PROOT ?>images/logo.jpg" alt="Image" class="img-fluid">
                </a>
            </div>
            <div class="mr-auto">
                <nav class="site-navigation position-relative text-right" role="navigation">
                    <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                        <li class="active">
                            <a href="<?= PROOT ?>index.php" class="nav-link text-left">Home</a>
                        </li>
                        <li>
                            <a href="<?= PROOT ?>views/components/publications.php" class="nav-link text-left">Publications</a>
                        </li>
                        <li class="has-children">
                            <a href="about.html" class="nav-link text-left">Categories</a>
                            <ul class="dropdown">
                                <li><a href="#">Natural Sciences</a></li>
                                <li><a href="#">Physical Sciences</a></li>
                                <li><a href="#">Social Sciences</a></li>
                                <li><a href="#">Others</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="nav-link text-left">Contact</a>
                        </li>
                        <li class="has-children">
                            <a href="#" class="nav-link text-left">About ResGate</a>
                            <ul class="dropdown">
                                <li><a href="#">Our publication Rules</a></li>
                                <li><a href="#">Our reviewer's stories</a></li>
                            </ul>
                        </li>
                    </ul>
                    </ul>
                </nav>

            </div>
            <div class="ml-auto">
                <div class="social-wrap">
                    <a href="#"><span class="icon-facebook"></span></a>
                    <a href="#"><span class="icon-twitter"></span></a>
                    <a href="#"><span class="icon-linkedin"></span></a>

                    <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a>
                </div>
            </div>

        </div>
    </div>

</header>