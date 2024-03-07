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
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover mb-none" id="datatable-default">
                    <colgroup>
                        <col width="5%">
                        <col width="30%">
                        <col width="15%">
                        <col width="20%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
					<tr>
						<th class="text-center">#</th>
						<th>Project</th>
						<th class="text-center">Tgl.Berakhir</th>
                        <th class="text-center">Progress</th>
						<th class="text-center">Status</th>
						<th class="text-center">Pembayaran</th>
						<th class="text-center">Action</th>
					</tr>
				    </thead>
                    
                    <tbody>
					<?php
					$i = 1;
					$stat = array("Pending","On-Progress","On-Hold","Complete","Cancel");
					$pay = array("Belum Ditagih","Sudah Ditagih","Sudah Terbayar");
                    $tag=array("","PT. PLN (PERSERO)","PT. INDONESIA COMNET PLUS","TELKOM AKSES","");

                    if(isset($_GET['status'])){
                        $qry = $conn->query("SELECT * FROM project_list where status = ".$_GET['status']." order by end_date");
                    } else {
					    $qry = $conn->query("SELECT * FROM project_list where status = '1' and end_date > now() order by end_date");
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
						</td>
						
						<td class="center"><?php echo date("d-m-Y",strtotime($row['end_date'])) ?></td>
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
							  }elseif($stat[$row['status']] =='Cancel'){
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
                            <a href="./index.php?page=report_detail&type=<?= isset($_GET["type"])?$_GET["type"]:"false" ?>&pid=<?php echo $row['id'] ?>"><i class="fa fa-search"></i></a>
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


