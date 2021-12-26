<?php include("includes/header.php"); ?>

<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>

<?php

$message = "";
$photo = new Photo();

    if (isset($_POST['submit'])) {

        if($photo) {

            $photo->title = $_POST['title'];
            $photo->author = $_POST['author'];
            $photo->description = $_POST['description'];
            $photo->set_file($_FILES['file_upload']);

                if( $photo->upload_photo() && $photo->save()) {

                    redirect('photos.php');
                    $session->message("The photo with name: ". $photo->image . " has been added.");

                } else {

                    $message = join("<br>", $photo->errors);
                }
        }

    }
?>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <?php include("includes/top_nav.php")?>

        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <?php include("includes/side_nav.php")?>

        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Add
                        <small>a photo</small>
                    </h1>
                    <div class="col-md-6">
                        <p class="bg-danger">
                            <?php echo $message ?>
                        </p>
                    <form action="upload.php" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <input type="file" name="file_upload">
                        </div>

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $photo->title; ?>">
                        </div>

                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="author" class="form-control" value="<?php echo $photo->author; ?>">
                        </div>

                        <div class="form-group">
                            <label for="caption">Description</label>
                            <textarea class="form-control" name="description" id="summernote" cols="30" rows="10"><?php echo $photo->description; ?>
                                </textarea>
                        </div>

                        <div class="info-box-footer clearfix">
                            <div class="info-box-cancel pull-left">
                                <a href="photos.php" class="btn btn-danger btn-lg">Cancel</a>
                            </div>
                            <div class="info-box-update pull-right ">
                                <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-lg ">
                            </div>
                        </div>


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