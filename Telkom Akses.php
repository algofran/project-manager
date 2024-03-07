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
                <li><span>Projects TA</span></li>
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
               
                <a href="./index.php?page=telkomakses&tahun=true"><button type="button" class="mb-xs mt-xs mr-xs btn btn-primary">Tahun Ini</button></a>
                <a href="./index.php?page=telkomakses"><button type="button" class="mb-xs mt-xs mr-xs btn btn-danger">Tagihan Aktif</button></a>
             
                </div>
                <DIV class="col-md-6">
                <?php if($_SESSION['type'] != "Staff"): ?>
                <div class="col-md-6 col-md-offset-6">
                <a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=telkomakses_add"><i class="fa fa-plus"></i> Tambah Tagihan</a>
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
                        <col width="15%">
                        <col width="15%">                        
                        <col width="15%">
                        <col width="15%">
                        <col width="15%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
					<tr>
						<th class="text-center">#</th>
						<th>Periode</th>
						<th class="text-center">Keterangan</th>
                        <th class="text-center">Jumlah WO</th>
                        <th class="text-center">Target</th>
                        <th class="text-center">Tagihan</th>
						<th class="text-center">Status</th>
						<th class="text-center">Pembayaran</th>
						<th class="text-center">Action</th>
					</tr>
				    </thead>
                    
                    <tbody>
					<?php
					$i = 1;
					$stat = array("Pending","On-Progress","Complete");
					$pay = array("Belum Ditagih","Sudah Ditagih","Sudah Terbayar");
                    //$bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                    if(isset($_GET['tahun'])){
                        $qry = $conn->query("SELECT * FROM tbl_telkomakses where periode like concat('%',year(now())) order by id desc");
                    } else {
					    $qry = $conn->query("SELECT * FROM tbl_telkomakses where payment < 2 order by id desc");
                    }
                    
                    while($row= $qry->fetch_assoc()): 
                    $prog= 0;
                    $prog = ($row['PA']/300) * 100;
                    $prog = $prog > 0 ?  number_format($prog) : $prog;
                    ?>
					<tr id="<?php echo $row['id'] ?>">
						<th class="text-center"><?php echo $i++ ?></th>
						<td>
							<p><?php echo ucwords($row['periode']) ?></p>
                            
						</td>
						
						<td class="center"><?php echo $row['keterangan'] ?></td>
                        <td class="center"><?php echo $row['PA'] ?></td>
                        <td>
                            <div class="progress progress-md progress-half-rounded m-none mt-xs dark">
                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prog ?>%;">
                                    <?php echo $prog ?> %
                                </div>
                            </div>
                        </td>
                        <td class="center">Rp. <?php echo number_format($row['tagihan'],0,',','.') ?></td>
						<td class="text-center">
							<?php
							  if($row['status'] =='0'){
							  	echo "<span class='label label-default'>{$stat[$row['status']]}</span>";
							  }elseif($row['status'] =='1'){
							  	echo "<span class='label label-primary'>{$stat[$row['status']]}</span>";
							  }elseif($row['status'] =='2'){
							  	echo "<span class='label label-danger'>{$stat[$row['status']]}</span>";
							  }
							?>
						</td>
						<td class="text-center">
							<?php
							  if($pay[$row['payment']] =='Belum Ditagih'){
							  	echo "<span class='label label-info'>{$pay[$row['payment']]}</span>";
							  }elseif($pay[$row['payment']] =='Sudah Ditagih'){
							  	echo "<span class='label label-primary'>{$pay[$row['payment']]}</span>";
							  }elseif($pay[$row['payment']] =='Sudah Terbayar'){
							  	echo "<span class='label label-success'>{$pay[$row['payment']]}</span>";
							  }
							?>
                            
						</td>
						<td class="center actions-hover actions-fade">
                            <a href="./index.php?page=telkomakses_detail&pid=<?php echo $row['id'] ?>"><i class="fa fa-search"></i></a>
                            <a href="./index.php?page=telkomakses_edit&id=<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></a>
                            <a href="./telkomakses_del.php?id=<?php echo $row['id'] ?>&periode=<?php echo $row['periode'] ?>" onclick="return confirm('Are you sure want to delete this project?')"><i class="fa fa-trash-o remove"></i></a>
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


