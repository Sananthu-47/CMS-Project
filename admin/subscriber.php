<?php include "./admin_header.php"; ?>
  
<div class="inner-content h-100 w-100 d-lg-flex">
	   <!--/. NAV TOP  -->
                <div class="col-lg-2" style="background-color: #0b0b2f;">
                <nav class=" navbar-expand-lg">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <div class="w-100 d-block">
                <div class="row p-2 bg-light border boder-primary border-3 d-flex justify-content-center align-items-center"><i class="fa fa-address-card text-primary"></i><a href="profile.php">&nbsp; Profile</a></div> 
                </div>

                </div>
                </nav>
                </div>





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