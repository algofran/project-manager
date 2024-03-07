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
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <form action="_manage_project.php" method="post">  
                <div class="panel-body">
                    <!-- baris 1 -->
                    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : null ?>">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <div class="form-group">
                                <label class="control-label text-bold">Nama Project</label>
                                <input type="text" class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>">
                            </div>
                        </div>
                        <div class="col-md-3 form-group">
                            <div class="form-group">
                                <label class="control-label text-bold">Project Owner</label>
                                <select class="form-control mb-md" name="pembayaran">
                                    <option value="1" <?php echo isset($pembayaran) && $pembayaran == 1 ? 'selected' : '' ?>>PT. PLN (PERSERO)</option>
                                    <option value="2" <?php echo isset($pembayaran) && $pembayaran == 2 ? 'selected' : '' ?>>PT. INDONESIA COMMNENTS PLUS</option>
                                    <option value="3" <?php echo isset($pembayaran) && $pembayaran == 3 ? 'selected' : '' ?>>PT. TELKOM AKSES</option>
                                    <option value="4" <?php echo isset($pembayaran) && $pembayaran == 4 ? 'selected' : '' ?>>LAIN2</option>
                                </select>

                            </div>
                        </div>

                        <div class="col-md-3 form-group">
                            <div class="form-group">
                                <label class="control-label text-bold">Project Vendor</label>
                                <select class="form-control mb-md" name="vendor">
                                    <option value="1" <?php echo isset($vendor) && $vendor == 1 ? 'selected' : '' ?>>PT. VISDAT TEKNIK UTAMA</option>
                                    <option value="2" <?php echo isset($vendor) && $vendor == 2 ? 'selected' : '' ?>>PT. CORDOVA BERKAH NUSATAMA</option>
                                    <option value="3" <?php echo isset($vendor) && $vendor == 3 ? 'selected' : '' ?>>CV. VISDAT TEKNIK UTAMA</option>
                                    <option value="4" <?php echo isset($vendor) && $vendor == 4 ? 'selected' : '' ?>>CV. VISUAL DATA KOMPUTER</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <!-- baris 2 -->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <div class="form-group">
                                <label class="control-label text-bold">No.Kontrak / PO Project</label>
                                <input type="text" class="form-control" name="po_number" value="<?php echo isset($po_number) ? $po_number : '-' ?>">
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="form-group">
                                <label class="control-label text-bold">Tanggal Project</label>
                                <div class="input-daterange input-group" data-plugin-datepicker="" data-date-format="yyyy-mm-dd">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control" name="start_date" value="<?php echo isset($start_date) ? date("Y-m-d",strtotime($start_date)) : date('Y/m/d') ?>">
                                    <span class="input-group-addon">s/d</span>
                                    <input type="text" class="form-control" name="end_date" value="<?php echo isset($end_date) ? date("Y-m-d",strtotime($end_date)) : date('Y/m/d') ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- baris 3 -->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <div class="form-group">
                                <label class="control-label text-bold">Project Manager</label>
                                <select class="form-control mb-md" name="manager_id">
                                <option></option>
                                <?php 
                                $managers = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where type = 1 order by concat(firstname,' ',lastname) asc ");
                                while($row= $managers->fetch_assoc()):
                                ?>
                                <option value="<?php echo $row['id'] ?>" <?php echo isset($manager_id) && $manager_id == $row['id'] ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
                                <?php endwhile; ?>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            
                            <div class="form-group">
                                <label class="control-label text-bold">Team Members</label>
                                <select multiple data-plugin-selectTwo class="form-control populate" name="user_ids[]">
                                    <option></option>
                                    <?php 
                                    $employees = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where type > 0 order by concat(firstname,' ',lastname) asc ");
                                    while($row= $employees->fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $row['id'] ?>" <?php echo isset($user_ids) && in_array($row['id'],explode(',',$user_ids)) ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- baris 4 -->
                    <div class ="row">
                    <div class="col-md-6 form-group">
                            
                            <div class="form-group">
                                <label class="control-label text-bold">Nilai Project</label>
                                <input type="text" class="form-control" name="payment" value="<?php echo isset($payment) ? $payment : '0' ?>">
                                </div>
                            </div>  
                       
                         
                            <div class="col-md-3 form-group">
                                <div class="form-group">
                                    <label class="control-label text-bold">Payment Status</label>
                                    <select class="form-control mb-md" name="payment_status">
                                        <option value="0" <?php echo isset($payment_status) && $payment_status == 0 ? 'selected' : '' ?>>Belum Ditagih</option>
                                        <option value="1" <?php echo isset($payment_status) && $payment_status == 1 ? 'selected' : '' ?>>Sudah Ditagih</option>
                                        <option value="2" <?php echo isset($payment_status) && $payment_status == 2 ? 'selected' : '' ?>>Sudah Terbayar</option>
                                    </select>
                                    </div>
                            </div>

                            <div class="col-md-3 form-group">
                            <div class="form-group">
                                <label class="control-label text-bold">Project Status</label>
                                <select class="form-control mb-md" name="status">
                                    <option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Pending </option>
                                    <option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>On-Progress</option>
                                    <option value="2" <?php echo isset($status) && $status == 2 ? 'selected' : '' ?>>On-Hold</option>
                                    <option value="3" <?php echo isset($status) && $status == 3 ? 'selected' : '' ?>>Complete</option>
                                    <option value="4" <?php echo isset($status) && $status == 4 ? 'selected' : '' ?>>Finish</option>
                                </select>
                            </div>
                        </div>

                             </div>
                     <!-- baris 5 -->
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <div class="form-group">
                                <label class="control-label text-bold">No.Invoice</label>
                                <input type="text" class="form-control" name="invoice" value="<?php echo isset($invoice) ? $invoice : '-' ?>">
                            </div>
                        </div>
                        <div class="col-md-3 form-group">
                            <div class="form-group">
                                <label class="control-label text-bold">Tgl.Invoice</label>
                                <div class="input-group">
                                    <input type="text" name="inv_date" data-date-format="yyyy-mm-dd" data-plugin-datepicker="" class="form-control" value="<?php echo isset($inv_date) ? date("Y-m-d",strtotime($inv_date)) : date('Y/m/d') ?>"></input>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-3 form-group">
                            
                            <div class="form-group">
                                <label class="control-label text-bold">No.Faktur Pajak</label>
                                <input type="text" class="form-control" name="fakturpajak" value="<?php echo isset($fakturpajak) ? $fakturpajak : '-' ?>">
                            </div>
                        </div>
                        <div class="col-md-3 form-group">
                            <div class="form-group">
                                <label class="control-label text-bold">Tgl. Faktur Pajak</label>
                                <div class="input-group">
                                    <input type="text" name="fp_date" data-date-format="yyyy-mm-dd" data-plugin-datepicker="" class="form-control" value="<?php echo isset($fp_date) ? date("Y-m-d",strtotime($fp_date)) : date('Y/m/d') ?>"></input>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <!-- baris 6 -->
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label text-bold">Keterangan</label>
                            <textarea class="form-control" rows="3" name="description" id="textareaAutosize" data-plugin-textarea-autosize="" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 114px;"><?php echo isset($description) ? $description : '-' ?></textarea>
                                
                        </div>
                        </div>
                    </div>
                    <!-- end of baris -->
                </div>
                
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-9 col-md-offset-5">
                            <button class="btn btn-primary" type="submit" value="submit">Submit</button>
                            <button class="btn btn-default" type="Button" onclick="location.href='index.php?page=project_baru'">Reset</button>
                            
                        </div>
                    </div>
                </div>
                </form>
            </section>
        </div>	
    </div>				
    <!-- end: page -->
</section>


