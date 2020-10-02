<div class="row col-10">
						
                      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 my-3 p-2">
							<div class="bg-success d-flex">
								<div class="col-4 d-flex justify-content-center align-items-center" style="font-size: 42px;">
									<i class="fa fa-file-text fa-lg text-white" aria-hidden="true"></i>
								</div>
								<div class="col-8 text-center">
									<h2 class="text-white"><?php
									$query = "SELECT * FROM posts";
									$result = mysqli_query($connection,$query);
									echo mysqli_num_rows($result);
									?></h2>
									<h4 class="text-white">Posts</h4>
								</div>
							</div>

							<a href="posts.php?q=view_all_posts">
							<div class="d-flex justify-content-between align-items-center bg-white py-2 border border-success border-3">
							<small class="text-success ml-2">View details</small>
							<i class="fa fa-arrow-right text-success mr-2"></i>
							</div>
							</a>

					    </div>

                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 my-3 p-2">
							<div class="bg-danger d-flex">
								<div class="col-4 d-flex justify-content-center align-items-center" style="font-size: 42px;">
									<i class="fa fa-list fa-lg text-white" aria-hidden="true"></i>
								</div>
								<div class="col-8 text-center">
									<h2 class="text-white"><?php
									$query = "SELECT * FROM categories";
									$result = mysqli_query($connection,$query);
									echo mysqli_num_rows($result);
									?></h2>
									<h4 class="text-white">Categories</h4>
								</div>
							</div>
							<a href="admin_categories.php">
							<div class="d-flex justify-content-between align-items-center bg-white py-2 border border-danger border-3">
							<small class="ml-2 text-danger">View details</small>
							<i class="fa fa-arrow-right text-danger  mr-2"></i>
							</div>
							</a>

						</div>

                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 my-3 p-2">
							<div class="bg-info d-flex">
								<div class="col-4 d-flex justify-content-center align-items-center" style="font-size: 42px;">
									<i class="fa fa-comments fa-lg text-white" aria-hidden="true"></i>
								</div>
								<div class="col-8 text-center">
									<h2 class="text-white"><?php
									$query = "SELECT * FROM comments";
									$result = mysqli_query($connection,$query);
									echo mysqli_num_rows($result);
									?></h2>
									<h4 class="text-white">Comments</h4>
								</div>
							</div>
							<a href="comments.php?q=view_all_comments">
							<div class="d-flex justify-content-between align-items-center bg-white py-2 border border-info border-3">
							<small class="text-info ml-2">View details</small>
							<i class="fa fa-arrow-right text-info mr-2"></i>
							</div>
							</a>
						</div>

                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 my-3 p-2">
							<div class="bg-warning d-flex">
								<div class="col-4 d-flex justify-content-center align-items-center" style="font-size: 42px;">
									<i class="fa fa-users fa-lg text-white" aria-hidden="true"></i>
								</div>
								<div class="col-8 text-center">
									<h2 class="text-white"><?php
									$query = "SELECT * FROM users";
									$result = mysqli_query($connection,$query);
									echo mysqli_num_rows($result);
									?></h2>
									<h4 class="text-white">Users</h4>
								</div>
							</div>

							<a href="users.php?q=view_all_users">
							<div class="d-flex justify-content-between align-items-center bg-white py-2 border border-warning border-3">
							<small class="text-warning ml-2">View details</small>
							<i class="fa fa-arrow-right text-warning mr-2"></i>
							</div>
							</a>
						</div>
</div>