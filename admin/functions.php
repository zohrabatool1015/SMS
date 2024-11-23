<?php include('../includes/config.php') ?>
<?php
if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $category = $_POST['category'];
    $duration = $_POST['duration'];
    $functionDateTime = $_POST['functionDateTime'] ?? null;

    if (!$functionDateTime) {
        // Default to 7 days in the future with default time if no date and time are provided
        $defaultDateTime = (new DateTime())->modify('+7 days')->setTime(9, 0); // 09:00 as default time
        $functionDateTime = $defaultDateTime->format('Y-m-d\TH:i');
    } 

    mysqli_query($db_conn, "INSERT INTO functions (`name`, `category`, `duration`, `date`) VALUES ('$name', '$category', '$duration', '$functionDateTime')") or die(mysqli_error($db_conn));
    $_SESSION['success_msg'] = 'Course has been uploaded successfuly';
    header('Location: functions.php');
    exit;
} else {
    echo "Sorry, there was an error uploading your file.";
}

?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Manage Functions</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Functions</li>
                </ol>
            </div><!-- /.col -->
            <?php
            if (isset($_SESSION['success_msg'])) { ?>
                <div class="col-lg-12">
                    <small class="text-success" style="font-size:16px"><?= $_SESSION['success_msg'] ?></small>
                </div>
            <?php
                unset($_SESSION['success_msg']);
            }
            ?>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- .main Content   -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxs -->
        <?php
        if (isset($_REQUEST['action'])) { ?>
            <div class="card">
                <div class="card-header py-2">
                    <h3 class="card-title">
                        Add New Function
                    </h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Function Name</label>
                            <input type="text" name="name" placeholder="Course Title" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="category">Function Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">Select Category</option>
                                <option value="Morning">Morning</option>
                                <option value="Evening">Evening</option>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="duration">Functions Duration</label>
                            <input type="text" name="duration" id="duration" placeholder="Course duration" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="functionDateTime">Select Date and Time:</label>
                            <input type="datetime-local" name="functionDateTime" id="functionDateTime" required placeholder="Course Date">
                        </div>


                        <button name="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        <?php } else { ?>
            <div class="card">
                <div class="card-header py-2">
                    <h3 class="card-title">Functions</h3>
                    <div class="card-tools">
                        <a href="?action=add-new" class="btn btn-success btn-xs"><i class="fa fa-plus mr-2"></i>Add New</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive bg-white">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Duration</th>
                                    <th>Date and Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                $funct_query = mysqli_query($db_conn, 'SELECT * FROM functions');
                                while ($function = mysqli_fetch_object($funct_query)) {
                                    //     echo '<pre>';
                                    //     print_r($function);
                                    //    echo '</pre>';
                                ?>
                                    <tr>
                                        <td><?= $count++ ?></td>
                                        <td><?= $function->name ?></td>
                                        <td><?= $function->category ?></td>
                                        <td><?= $function->duration ?></td>
                                        <td><?= $function->date ?></td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php include('footer.php') ?>