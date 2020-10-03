<?php include "./admin_header.php"; ?>
  
<div class="inner-content h-100 w-100 d-lg-flex">
	   <!--/. NAV TOP  -->
      <?php include "./admin_sidenav.php"; ?>
        <!-- /. NAV SIDE  -->
		<div class="col-lg-10 p-0 main-content">
		  <div class="header"> 
                        <h1 class="page-header">
                            Categories
                        </h1>
									
		  </div>
            <div class="page-inner d-md-flex">
                    <div class="col-sm-12 col-md-5 col-lg-4" id="form-flash-msg">

                    <?php 
                    check_for_submit();
                    check_for_update();
                    ?>
                    
                    <form action="" method="post" class="card-body">
                        <input type="text" name="category" class="form-control" 
                        <?php 
                        if(isset($_GET['edit']))
{
    $cat_id = $_GET['edit'];
    $query = "SELECT * FROM categories WHERE id = '$cat_id'";
    $result = mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc($result);
?> value="<?php echo $row['category_title'];}?>" placeholder="Add category" autofocus>

                        <input type="submit" id='add-category' 
                        <?php 
                        if(isset($_GET['edit']))
                        {?>
                            name="update"
                        <?php 
                        }
                        else
                        if(isset($_POST['update']))
                        {?>
                            name="submit"
                       <?php 
                       }
                       else
                       {?>
                        name="submit"
                        <?php  
                      }?>
                        class="btn btn-primary btn-block mt-2" 
                        value="<?php 
                        if(isset($_GET['edit']))
                        {
                            echo 'Update';
                        }else
                        if(isset($_POST['update'])){
                            echo 'Add';
                        }else{
                            echo 'Add';
                        } ?>"><br/>



                    </form>
                    </div>
                    <div class="col-sm-12 col-md-5">
                    <?php 
                    //Add categories
                    add_categories();
                    //Delete categories
                    delete_categories();
                    ?>
         </tbody>
</table>
                    </div>
                </div>
               </div>
			
		<script>

    setTimeout(()=>{
        document.querySelector('.alert-cls').style.display="none";
    }, 3000);
        </script>
                <?php include "./admin_footer.php"; ?>
                