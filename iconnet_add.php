<?php
if(isset($_GET['pid'])) {
    $project_id = $_GET['pid'];
} 
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
                <li><span>Tambah Iconnet</span></li>
            </ol>
    
            <a class="sidebar-right-toggle" href="javascript:history.back()"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>


    <!-- start: page -->
    <div class="row">

        <section class="panel panel-featured panel-featured-primary">	
        <form  class="form-horizontal mb-lg" action="_manage_iconnet.php" method="post">			
        <div class="panel-body">
            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : null ?>">

            <div class="form-group">
                <label class="col-sm-3 control-label">Periode</label>
                <div class="col-sm-9">
                    <input type="text" name="periode" class="form-control" value="<?php echo isset($periode) ? $periode : '' ?>" placeholder="Periode (Contoh : JANUARI 2024)..." required="" >
                </div>
            </div>            
            <div class="form-group">
                <label class="col-sm-3 control-label">Sektor</label>
                <div class="col-sm-9">
                    <input type="text" name="sektor" class="form-control" value="<?php echo isset($sektor) ? $sektor : '' ?>" placeholder="Sektor/Area..." required="" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Jumlah PA</label>
                <div class="col-sm-9">
                    <input type="text" name="PA" class="form-control" value="<?php echo isset($PA) ? $PA : '' ?>" placeholder="Jumlah Aktivasi (PA)..." required="" >
                </div>
            </div>
            <div class="form-group">
                    <label class="col-sm-3 control-label">Tagihan</label>
                    <div class="col-sm-9">
                        <input type="number" name="tagihan" class="form-control" value="<?php echo isset($tagihan) ? $tagihan : '' ?>" placeholder="Jumlah tagihan..." required="" >
                    </div>
             </div>
             <div class="form-group">
                    <label class="col-sm-3 control-label">Status Pekerjaan</label>
                    <div class="col-sm-9">
                        <select class="form-control input-sm mb-md" name="status">
                            <option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Pending</option>
                            <option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>On-Progress</option>
                            <option value="2" <?php echo isset($status) && $status == 2 ? 'selected' : '' ?>>Complete</option>
                        </select>
                    </div>
             </div>
             <div class="form-group">
                    <label class="col-sm-3 control-label">Status Pembayaran</label>
                    <div class="col-sm-9">
                        <select class="form-control input-sm mb-md" name="payment">
                            <option value="0" <?php echo isset($payment) && $payment == 0 ? 'selected' : '' ?>>Belum Ditagih</option>
                            <option value="1" <?php echo isset($payment) && $payment == 1 ? 'selected' : '' ?>>Proses Penagihan</option>
                            <option value="2" <?php echo isset($payment) && $payment == 2 ? 'selected' : '' ?>>Sudah Terbayar</option>
                        </select>
                    </div>
             </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary" value="submit" type="submit" >Submit</button>
                    <button class="btn btn-default" onclick="location.href='index.php?page=Iconnet'">Cancel</button>
                </div>
            </div>
        </footer>
        </form>
        </section>
        
    </div>

    <!-- end: page -->
</section>


