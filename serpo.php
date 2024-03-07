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
               
                <a href="./index.php?page=serpo&tahun=true"><button type="button" class="mb-xs mt-xs mr-xs btn btn-primary">Tahun Ini</button></a>
                <a href="./index.php?page=serpo"><button type="button" class="mb-xs mt-xs mr-xs btn btn-danger">Tagihan Aktif</button></a>
             
                </div>
                <DIV class="col-md-6">
                <?php if($_SESSION['type'] != "Staff"): ?>
                <div class="col-md-6 col-md-offset-6">
                <a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=serpo_add"><i class="fa fa-plus"></i> Tambah Serpo</a>
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
                        <col width="20%">
                        <col width="15%">                        
                        <col width="15%">
                        <col width="15%">
                        <col width="15%">
                        <col width="10%">
                    </colgroup>
                    <thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Paket</th>
                        <th class="text-center">Periode</th>
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
                    $paket_tag=array("","Paket 2 - Serpo SBU Sulawesi & IBT 2022-2025",
                                     "Paket 3 - Serpo SBU Sulawesi & IBT 2022-2025",
                                     "Paket 7 - Serpo SBU Sulawesi & IBT 2022-2025",
                                     "Papua 1 - Serpo SBU Sulawesi & IBT 2022-2025",
                                     "Papua 2 - Serpo SBU Sulawesi & IBT 2022-2025",
                                     "Konawe - Serpo SBU Sulawesi & IBT 2022-2025");

                    //$bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                    if(isset($_GET['tahun'])){
                        $qry = $conn->query("SELECT * FROM tbl_serpo where periode like concat('%',year(now())) order by id desc");
                    } else {
					    $qry = $conn->query("SELECT * FROM tbl_serpo where payment < 2 order by id desc");
                    }
                    
                    while($row= $qry->fetch_assoc()): 
                    $prog= 0;
                    $prog = ($row['PA']/30) * 100;
                    $prog = $prog > 0 ?  number_format($prog) : $prog;
                    ?>
					<tr id="<?php echo $row['id'] ?>">
						<th class="text-center"><?php echo $i++ ?></th>
                        <td class="center"><?php echo $paket_tag[$row['paket']] ?></td>

						<td><?php echo ucwords($row['periode']) ?></td>
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
                            <a href="./index.php?page=serpo_detail&pid=<?php echo $row['id'] ?>"><i class="fa fa-search"></i></a>
                            <a href="./index.php?page=serpo_edit&id=<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></a>
                            <a href="./serpo_del.php?id=<?php echo $row['id'] ?>&periode=<?php echo $row['periode'] ?>" onclick="return confirm('Kamu yakin ingin menghapus data serpo?')"><i class="fa fa-trash-o remove"></i></a>
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


