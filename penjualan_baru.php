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
                <li><span>Penjualan</span></li>
            </ol>
    
            <a class="sidebar-right-toggle" href="javascript:history.back()"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>


    <!-- start: page -->
    <div class="row">

        <section class="panel panel-featured panel-featured-primary">	
        <form  class="form-horizontal mb-lg" action="_manage_sales.php" method="post">			
        <div class="panel-body">
        <input type="hidden" name="idsales" value="<?php echo isset($idsales) ? $idsales : null ?>">
        <div class="form-group">  
            <label class="col-sm-3 control-label">Tanggal</label>
                <div class="col-sm-9">              
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <input type="text" name="tgl" data-plugin-datepicker="" data-date-format="yyyy-mm-dd" class="form-control" value="<?php echo isset($tgl) ? date("Y-m-d",strtotime($tgl)) : '' ?>"></input>
                    </div>
                </div>
            </div>
                    
        <div class="form-group">
                <label class="col-sm-3 control-label">Nama Pembeli/Customer</label>
                <div class="col-sm-9">
                    <input type="text" name="pembeli" class="form-control" value="<?php echo isset($pembeli) ? $pembeli : '' ?>" placeholder="Nama Pembeli..." required="" >
                </div>
            </div>

        <div class="form-group">
                <label class="col-sm-3 control-label">Keterangan</label>
                <div class="col-sm-9">
                    <textarea rows="5" name="keterangan" class="form-control" placeholder="keterangan..." required=""><?php echo isset($keterangan) ? $keterangan : '' ?></textarea>
                </div>
            </div>

        <div class="form-group">
                <label class="col-sm-3 control-label">Harga Pembelian</label>
                <div class="col-sm-9">
                    <input type="number" name="beli" class="form-control" value="<?php echo isset($beli) ? $beli : '' ?>" placeholder="Biaya Pembelian..." required="" >
                </div>
            </div>
        
        <div class="form-group">
                <label class="col-sm-3 control-label">Harga Penjualan</label>
                <div class="col-sm-9">
                    <input type="number" name="jual" class="form-control" value="<?php echo isset($jual) ? $jual : '' ?>" placeholder="Harga Penjualan..." required="" >
                </div>
            </div>

        <div class="form-group">
                <label class="col-sm-3 control-label">Nama Pengguna</label>
                <div class="col-sm-9">
                    <select class="form-control input-sm mb-md" name="user">
                        <option></option>
                        <?php 
                        $employees = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where type>0 order by concat(firstname,' ',lastname) asc ");
                        while($row= $employees->fetch_assoc()):
                        ?>
                        <option value="<?php echo $row['id'] ?>" <?php echo isset($user) && $user == $row['id'] ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Status Pembayaran</label>
                <div class="col-sm-9">
                    <select class="form-control input-sm mb-md" name="status">
                        <option value="0"<?php echo isset($status) && $status == 0 ? 'selected' : '' ?> >Belum Terbayar</option>
                        <option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Sudah Terbayar</option>
                        
                    </select>
                </div>
            </div>
        </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary" value="submit" type="submit" >Submit</button>
                        <button class="btn btn-default" onclick="location.href='index.php?page=penjualan'">Cancel</button>
                    </div>
                </div>
            </footer>

        </section>
        </form>
    </div>

    <!-- end: page -->
</section>


