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

<?php
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment;Filename=hasil.xls");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');
?>

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
		$tasks = $conn->query("SELECT p.*,concat(u.firstname,' ',u.lastname) as uname FROM user_productivity p left join users u on u.id = p.user_id where p.project_id = {$id} order by p.date asc");
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