<?php 
    include("includes/header.php");
    if (!$session->is_signed_in()) { redirect("login.php"); }
    $photos = Photo::get_all();
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
                            Photos
                        </h1>
                        <div class="col-md-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Id</th>
                                        <th>File Name</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Size</th>
                                        <th>Comments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($photos as $photo) : ?>
                                    <tr>
                                        <td>
                                            <img class="admin-thumbnail" src="<?=$photo->picture_path()?>" alt="">
                                            <div class="picture_link">
                                                <a href="edit_image.php?id=<?=$photo->id?>">Edit</a>
                                                <a target="_blank" href="../photofront.php?id=<?=$photo->id?>">View</a>
                                                <a href="delete_image.php?id=<?=$photo->id?>">Delete</a>
                                            </div>
                                        </td>
                                        <td><?=$photo->id?></td>
                                        <td><?=$photo->filename?></td>
                                        <td><?=$photo->title?></td>
                                        <td><?=$photo->description?></td>
                                        <td><?=$photo->size?></td>
                                        <td>
                                            <a href="photo_comment.php?id=<?=$photo->id?>">
                                            <?php 
                                                $comments = Comment::find_comment($photo->id);
                                                echo count($comments);
                                            ?>
                                            </a>
                                            
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>