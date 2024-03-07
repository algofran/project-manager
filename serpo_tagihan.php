
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
                <li><span>Tagihan Serpo</span></li>
            </ol>
    
            <a class="sidebar-right-toggle" href="javascript:history.back()"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>


    <!-- start: page -->
    <div class="row">

        <section class="panel panel-featured panel-featured-primary">	
        <form  class="form-horizontal mb-lg" action="_manage_tagserpo.php" method="post">			
        <div class="panel-body">
            <div class="form-group">
                  <label class="col-sm-3 control-label">Pilih Project</label>
                  <div class="col-sm-9">
                  <select class="form-control input-sm mb-md" name="project_id">
                        <option></option>
                        <?php 
                        $project = $conn->query("SELECT * FROM project_list where status < 4");
                        while($row= $project->fetch_assoc()):
                        ?>
                        <option value="<?php echo $row['id'] ?>" ><?php echo ucwords($row['name']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Nama Pekerjaan</label>
                <div class="col-sm-9">
                    <input type="text" name="task" class="form-control" value="" placeholder="Nama Pekerjaan..." required="" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Keterangan</label>
                <div class="col-sm-9">
                    <textarea rows="5" name="description" class="form-control" placeholder="Keterangan..." required=""></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Penanggung Jawab</label>
                <div class="col-sm-9">
                    <select class="form-control input-sm mb-md" name="user_id">
                        <option></option>
                        <?php 
                        $employees = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where type>0 order by concat(firstname,' ',lastname) asc ");
                        while($row= $employees->fetch_assoc()):
                        ?>
                        <option value="<?php echo $row['id'] ?>" ><?php echo ucwords($row['name']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Jadwal Pelaksanaan</label>
                <div class="col-sm-9">
                <div class="input-daterange input-group" data-plugin-datepicker="" data-date-format="yyyy-mm-dd">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    <input type="text" class="form-control" name="date_created" value="">
                    <span class="input-group-addon">s/d</span>
                    <input type="text" class="form-control" name="due_date" value="">
                </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Status</label>
                <div class="col-sm-9">
                <select class="form-control input-sm mb-md" name="status">
                    <option value="0"></option>
                    <option value="1">Belum Dikerjakan</option>
                    <option value="2">Sedang Dikerjakan</option>
                    <option value="3">Sudah Selesai</option>
                </select>
                        </div>
            </div>

        </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button class="btn btn-primary" value="submit" type="submit" >Submit</button>
                        <button class="btn btn-default" onclick="location.href='index.php'">Cancel</button>
                    </div>
                </div>
            </footer>

        </section>
        </form>
    </div>

    <!-- end: page -->
</section>


