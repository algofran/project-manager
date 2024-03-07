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
                <li><span>Dashboard</span></li>
            </ol>
    
            <a class="sidebar-right-toggle" href="javascript:history.back()"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>



    <!-- start: page -->
    <div class="row">
        <div class="col-md-3 col-lg-12 col-xl-3">
            <div class="row">
                <div class="col-md-12 col-lg-3 col-xl-3">
                    <section class="panel">
                        <div class="panel-body bg-primary">
                            <div class="widget-summary widget-summary-md">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon">
                                        <i class="fa fa-tags"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Total Project</h4>
                                        <div class="info">
                                            <strong class="amount"><?php echo $conn->query("SELECT * FROM project_list")->num_rows; ?></strong>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-12 col-lg-3 col-xl-3">
                    <section class="panel">
                        <div class="panel-body bg-secondary">
                            <div class="widget-summary widget-summary-md">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon">
                                        <i class="fa fa-undo"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Pending/On-Hold</h4>
                                        <div class="info">
                                            <strong class="amount"><?php echo $conn->query("SELECT * FROM project_list where status=2 or status=0")->num_rows; ?></strong>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-12 col-lg-3 col-xl-3">
                    <section class="panel">
                        <div class="panel-body bg-tertiary">
                            <div class="widget-summary widget-summary-md">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon">
                                        <i class="fa fa-refresh"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">On-Progress</h4>
                                        <div class="info">
                                            <strong class="amount"><?php echo $conn->query("SELECT * FROM project_list where status=1")->num_rows; ?></strong>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-12 col-lg-3 col-xl-3">
                    <section class="panel">
                        <div class="panel-body bg-quartenary">
                            <div class="widget-summary widget-summary-md">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon">
                                        <i class="fa fa-check-square-o"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Finished Project</h4>
                                        <div class="info">
                                            <strong class="amount"><?php echo $conn->query("SELECT * FROM project_list where status=3")->num_rows; ?></strong>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        </div>
    <div class="row">
        
            <section class="panel">
                <header class="panel-heading panel-heading-transparent">


                    <h2 class="panel-title">Latest Projects</h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-condensed mb-none">
                            <colgroup>
                                <col width="5%">
                                <col width="50%">
                                <col width="10%">
                                <col width="25%">
                                <col width="10%">
                                
                                
                            </colgroup>    
                        <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Project</th>
                                    <th class="center">Tag</th>
                                    <th class="center">Vendor</th>
                                    <th class="center">Status</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <!--- sql -->
                                <?php
                                    $i = 1;
                                    $tag=array("","PLN","ICON","TA","OTHER");
                                    $vendor_tag=array("","PT. VISDAT TEKNIK UTAMA","PT. CORDOVA BERKAH NUSATAMA","CV. VISDAT TEKNIK UTAMA","CV. VISUAL DATA KOMPUTER");
                                    $stat = array("Pending","On-Progress","On-Hold","Complete","Cancel");
                                    $qry = $conn->query("SELECT * FROM project_list order by start_date desc limit 10");
                                    while($row= $qry->fetch_assoc()):
                                   
                                     // $prog= 0; 
                                     // $tprog = $conn->query("SELECT * FROM task_list where project_id = {$row['id']}")->num_rows; 
                                     // $cprog = $conn->query("SELECT * FROM task_list where project_id = {$row['id']} and status = 3")->num_rows; 
                                     // $prog = $tprog > 0 ? ($cprog/$tprog) * 100 : 0; 
                                     // $prog = $prog > 0 ?  number_format($prog,2) : $prog; 
                                    
                                ?>
                                <!-- end -->
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo ucwords($row['name']) ?></td>
                                    <td class="center">
                                        <?php
                                            if($tag[$row['pembayaran']] =='PLN'){
                                                echo "<span class='label label-warning'>{$tag[$row['pembayaran']]}</span>";
                                            }elseif($tag[$row['pembayaran']] =='ICON'){
                                                echo "<span class='label label-primary'>{$tag[$row['pembayaran']]}</span>";
                                            }elseif($tag[$row['pembayaran']] =='TA'){
                                                echo "<span class='label label-danger'>{$tag[$row['pembayaran']]}</span>";
                                            }elseif($tag[$row['pembayaran']] =='OTHER'){
                                                echo "<span class='label label-success'>{$tag[$row['pembayaran']]}</span>";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $vendor_tag[$row['vendor']] ?></td>
                                    <td class="text-center">
                                        <?php
                                        if($stat[$row['status']] =='Pending'){
                                            echo "<span class='label label-default'>{$stat[$row['status']]}</span>";
                                        }elseif($stat[$row['status']] =='On-Progress'){
                                            echo "<span class='label label-primary'>{$stat[$row['status']]}</span>";
                                        }elseif($stat[$row['status']] =='On-Hold'){
                                            echo "<span class='label label-warning'>{$stat[$row['status']]}</span>";
                                        }elseif($stat[$row['status']] =='Complete'){
                                            echo "<span class='label label-success'>{$stat[$row['status']]}</span>";
                                        }elseif($stat[$row['status']] =='Cancel'){
                                            echo "<span class='label label-danger'>{$stat[$row['status']]}</span>";
                                        }
                                        ?>
                                    </td>
                                    <!--
                                    <td>
                                        <div class="progress progress-sm progress-half-rounded m-none mt-xs light">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prog ?>%;">
                                                <?php echo $prog ?> %
                                            </div>
                                        </div>
                                    </td>
                                    -->
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        
        </div>
    <div class="row">
        <div class="col-md-9">
            <section class="panel panel-transparent">
                
            </section>
        </div>
        <div class="col-md-3">
            <section class="panel panel-transparent">
                <?php
                $omset1=$conn->query("SELECT sum(payment) as omset1 FROM project_list where year(end_date)=year(now())")->fetch_object()->omset1;
                $omset2=$conn->query("SELECT sum(payment) as omset2 FROM project_list where year(end_date)=year(now()) and payment_status=2")->fetch_object()->omset2;
                $omset3=$omset1-$omset2;
                $omset4=$conn->query("SELECT sum(cost) as omset4 FROM user_productivity where year(date)=year(now())")->fetch_object()->omset4;
                $omset5=$omset1-$omset4;
                ?>
                <div class="panel-body">
                <section class="panel">
                        <div class="panel-body bg-warning">
                            <p class="text-xs mb-none">Total Omset Project</p>
                           <div class="h4 text-bold mb-none text-right"><?php echo "Rp. ". number_format($omset1,0,',','.'); ?></div>
                       
                        </div>
                    </section>
                    <section class="panel">
                        <div class="panel-body bg-success">
                            <p class="text-xs mb-none">Jumalh yang sudah terbayar</p>
                            <div class="h4 text-bold mb-none text-right"><?php echo "Rp. ". number_format($omset2,0,',','.'); ?></div>
                            
                        </div>
                    </section>
                    <section class="panel">
                        <div class="panel-body bg-tertiary">
                        <p class="text-xs mb-none">Jumlah yang belum terbayar</p>
                            <div class="h4 text-bold mb-none text-right"><?php echo "Rp. ". number_format($omset3,0,',','.'); ?></div>
                        </div>
                    </section>
                    <section class="panel">
                        <div class="panel-body bg-primary">
                        <p class="text-xs mb-none">Total Project Expense</p>
                            <div class="h4 text-bold mb-none text-right"><?php echo "Rp. ". number_format($omset4,0,',','.'); ?></div>
                        </div>
                    </section>
                    <section class="panel">
                        <div class="panel-body bg-quartenary">
                        <p class="text-xs mb-none">Gross Project Profit</p>
                            <div class="h4 text-bold mb-none text-right"><?php echo "Rp. ". number_format($omset5,0,',','.'); ?></div>
                        </div>
                    </section>

                </div>
            </section>

        </div>

        </div>

    <!-- end: page -->
</section>