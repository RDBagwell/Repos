<?php

    include("includes/header.php"); 
    if (!$session->is_signed_in()) { redirect("login.php"); }

    if (isset($_POST['submit'])) {
        $photo = new Photo();
        $photo->title = $_POST['title'];
        $photo->description = $_POST['description'];
        $photo->caption = $_POST['caption']; 
        $photo->alt_text = $_POST['alt_text'];
        $photo->set_file($_FILES['file_upload']);
        $message = "";
        if($photo->save_photo()){
            $message = "Photo uploaded successfuly!";
        } else {
            $message = join("<br>", $photo->errors);
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
                <!-- Page Heading -->
                <div class="row">
                    <h1 class="page-header">
                            Upload Photos
                    </h1>
                    <div class="col-md-12">      
                            <div class="col-md-6 col-md-offset-3">
                                <h4><?=$message?></h4>
                                <hr>                  
                                <form action="upload.php" enctype="multipart/form-data" method="post">
                                    <div class="form-group">
                                        <label>Photo title</label><br>
                                        <input class="form-control" type="text" name="title">
                                    </div>
                                    <div class="form-group">
                                        <label>Caption</label><br>
                                        <input class="form-control" type="text" name="caption">
                                    </div>
                                    <div class="form-group">
                                        <label>Alt Text</label><br>
                                        <input class="form-control" type="text" name="alt_text">
                                    </div>
                                    <div class="form-group">
                                        <label>Photo description</label><br>
                                        <textarea class="form-control" type="text" name="description" cols="30" rows="10"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Select file to upload</label><br>
                                        <input type="file" name="file_upload">
                                    </div>
                                        <input class="btn btn-primary pull-right" type="submit" name="submit" value="Upload">
                                </form>
                            </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>

            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->


  <?php include("includes/footer.php"); ?>