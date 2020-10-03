
<div class="card border-primary my-3">
<?php 
session_start(); 
loginCheck(); ?>
            <div class="card-header h3">Login</div>
            <div class="card-body text-primary">

              <form action="" method="post"  class="form-group">
                <input type="email" name="email" class="form-control mb-3" placeholder="email" >
                <div class="input-group mb-3">
                  <input type="password" name="password" class="form-control" placeholder="password" aria-describedby="button-addon3">
                  <div class="input-group-append">
                    <input class="btn btn-outline-secondary" name="login" type="submit" value="Login">
                  </div>
                </div>

              </form>

            </div>
          </div>
