<?php 
  include("includes/header.php");
  if (!$session->is_signed_in()) { redirect("login.php"); }

  $user = new User();

  if (isset($_POST['submit'])) {
    if ($user) {
      $user->username = $_POST['username'];
      $user->first_name = $_POST['first_name'];
      $user->last_name = $_POST['last_name'];
      $user->password = $_POST['password'];
      $message = "";

      if (empty($_FILES['user_image']['tmp_name'])) {
        $user->save();
      } else {
        $user->set_user_photo($_FILES['user_image']);
        if($user->save_user_and_image()) {
          $message = "User uploaded successfuly!";
        } else {
          $message = join("<br>", $user->errors);
        }
      }
    }
  }

?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <?php include("includes/top_nav.php"); ?>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php include("includes/side_nav.php"); ?>
    <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">
    <div class="container-fluid">
        <h1 class="page-header">Add user</h1><hr>
        <div class="row">
          <h4><?=$message?></h4>
            <hr> 
            <form action="" method="post" enctype="multipart/form-data">

                <div class="col-md-6 col-md-offset-3">

                <div class="form-group">
                  <label>Select user image to upload</label><br>
                  <input type="file" name="user_image">
                </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" value="">
                    </div>

                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary pull-right">
                    </div>
                </div>

            </form>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>