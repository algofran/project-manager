<?php
include 'db_connect.php';
$stat = array("Pending","On-Progress","On-Hold","Complete","Cancel");
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

<script type="text/javascript" src="assets/vendor/sheet-js/xlsx.bundle.js"></script>

<script type="text/javascript" src="//unpkg.com/blob.js@1.0.1/Blob.js"></script>
<script type="text/javascript" src="//unpkg.com/file-saver@1.3.3/FileSaver.js"></script>


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
        <header class="panel-heading">
            <div class="row">
            <DIV class="col-md-6">
            </div>
            <DIV class="col-md-6">
                <div class="col-md-6 col-md-offset-6">
                    <!-- <a class="btn btn-block btn-sm btn-success" href="/index.php?page=report_cetak&pid=<?php echo $_GET['pid'] ?>&print=true"><i class="fa fa-file"></i> Export Excel </a> -->
                    <a class="btn btn-block btn-sm btn-success" onclick="doit('xlsx')" ><i class="fa fa-file"></i> Export Excel </a>
                </div>
            </div>
            </div>
        </header>   
    </section>
    </div>

    <!-- activity List -->
    <div class="row">
    <section class="panel panel-featured panel-featured-danger">	
            <div class="panel-body">
                <div class="table-responsive">
                <table id="data-table" class="table table-condensed m-0 table-hover">
                    <tr>
                        <td colspan="4">
                            <DIV><span style="display:inline-block;width:140px">Project ID </span>: <?= $_GET['pid'] ?></DIV>
                        </td>
                        <td colspan="3">
                            <DIV><span style="display:inline-block;width:140px">Tgl. Mulai  </span>: <?= date("d M Y",strtotime($start_date)) ?></DIV>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <DIV><span style="display:inline-block;width:140px">Project Name </span>: <?= ucwords($name) ?></DIV>
                        </td>
                        <td colspan="3">
                            <DIV><span style="display:inline-block;width:140px">Tgl. Berakhir </span>: <?= date("d M Y",strtotime($end_date)) ?></DIV>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <DIV><span style="display:inline-block;width:140px">No. PO/Kontrak </span>: <?= ucwords($po_number) ?></DIV>
                        </td>
                        <td colspan="3">  
                            <DIV><span style="display:inline-block;width:140px">Project Status</span>: <?= date("d M Y",strtotime($start_date)) ?></DIV>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <DIV><span style="display:inline-block;width:140px">Nilai Kontrak </span>: <?= ucwords($nilai) ?></DIV>
                            </td>
                        <td colspan="3">
                            <DIV><span style="display:inline-block;width:140px">Status Pembayaran</span>: <?php
                              if($pay[$payment_status] =='Belum Ditagih'){
                                echo "<span class='label label-info'>{$pay[$payment_status]}</span>";
                              }elseif($pay[$payment_status] =='Sudah Ditagih'){
                                echo "<span class='label label-primary'>{$pay[$payment_status]}</span>";
                              }elseif($pay[$payment_status] =='Sudah Terbayar'){
                                echo "<span class='label label-success'>{$pay[$payment_status]}</span>";
                              }
                            ?>
                            </DIV>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <DIV><span style="display:inline-block;width:140px">Project Manager </span>: <?= ucwords($manager['name']) ?></DIV>
                        </td>
                        <td colspan="3">
                            <DIV><span style="display:inline-block;width:140px">Nama Bank</span>:</DIV>
                        </td>
                    </tr>
                    <tr><td colspan="6"></td></tr>
						<colgroup>
							<col width="5%">
							<col width="10%">
							<col width="15%">
							<col width="40%">
                            <col width="30%">
						</colgroup>
						<tr>
							<th>#</th>
                            <th><span style="display:inline-block">Tanggal</span></th>
							<th>Jenis Aktivitas</th>
							<th>Keterangan</th>
							<th>Biaya</th>
						</tr>
						<?php 
						$i = 1;
                        $type = [
                            'ops' => 'Biaya Operasional',
                            'material' => 'Biaya Material',
                            'others' => 'Biaya Lainnya',
                            'tools' => 'Biaya Perlengkapan',
                        ];
						$tasks = $conn->query("SELECT p.*,concat(u.firstname,' ',u.lastname) as uname FROM user_productivity p left join users u on u.id = p.user_id where p.project_id = {$id} and p.subject = '{$type[$_GET["type"]]}' order by p.date asc");
						while($row=$tasks->fetch_assoc()):
						?>
							<tr id="<?php echo $row['id'] ?>">
		                        <td class="text-center"><?php echo $i++ ?></td>
                                <td class=""><?php echo date("d M Y",strtotime($row['date'])) ?></td>
		                        <td class=""><b><?php echo ucwords($row['subject']) ?></b></td>
		                        <td class=""><p class="truncate"><?php echo strip_tags($row['comment']) ?></p></td>
                                <td class=""><?php echo "Rp. " . number_format($row['cost'],0,',','.') ?></td>
	                    	</tr>
						<?php 
						endwhile;
						?>
					</table>
                </div>
            </div>
        </section>
    </div>
    <!-- end: page -->
</section>
<script>
function doit(type, fn, dl) {
    var elt = document.getElementById('data-table');
    var wb = XLSX.utils.book_new();

    /* convert table "table1" to worksheet named "Sheet1" */
    var ws = XLSX.utils.table_to_sheet(elt);
    XLSX.utils.book_append_sheet(wb, ws, "<?= $_GET["type"] ?>");


    var wscols = [
        {wch:6},
        {wch:7},
        {wch:10},
        {wch:50},
        {wch:20}
    ];

    ws['!cols'] = wscols;

    for(const el in ws){
        ws[el].s = { alignment : { vertical: "top", wrapText: false }}        
        if (el.indexOf("D") > -1) {
            console.log(el)
            ws[el].s.alignment.wrapText = true;
        }
    }
    
    return dl ?
        XLSX.write(wb, {bookType:type, bookSST:true, type: 'base64'}) :
        XLSX.writeFile(wb, fn || ('Project Expense - ' + new Date() + '.' + (type || 'xlsx')));
}
</script>
<script type="text/javascript">
function tableau(pid, iid, fmt, ofile) {
    if(typeof Downloadify !== 'undefined') Downloadify.create(pid,{
            swf: 'downloadify.swf',
            downloadImage: 'download.png',
            width: 100,
            height: 30,
            filename: ofile, data: function() { return doit(fmt, ofile, true); },
            transparent: false,
            append: false,
            dataType: 'base64',
            onComplete: function(){ alert('Your File Has Been Saved!'); },
            onCancel: function(){ alert('You have cancelled the saving of this file.'); },
            onError: function(){ alert('You must put something in the File Contents or there will be nothing to save!'); }
    }); else document.getElementById(pid).innerHTML = "";
}
</script>


