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
                <li><span>Penjualan</span></li>
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
                
                <div class="col-md-6 col-md-offset-6">
                <a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=penjualan_baru"><i class="fa fa-plus"></i> Tambah Penjualan</a>
                </div>
                
                </div>
            </div>
        </header>
							
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover mb-none" id="datatable-default">
                    <colgroup>
                        <col width="5%">
                        <col width="10%">
                        <col width="20%">
                        <col width="25%">
                        <col width="20%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Tanggal</th>
						<th>Pembeli</th>
                        <th>Keterangan</th>
						<th class="text-right">Jumlah</th>
						<th class="text-center">Status</th>
						<th class="text-center">Action</th>
					</tr>
				    </thead>
                    
                    <tbody>
					<?php
					$i = 1;
					$pay = array("Belum Bayar","Sudah Terbayar");

                    $qry = $conn->query("SELECT * FROM sales order by tgl desc");

                    while($row= $qry->fetch_assoc()):

					?>
					<tr id="<?php echo $row['idsales'] ?>">
						<th class="text-center"><?php echo $i++ ?></th>						
						<td class="center"><?php echo date("d-m-Y",strtotime($row['tgl'])) ?></td>
                        <td><?php echo $row['pembeli'] ?></td>
                        <td><?php echo $row['keterangan'] ?></td>
                        <td class="text-right">Rp. <?php echo number_format($row['jual'],0,',','.') ?></td>
						<td class="text-center">
							<?php
							  if($pay[$row['status']] =='Belum Bayar'){
							  	echo "<span class='label label-danger'>{$pay[$row['status']]}</span>";
							  }else{
							  	echo "<span class='label label-success'>{$pay[$row['status']]}</span>";
							  }
							?>
						</td>
						<td class="center actions-hover actions-fade">
                            
                            <a href="./index.php?page=penjualan_edit&id=<?php echo $row['idsales'] ?>"><i class="fa fa-edit"></i></a>
                            <a href="./_sales_del.php?id=<?php echo $row['idsales'] ?>" onclick="return confirm('Are you sure want to delete this record?')"><i class="fa fa-trash-o remove"></i></a>
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


