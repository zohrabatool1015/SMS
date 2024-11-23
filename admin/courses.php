<?php include('../includes/config.php') ?>
<?php
if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $category = $_POST['category'];
    $duration = $_POST['duration'];
    $image = $_FILES["thumbnail"]["name"];
    $today = date('Y-m-d');

    $target_dir = "../dist/uploads/";
    $target_file = $target_dir . basename($_FILES["thumbnail"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadOk = 1;

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["thumbnail"]["size"] > 700000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file)) {
            mysqli_query($db_conn, "INSERT INTO courses (`name`, `category`, `duration`, `image`, `date`) VALUES ('$name', '$category', '$duration', '$image', '$today')") or die(mysqli_error($db_conn));
            $_SESSION['success_msg'] = 'Course has been uploaded successfuly';
            header('Location: courses.php'); exit;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}


$course_count_query = "SELECT COUNT(*) AS total_courses FROM courses";
$course_count_result = mysqli_query($db_conn, $course_count_query);

if ($course_count_result) {
    $course_count = mysqli_fetch_assoc($course_count_result)['total_courses'];
    $_SESSION['total_courses'] = $course_count;

    // Debugging: Print the count directly
    // echo "Total courses: " . $_SESSION['total_courses'];
} else {
    die('Database query failed: ' . mysqli_error($db_conn));
}
?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Manage Courses</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Courses</li>
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
                        Add New Course
                    </h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Course Name</label>
                            <input type="text" name="name" placeholder="Course Title" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="category">Course Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">Select Category</option>
                                <option value="english">English</option>
                                <option value="math">Mathmatics</option>
                                <option value="urdu">Urdu</option>
                                <option value="islamiat">Islamiat</option>
                                <option value="science">Science</option>
                                <option value="computer">Computer</option>
                                <option value="social-study">Social study</option>
                                <option value="chemistry">Chemistry</option>
                                <option value="physics">Physics</option>                            
                                <option value="biology">Biology</option>                            
                                 
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="duration">Course Duration</label>
                            <input type="text" name="duration" id="duration" placeholder="Course duration" required class="form-control">
                        </div>

                        <div class="form-group">
                            <input type="file" name="thumbnail" id="thumbnail" required>
                        </div>

                        <button name="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        <?php } else { ?>
            <div class="card">
                <div class="card-header py-2">
                    <h3 class="card-title">Courses</h3>
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
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Duration</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                $curse_query = mysqli_query($db_conn, 'SELECT * FROM courses');
                                while ($course = mysqli_fetch_object($curse_query)) { ?>
                                    <tr>
                                        <td><?= $count++ ?></td>
                                        <td><img src="../dist/uploads/<?= $course->image ?>" height="100" class="border" alt="<?= $course->name ?>"></td>
                                        <td><?= $course->name ?></td>
                                        <td><?= $course->category ?></td>
                                        <td><?= $course->duration ?></td>
                                        <td><?= $course->date ?></td>
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