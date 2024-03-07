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
                <li><span>Projects</span></li>
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
               
                <a href="./index.php?page=project_active"><button type="button" class="mb-xs mt-xs mr-xs btn btn-primary">Active</button></a>
                <a href="./index.php?page=project_onhold&status=2"><button type="button" class="mb-xs mt-xs mr-xs btn btn-warning">On-Hold</button></a>
                <a href="./index.php?page=project_complete&status=3"><button type="button" class="mb-xs mt-xs mr-xs btn btn-success">Complete</button></a>
                <a href="./index.php?page=project_finish&status=4"><button type="button" class="mb-xs mt-xs mr-xs btn btn-danger">Finish</button></a>
                
                </div>
                <DIV class="col-md-6">
                <?php if($_SESSION['type'] != "Staff"): ?>
                <div class="col-md-6 col-md-offset-6">
                <a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=project_baru"><i class="fa fa-plus"></i> Add New project</a>
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
                        <col width="40%">
                        <col width="15%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
					<tr>
						<th class="text-center">#</th>
						<th>Project</th>
						<th class="text-center">No.Kontrak/PO</th>
                        <th class="text-center">Progress</th>
						<th class="text-center">Status</th>
						<th class="text-center">Pembayaran</th>
						<th class="text-center">Action</th>
					</tr>
				    </thead>
                    
                    <tbody>
					<?php
					$i = 1;
					$stat = array("Pending","On-Progress","On-Hold","Complete","Finish");
					$pay = array("Belum Ditagih","Sudah Ditagih","Sudah Terbayar");
                    $tag=array("","PT. PLN (PERSERO)","PT. INDONESIA COMNET PLUS","TELKOM AKSES","RSWS/PEMDA/LAIN2");
                    $vendor_tag=array("","PT. VISDAT TEKNIK UTAMA","PT. CORDOVA BERKAH NUSATAMA","CV. VISDAT TEKNIK UTAMA","CV. VISUAL DATA KOMPUTER");

                    if(isset($_GET['status'])){
                        $qry = $conn->query("SELECT * FROM project_list where status = ".$_GET['status']." order by end_date desc");
                    } else {
					    $qry = $conn->query("SELECT * FROM project_list where year(end_date)=year(now()) order by end_date desc");
                    }
                    
                    while($row= $qry->fetch_assoc()):
                    $prog= 0;
                    $tprog = $conn->query("SELECT * FROM task_list where project_id = {$row['id']}")->num_rows;
                    $cprog = $conn->query("SELECT * FROM task_list where project_id = {$row['id']} and status = 3")->num_rows;
                    $prog = $tprog > 0 ? ($cprog/$tprog) * 100 : 0;
                    $prog = $prog > 0 ?  number_format($prog,2) : $prog;
					?>
					<tr id="<?php echo $row['id'] ?>">
						<th class="text-center"><?php echo $i++ ?></th>
						<td>
							<p><?php echo ucwords($row['name']) ?></p>
                            
                            <p class="truncate text-danger"><?php echo $tag[$row['pembayaran']] ?></p>
                            <p class="truncate text-info"><?php echo $vendor_tag[$row['vendor']] ?></p>
						</td>
						
						<td class="center"><?php echo $row['po_number'] ?></td>
                        <td>
                            <div class="progress progress-md progress-half-rounded m-none mt-xs dark">
                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prog ?>%;">
                                    <?php echo $prog ?> %
                                </div>
                            </div>
                        </td>
						<td class="text-center">
							<?php
							  if($stat[$row['status']] =='Pending'){
							  	echo "<span class='label label-default'>{$stat[$row['status']]}</span>";
							  }elseif($stat[$row['status']] =='On-Progress'){
							  	echo "<span class='label label-primary'>{$stat[$row['status']]}</span>";
							  }elseif($stat[$row['status']] =='On-Hold'){
							  	echo "<span class='label label-warning'>{$stat[$row['status']]}</span>";
							  }elseif($stat[$row['status']] =='Complete'){
							  	echo "<span class='label label-success'>{$stat[$row['status']]}</span>";
							  }elseif($stat[$row['status']] =='Finish'){
							  	echo "<span class='label label-danger'>{$stat[$row['status']]}</span>";
							  }
							?>
						</td>
						<td class="text-center">
							<?php
							  if($pay[$row['payment_status']] =='Belum Ditagih'){
							  	echo "<span class='label label-info'>{$pay[$row['payment_status']]}</span>";
							  }elseif($pay[$row['payment_status']] =='Sudah Ditagih'){
							  	echo "<span class='label label-primary'>{$pay[$row['payment_status']]}</span>";
							  }elseif($pay[$row['payment_status']] =='Sudah Terbayar'){
							  	echo "<span class='label label-success'>{$pay[$row['payment_status']]}</span>";
							  }
							?>
                            
						</td>
						<td class="center actions-hover actions-fade">
                            <a href="./index.php?page=project_detail&pid=<?php echo $row['id'] ?>"><i class="fa fa-search"></i></a>
                            <a href="./index.php?page=project_edit&id=<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></a>
                            <a href="./_project_del.php?id=<?php echo $row['id'] ?>&status=<?php echo $row['status'] ?>" onclick="return confirm('Are you sure want to delete this project?')"><i class="fa fa-trash-o remove"></i></a>
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


