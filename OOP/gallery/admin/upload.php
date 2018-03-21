<?php

    include("includes/header.php"); 

    if (isset($_POST['submit'])) {
        $file_upload = $_FILES['file_upload'];
        $file_err = $file_upload['error'];
        $file_tmp_name = $file_upload['tmp_name'];
        $file_name = $file_upload['name'];
        $directory = "uploads";

        $upload_errors = array(
            UPLOAD_ERR_OK => "File submited.",
            UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive in php.ini.",
            UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.",
            UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
            UPLOAD_ERR_NO_FILE => "No file was uploaded.",
            UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
            UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
            UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
        );

        $error_message = $upload_errors[$file_err];
        



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
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Uploads
                            <small>Subheading</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
            </div>
                <div class="form">
                    <?php 


                        if (!empty($error_message)) {
                            if (move_uploaded_file($file_tmp_name, $directory."/".$file_name)) {
                                echo "<div>";
                                    echo "<h3>File uploaded successfuly</h3>";
                                echo "</div>";
                            } else{
                                echo "<div>";
                                    print_r("<h3>".$error_message."</h3>");
                                echo "</div>";
                            }
                        }
                    ?>                    
                    <form action="upload.php" enctype="multipart/form-data" method="post">
                        <input type="file" name="file_upload"><br>
                        <input type="submit" name="submit">
                    </form>
                </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->


  <?php include("includes/footer.php"); ?>