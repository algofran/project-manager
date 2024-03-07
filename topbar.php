<header class="header">
    <div class="logo-container">
        <a href="../" class="logo">
            <img src="assets/images/logo.png" height="35" alt="" />
        </a>
        <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <!-- start: search & user box -->
    <div class="header-right">

        <form action="pages-search-results.html" class="search nav-form">
            <div class="input-group input-search">
                <input type="text" class="form-control" name="q" id="q" placeholder="Cari Project...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>

        <span class="separator"></span>


        <div id="userbox" class="userbox">
            <a href="#" data-toggle="dropdown">
                <figure class="profile-picture">
                    <img src="assets/uploads/<?php echo $_SESSION['avatar'] ?>" alt="User Avatar" class="img-circle" data-lock-picture="assets/uploads/<?php echo $_SESSION['avatar'] ?>" />
                </figure>
                <div class="profile-info" data-lock-name="Rakhmat Arief" data-lock-email="mamat@visdat.">
                    <span class="name"><?php echo $_SESSION['username'] ?></span>
                    <span class="role"><?php echo $_SESSION['type'] ?></span>
                </div>

                <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
                <ul class="list-unstyled">
                    <li class="divider"></li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="pages-user-profile.html"><i class="fa fa-user"></i> User Profile</a>
                    </li>

                    <li>
                        <a role="menuitem" tabindex="-1" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end: search & user box -->
</header>