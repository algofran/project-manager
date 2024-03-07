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
    <section class="panel panel-featured panel-featured-success">
    <header class="panel-heading">
            <div class="row">
                <DIV class="col-md-6">
                </div>
                <DIV class="col-md-6">
                <?php if($_SESSION['type'] != "Staff"): ?>
                <div class="col-md-6 col-md-offset-6">
                <a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=user_baru"><i class="fa fa-plus"></i> New User</a>
                </div>
                <?php endif; ?>
                </div>
            </div>
        </header>		
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover mb-none" id="datatable-default">
                    <colgroup>
                        <col width="5%">
                        <col width="35%">
                        <col width="30%">
                        <col width="20%">
                        <col width="10%">
                    </colgroup>
                    <thead>
					<tr>
						<th class="text-center">#</th>
						<th>Employe name</th>
						<th>Username</th>
                        <th class="text-center">Role</th>
						<th class="text-center">Action</th>
					</tr>
				    </thead>
                    
                    <tbody>
					<?php
					$i = 1;
					$role = array("Administrator","Manager","Employee/Staff");
					    $qry = $conn->query("SELECT id,concat(firstname,' ',lastname) as name,username,type FROM users order by type,firstname");
                    while($row= $qry->fetch_assoc()):
					?>
					<tr id="<?php echo $row['id'] ?>">
						<th class="text-center"><?php echo $i++ ?></th>
						<td><p><?php echo ucwords($row['name']) ?></p></td>
                        <td><p><?php echo $row['username'] ?></p></td>    
                        <td class="center"><p><?php echo $role[$row['type']] ?></p></td>
						<td class="center actions-hover actions-fade">
                            <a href="./index.php?page=user_edit&uid=<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></a>
                            <a href="./_user_del.php?id=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure want to delete this user?')"><i class="fa fa-trash-o remove"></i></a>
                        </td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
                </table>
            </div>
        </div>
    </section>
    </div>

    <!-- end: page -->
</section>


