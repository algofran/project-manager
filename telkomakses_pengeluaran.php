<?php
if(isset($_GET['pid'])) {
    $ta_id = $_GET['pid'];
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
                <li><span>Pengeluaran Telkom Akses</span></li>
            </ol>
    
            <a class="sidebar-right-toggle" href="javascript:history.back()"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>


    <!-- start: page -->
    <div class="row">

        <section class="panel panel-featured panel-featured-primary">	
        <form  class="form-horizontal mb-lg" action="_exp_telkomakses.php" method="post">			
        <div class="panel-body">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : null ?>">
        <input type="hidden" name="ta_id" value="<?php echo isset($ta_id) ? $ta_id : null ?>">

            
            <div class="form-group">  
            <label class="col-sm-3 control-label">Tanggal</label>
                <div class="col-sm-9">              
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <input type="text" name="date" data-date-format="yyyy-mm-dd" data-plugin-datepicker="" class="form-control" value="<?php echo isset($date) ? date("Y-m-d",strtotime($date)) : '' ?>"></input>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Jenis Pengeluaran</label>
                <div class="col-sm-9">
                <select class="form-control mb-md" name="subject">
                        <option value="Biaya Operasional" <?php echo isset($subject) && $subject == "Biaya Operasional" ? 'selected' : '' ?>>Biaya Operasional </option>
                        <option value="Biaya Material" <?php echo isset($subject) && $subject == "Biaya Material" ? 'selected' : '' ?>>Biaya Material</option>
                        <option value="Biaya Tools" <?php echo isset($subject) && $subject == "Biaya Tools" ? 'selected' : '' ?>>Biaya Tools</option>
                        <option value="Biaya Gaji/Fee" <?php echo isset($subject) && $subject == "Biaya Gaji/Fee" ? 'selected' : '' ?>>Biaya Gaji/Fee</option>
                        <option value="Biaya Lainnya" <?php echo isset($subject) && $subject == "Biaya Lainnya" ? 'selected' : '' ?>>Biaya Lainnya</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Keterangan</label>
                <div class="col-sm-9">
                    <textarea rows="5" name="comment" class="form-control" placeholder="Keterangan..." required=""><?php echo isset($comment) ? $comment : '' ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Nama Pengguna</label>
                <div class="col-sm-9">
                    <select class="form-control input-sm mb-md" name="user_id">
                        <option></option>
                        <?php 
                        $employees = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where type>0 order by concat(firstname,' ',lastname) asc ");
                        while($row= $employees->fetch_assoc()):
                        ?>
                        <option value="<?php echo $row['id'] ?>" <?php echo isset($user_id) && $user_id == $row['id'] ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Nilai Pengeluaran</label>
                <div class="col-sm-9">
                    <input type="number" name="cost" class="form-control" value="<?php echo isset($cost) ? $cost : '' ?>" placeholder="Nilai Pengeluaran..." required="" >
                </div>
            </div>

        </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button class="btn btn-primary" value="submit" type="submit" >Submit</button>
                        <button class="btn btn-default" onclick="location.href='index.php?page=telkomakses_detail&pid=<?php echo $ta_id ?>'">Cancel</button>
                    </div>
                </div>
            </footer>

        </section>
        </form>
    </div>

    <!-- end: page -->
</section>


