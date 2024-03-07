<?php
include 'db_connect.php';
$stat = array("Pending","On-Progress","On-Hold","Complete","Finish");
$pay = array("Belum Ditagih","Sudah Ditagih","Sudah Terbayar");

$qry = $conn->query("SELECT * FROM project_list where id = ".$_GET['pid'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}


$tprog = $conn->query("SELECT * FROM task_list where project_id = {$id}")->num_rows;
$cprog = $conn->query("SELECT * FROM task_list where project_id = {$id} and status = 3")->num_rows;
$prog = $tprog > 0 ? ($cprog/$tprog) * 100 : 0;
$prog = $prog > 0 ?  number_format($prog) : $prog;
$prod = $conn->query("SELECT * FROM user_productivity where project_id = {$pid}")->num_rows;


if($status <> 3 && strtotime(date('Y-m-d')) > strtotime($end_date)):
$over = true;
endif;

$manager = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where id = $manager_id");
$manager = $manager->num_rows > 0 ? $manager->fetch_array() : array();
?>


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
    <!-- Project Detail -->
    <div class="row">
    <section class="panel panel-featured panel-featured-primary">				
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">							
                    <dl>
                        <dt><b class="border-bottom border-primary">Project Name</b></dt>
                        <dd><p class="text-primary text-bold"><?php echo ucwords($name) ?></p></dd>
                    </dl>
                </div>
                <div class="col-md-3">
                <dl>
                        <dt><b class="border-bottom border-primary">Tanggal Mulai</b></dt>
                        <dd><?php echo date("d M Y",strtotime($start_date)) ?></dd>
                    </dl>
                </div>
                <div class="col-md-3">
                <dl>
                        <dt><b class="border-bottom border-primary">Tanggal Berakhir</b></dt>
                        <dd><?php echo date("d M Y",strtotime($end_date)) ?></dd>
                    </dl>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <dl>
                        <dt><b class="border-bottom border-primary">No. PO/Kontrak</b></dt>
                        <dd><?php echo ucwords($po_number) ?><dd>
                    </dl>
                </div>
                
                <div class="col-md-3">
                <dl>
                        <dt><b class="border-bottom border-primary">Project Status</b></dt>
                        <dd>
                        <?php
							  if($stat[$status] =='Pending'){
							  	echo "<span class='label label-default'>{$stat[$status]}</span>";
							  }elseif($stat[$status] =='On-Progress'){
							  	echo "<span class='label label-primary'>{$stat[$status]}</span>";
							  }elseif($stat[$status] =='On-Hold'){
							  	echo "<span class='label label-warning'>{$stat[$status]}</span>";
							  }elseif($stat[$status] =='Complete'){
							  	echo "<span class='label label-success'>{$stat[$status]}</span>";
							  }elseif($stat[$status] =='Finish'){
							  	echo "<span class='label label-danger'>{$stat[$status]}</span>";
							  }
							?>
                        </dd>
                    </dl>
                </div>
                <div class="col-md-3">
                <dl>
                        <dt><b class="border-bottom border-primary">Status Pembayaran</b></dt>
                        <dd>
                        <?php
							  if($pay[$payment_status] =='Belum Ditagih'){
							  	echo "<span class='label label-info'>{$pay[$payment_status]}</span>";
							  }elseif($pay[$payment_status] =='Sudah Ditagih'){
							  	echo "<span class='label label-primary'>{$pay[$payment_status]}</span>";
							  }elseif($pay[$payment_status] =='Sudah Terbayar'){
							  	echo "<span class='label label-success'>{$pay[$payment_status]}</span>";
							  }
							?>
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                <dl>
                        <dt><b class="border-bottom border-primary">Keterangan</b></dt>
                        <dd><?php echo html_entity_decode($description) ?></dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                        <dl>
                            <dt><b class="border-bottom border-primary">Project Progress</b></dt>
                            <dd>
                                <div class="progress progress-striped m-md">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prog ?>%;">
                                        <?php echo $prog ?> %
                                    </div>
                                </div>
                            </dd>
                        </dl>
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-md-6">
                    <dl>
                        <dt><b class="border-bottom border-primary">Project Manager</b></dt>
                        <dd>
                        
                        <img src="assets/uploads/<?php echo $manager['avatar'] ?>" alt="Avatar" class="img-circle" width="75" height="75">
                        <br><?php echo ucwords($manager['name']) ?>
						
                        </dd>
                    </dl>
                    </div>
                    <div class="col-md-6">
                        <div class="row"><div class="col-md-12"><dl>
                        <dt><b class="border-bottom border-primary">Pendapatan Project</b></dt>
                        <dd><?php echo "Rp. " . number_format($payment,0,',','.') ?></dd>
                    </dl></div></div>
                        <div class="row"><div class="col-md-12"><dl>
                        <dt><b class="border-bottom border-primary">Pengeluran Project</b></dt>
                        <?php $exp = $conn->query("SELECT sum(cost) as costs from user_productivity where project_id=".$id)->fetch_object()->costs ?>
                        <dd><?php echo "Rp. " . number_format($exp,0,',','.') ?></dd>
                    </dl></div></div>
                    </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    </div>

    <!-- Task List -->
    <div class="row">
        <section class="panel panel-featured panel-featured-success">	
            <header class="panel-heading">
                <div class="row">
                <DIV class="col-md-6">
                <b>Daftar Tugas :</b>
                </div>
                <DIV class="col-md-6">
                    <div class="col-md-6 col-md-offset-6">
                    <a class="btn btn-block btn-sm btn-default" href="./index.php?page=task_baru&pid=<?php echo $id ?>"><i class="fa fa-plus"></i> Tambah Tugas</a>
                </div>
                </div>
                </div>
            </header>	

            <div class="panel-body">
                <div class="table-responsive">
                <table class="table table-condensed m-0 table-hover">
						<colgroup>
							<col width="5%">
							<col width="25%">
							<col width="25%">
							<col width="10%">
							<col width="20%">
                            <col width="10%">
                            <col width="10%">
						</colgroup>
						<thead>
							<th>#</th>
							<th>Nama Pekerjaan</th>
							<th>Keterangan</th>
                            <th>Jatuh Tempo</th>
                            <th>Penanggung Jawab</th>
							<th class="text-center">Status</th>
							<th class="text-center">Action</th>
						</thead>
						<tbody>
							<?php 
							$i = 1;
							$tasks = $conn->query("SELECT t.*,concat(u.firstname,' ',u.lastname) as uname FROM task_list t left join users u on u.id = t.user_id where t.project_id = {$id} order by t.id asc");
							while($row=$tasks->fetch_assoc()):
							?>
								<tr id="<?php echo $row['id'] ?>">
			                        <td class="text-center"><?php echo $i++ ?></td>
			                        <td class=""><b><?php echo ucwords($row['task']) ?></b></td>
			                        <td class=""><p class="truncate"><?php echo strip_tags($row['description']) ?></p></td>
			                        <td class=""><?php echo date("d M Y",strtotime($end_date)) ?></td>
                                    <td class=""><?php echo ucwords($row['uname']) ?></td>
                                    <td>
			                        	<?php 
			                        	if($row['status'] == 1){
									  		echo "<span class='label label-warning'>Pending</span>";
			                        	}elseif($row['status'] == 2){
									  		echo "<span class='label label-primary'>On-Progress</span>";
			                        	}elseif($row['status'] == 3){
									  		echo "<span class='label label-success'>Done</span>";
			                        	}
			                        	?>
                             
			                        </td>
			                        <td class="center actions-hover actions-fade">
                                        
                                        <a href="./index.php?page=task_edit&tid=<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></a>
                                        <a href="./_task_del.php?id=<?php echo $row['id'] ?>&pid=<?php echo $id ?>" onclick="return confirm('Are you sure want to delete this task?')"><i class="fa fa-trash-o remove"></i></a>
                                    </td>
		                    	</tr>
							<?php 
							endwhile;
							?>
						</tbody>
					</table>
                </div>
            </div>
        </section>
       
    </div>

    <!-- activity List -->
    <div class="row">
    <section class="panel panel-featured panel-featured-danger">	
            <header class="panel-heading">
                <div class="row">
                <DIV class="col-md-6">
                <b>Daftar Pengeluaran :</b>
                </div>
                <DIV class="col-md-6">
                    <div class="col-md-6 col-md-offset-6">
                    <a class="btn btn-block btn-sm btn-default" href="./index.php?page=activity_baru&pid=<?php echo $id ?>"><i class="fa fa-plus"></i> Tambah Pengeluaran</a>
                </div>
                </div>
                </div>
            </header>	

            <div class="panel-body">
                <div class="table-responsive">
                <table class="table table-condensed m-0 table-hover">
						<colgroup>
							<col width="5%">
                            <col width="10%">
							<col width="20%">
							<col width="25%">
							<col width="20%">
                            <col width="10%">
                            <col width="5%">
						</colgroup>
						<thead>
							<th>#</th>
                            <th>Tanggal</th>
							<th>Jenis Pengeluaran</th>
							<th>Keterangan</th>
                            <th>Nama Pengguna</th>
							<th>Biaya</th>
                            <th>Action</th>
						</thead>
						<tbody>
							<?php 
							$i = 1;
							$tasks = $conn->query("SELECT p.*,concat(u.firstname,' ',u.lastname) as uname FROM user_productivity p left join users u on u.id = p.user_id where p.project_id = {$id} order by p.date desc");
							while($row=$tasks->fetch_assoc()):
							?>
								<tr id="<?php echo $row['id'] ?>">
			                        <td class="text-center"><?php echo $i++ ?></td>
                                    <td class=""><?php echo date("d M Y",strtotime($row['date'])) ?></td>
			                        <td class=""><b><?php echo ucwords($row['subject']) ?></b></td>
			                        <td class=""><p class="truncate"><?php echo strip_tags($row['comment']) ?></p></td>
                                    <td class=""><?php echo ucwords($row['uname']) ?></td>
                                    <td class=""><?php echo "Rp. " . number_format($row['cost'],0,',','.') ?></td>
			                        <td class="center actions-hover actions-fade">
                                        
                                        <a href="./index.php?page=activity_edit&id=<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></a>
                                        <a href="./_activity_del.php?id=<?php echo $row['id'] ?>&pid=<?php echo $id ?>" onclick="return confirm('Are you sure want to delete this task?')"><i class="fa fa-trash-o remove"></i></a>
                                    </td>
		                    	</tr>
							<?php 
							endwhile;
							?>
						</tbody>
					</table>
                </div>
            </div>
        </section>
    </div>
    <!-- end: page -->
</section>


