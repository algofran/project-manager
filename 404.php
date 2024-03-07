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
                <li><span>Oops</span></li>
            </ol>
    
            <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>


<!-- start: page -->
	<section class="body-error error-inside">
		<div class="center-error">

			<div class="row">
				<div class="col-md-12">
					<div class="main-error mb-xlg">
						<h2 class="error-code text-dark text-center text-semibold m-none">404 <i class="fa fa-file"></i></h2>
						<p class="error-explanation text-center">We're sorry, but the page you were looking for doesn't exist.</p>
					</div>
				</div>
									
			</div>
		</div>
	</section>
<!-- end: page -->

    <!-- end: page -->
</section>


