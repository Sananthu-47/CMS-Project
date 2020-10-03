<?php include "./admin_header.php"; ?>
  
<div class="inner-content h-100 w-100 d-lg-flex">
	   <!--/. NAV TOP  -->
      <?php include "./admin_sidenav.php"; ?>
        <!-- /. NAV SIDE  -->
		<div class="col-lg-10 p-0 main-content">
		  <div class="header"> 
                        <h1 class="page-header">
                            View comments
                        </h1>
									
		  </div>
            <div class="page-inner">
<?php

                if(isset($_GET['q']))
                {
                    $choice = $_GET['q'];
                }else{
                    $choice = '';
                }
                switch($choice)
                {
                    case 'view_all_comment':
                        echo "<div class='table-responsive'>";
                        include "view_all_comment.php";
                        echo "</div>";
                        break;
                    default:
                    echo "<div class='table-responsive'>";
                    include "view_all_comment.php";
                    echo "</div>";
                break;
                }
                
?>                
            </div>
            </div>
                <?php include "./admin_footer.php"; ?>