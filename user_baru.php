<section role="main" class="content-body">
    <header class="page-header">
        <h2>
            <?php 
                if ($title == "Home") {
                    echo "Dashboard" ;
                  } else {
                    echo $title;
                  }
            ?>
        </h2>
    
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.php?page=home">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Users</span></li>
            </ol>
    
            <a class="sidebar-right-toggle" href="javascript:history.back()"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>


    <!-- start: page -->
    <div class="row">

        <section class="panel panel-featured panel-featured-primary">	
        <form  class="form-horizontal mb-lg" action="_manage_user.php" method="post">				
        <div class="panel-body">
            <div class="row">
            <div class="col-md-6" border-right>
                <?php if (isset($id)){
                    echo '<input type="hidden" name="id" value='.$id.'>';
                }
                ?>
                
                <div class="form-group">
                    <label class="col-sm-4 control-label">First Name</label>
                    <div class="col-sm-8">
                        <input type="text" name="firstname" class="form-control input=sm" value="<?php echo isset($firstname) ? $firstname : '' ?>" required="" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Last Name</label>
                    <div class="col-sm-8">
                        <input type="text" name="lastname" class="form-control input=sm" value="<?php echo isset($lastname) ? $lastname : '' ?>" required="" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">User Authority</label>
                    <div class="col-sm-8">
                    <select class="form-control input-sm mb-md" name="type">
                        <option value="0" <?php echo isset($type) && $type == 0 ? 'selected' : '' ?>>Administrator</option>
                        <option value="1" <?php echo isset($type) && $type == 1 ? 'selected' : '' ?>>Manager</option>
                        <option value="2" <?php echo isset($type) && $type == 2 ? 'selected' : '' ?>>Employee Staff</option>
                        
                    </select>
                </div>
            
            </div>

            </div>

            <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-4 control-label">Username</label>
                <div class="col-sm-8">
                    <input type="text" name="username" class="form-control input=sm" value="<?php echo isset($username) ? $username : '' ?>" required="" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Password</label>
                <div class="col-sm-8">
                    <input type="password" name="password" class="form-control input=sm" value="" placeholder="Password..." <?php echo !isset($id) ? 'required' : '' ?> >
                    <small><i><?php echo isset($id) ? "Leave this blank if you dont want to change you password":'' ?></i></small>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Konfirmasi</label>
                <div class="col-sm-8">
                    <input type="password" name="cpass" class="form-control input=sm" value="" placeholder="Konfirmasi Password..." <?php echo !isset($id) ? 'required' : '' ?> >
                </div>
            </div>

        </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="submit" value="submit" class="btn btn-primary">Submit</button>
                    <button onclick="location.href='index.php?page=users_list'" class="btn btn-default">Cancel</button>
                </div>
            </div>
        </footer>
        </form>
        </section>

    </div>

    <!-- end: page -->
</section>


