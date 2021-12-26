<?php include("includes/header.php"); ?>

<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>

<?php

$message = "";

if(empty($_GET['id'])) {

    redirect('users.php');
} else {

    $user = User::find_by_id($_GET['id']);

    if(isset($_POST['update'])) {

        if($user) {

            $user->username = $_POST['username'];
            $user->password = $_POST['password'];
            $user->first_name = $_POST['first_name'];
            $user->last_name = $_POST['last_name'];

            if (empty($_FILES['image'])) {

                $user->save();
                redirect('users.php');
                $session->message("The user {$user->first_name} {$user->last_name} has been updated.");

            } else {

                $user->set_file($_FILES['image']);
                $user->upload_photo();
                $user->save();
                $session->message("The user {$user->first_name} {$user->last_name} has been updated.");
                redirect('users.php');
            }
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
                        Edit
                        <small>user</small>
                    </h1>
                    <div class="col-md-6">
                        <img class="img-responsive" src="<?php echo $user->picture_path(); ?>" alt=""></a>
                        <br>
                    </div>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="col-md-6">

                            <div class="form-group">
                                <?php echo $message; ?>
                                <input type="file" name="image">
                            </div>

                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>">
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" name="password" class="form-control" value="<?php echo $user->password; ?>">
                            </div>

                            <div class="info-box-footer clearfix">
                                <div class="info-box-cancel pull-left">
                                    <a id="user-id" href="users.php" class="btn btn-danger btn-lg">Cancel</a>
                                </div>
                                <div class="info-box-update pull-right ">
                                    <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
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