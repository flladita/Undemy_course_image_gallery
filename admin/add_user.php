<?php include("includes/header.php"); ?>

<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>

<?php

 $message = "";

 $user = new User();

    if(isset($_POST['create'])) {

        if($user) {

            $user->username = $_POST['username'];
            $user->password = $_POST['password'];
            $user->first_name = $_POST['first_name'];
            $user->last_name = $_POST['last_name'];

            $user->set_file($_FILES['image']);


            if($user->upload_photo() && $user->save()) {

                redirect('users.php');
                $session->message("The user ". $user->first_name. " " .$user->last_name . " has been successfully created.");


            } else {

                $message = join("<br>", $user->errors);

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
                <div class="col-lg-8">
                    <h1 class="page-header">
                        Add
                        <small>a new user</small>
                    </h1>

                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <p class="bg-danger">
                                <?php echo $message ?>
                            </p>
                            <input type="file" name="image">
                        </div>

                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name ?>">
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name ?>">
                        </div>

                        <div class="form-group">
                            <label for="caption">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $user->username ?>" >
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $user->password ?>">
                        </div>

                        <div class="info-box-footer clearfix">
                            <div class="info-box-cancel pull-left">
                                <a href="users.php" class="btn btn-danger btn-lg">Cancel</a>
                            </div>
                            <div class="info-box-update pull-right ">
                                <input type="submit" name="create" value="Submit" class="btn btn-primary btn-lg ">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>