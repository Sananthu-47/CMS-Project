<?php include "./admin_header.php"; ?>
  
<div class="inner-content h-100 w-100 d-lg-flex">
	   <!--/. NAV TOP  -->
      <?php include "./admin_sidenav.php"; ?>
        <!-- /. NAV SIDE  -->
		<div class="col-lg-10 p-0 main-content">
		  <div class="header"> 
                        <h1 class="page-header">
                            Dashboard
                        </h1>
									
		  </div>
            <div class="page-inner flex-column d-flex justify-content-center align-items-center">

	 <?php include "dashboard.php"; ?>
   <?php include "chart.php"; ?>
                    
            </div>
            </div>
			<?php include "./admin_footer.php"; ?>