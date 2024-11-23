<?php include('../includes/config.php') ?>

<?php
if (isset($_POST['submit'])) {
    echo '<pre>';
    print_r($_POST); 
    echo '</pre>';
//     $class_id = isset($_POST['class_id']) ? $_POST['class_id'] : '';
//     $section_id = isset($_POST['section_id']) ? $_POST['section_id'] : '';
//     $subject_id = isset($_POST['subject_id']) ? $_POST['subject_id'] : '';
//     $exam_date = isset($_POST['exam_date']) ? $_POST['exam_date'] : '';
//     $exam_time = isset($_POST['exam_time']) ? $_POST['exam_time'] : '';
//     $status = 'scheduled';
//     $author = 1;
//     $type = 'examschedule';

//     $query_post = mysqli_query($db_conn, "
//     INSERT INTO posts (author, title, description, type, publish_date, status, parent) 
//     VALUES ('$author', 'Exam for $subject_id', 'Exam scheduled on $exam_date at $exam_time', '$type', '$publish_date', '$status', 0)
// ") or die('Error inserting into posts table');

// if ($query_post) {
//     // Get the inserted post ID
//     $post_id = mysqli_insert_id($db_conn);

//     // Insert metadata
//     $metadata = [
//         'class_id' => $class_id,
//         'section_id' => $section_id,
//         'exam_date' => $exam_date,
//         'exam_time' => $exam_time,
//         'exam_duration' => $exam_duration,
//     ];

//     foreach ($metadata as $key => $value) {
//         $query_meta = mysqli_query($db_conn, "
//             INSERT INTO metadata (item_id, meta_key, meta_value) 
//             VALUES ('$post_id', '$key', '$value')
//         ") or die('Error inserting into metadata table');
//     }

//     echo "Exam schedule successfully added!";
// } else {
//     echo "Failed to insert exam schedule.";
// }

    // Insert the basic exam schedule data
    // $query = mysqli_query($db_conn, "INSERT INTO posts (`type`, `author`, `status`, `publish_date`) VALUES ('$type', '$author', '$status', NOW())");
    // if ($query) {
    //     $item_id = mysqli_insert_id($db_conn);
    // }

    // Metadata array to save additional exam-specific data
    // $metadata = array(
    //     'class_id' => $class_id,
    //     'section_id' => $section_id,
    //     'subject_id' => $subject_id,
    //     'exam_date' => $exam_date,
    //     'exam_time' => $exam_time,
    //     'room_number' => $room_number,
    // );

    // foreach ($metadata as $key => $value) {
    //     mysqli_query($db_conn, "INSERT INTO metadata (`item_id`, `meta_key`, `meta_value`) VALUES ('$item_id', '$key', '$value')");
    // }

    // if (!$db_conn) {
    //     die("Database connection failed: " . mysqli_connect_error());
    // }
    // $result = mysqli_query($db_conn, "SELECT * FROM posts WHERE type = 'examschedule'");
    // while ($row = mysqli_fetch_assoc($result)) {
    //     echo $row['title']; // Example output
    // }

    //header('Location: examschedule.php');
}
?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Manage Examination Schedule
                    <a href="?action=add" class="btn btn-success btn-sm"> Add New</a>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Examination Schedule</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <?php if (isset($_GET['action']) && $_GET['action'] == 'add') { ?>
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-lg">
                                <div class="form-group">
                                    <label for="class_id">Select Class</label>
                                    <select name="class_id" id="class_id" class="form-control" required>
                                    <option value="">-Select Class-</option>
                                        <?php
                                        $args = array(
                                            'type' => 'class',
                                            'status' => 'publish',
                                        );
                                        $classes = get_posts($args);
                                        foreach ($classes as $key => $class) { ?>
                                            <option value="<?php echo $class->id ?>"><?php echo $class->title ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg">
                            <div class="form-group" id="section-container">
                                    <label for="section">Select Section</label>
                                    <select require name="section" id="section" class="form-control">
                                        <option value="">-Select Section-</option>
                                        <?php
                                        $args = array(
                                            'type' => 'section',
                                            'status' => 'publish',
                                        );
                                        $sections = get_posts($args);
                                        foreach ($sections as $key => $section) { ?>
                                            <option value="<?php echo $section->id ?>"><?php echo $section->title ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group">
                                    <label for="subject_id">Select Subject</label>
                                    <select name="subject_id" id="subject_id" class="form-control" required>
                                        <option value="">-Select Subject-</option>
                                        <?php
                                        $subjects = get_posts(['type' => 'subject', 'status' => 'publish']);
                                        foreach ($subjects as $subject) { ?>
                                            <option value="<?php echo $subject->id ?>"><?php echo $subject->title ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group">
                                    <label for="exam_date">Exam Date</label>
                                    <input type="date" name="exam_date" id="exam_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group">
                                    <label for="exam_time">Exam Time</label>
                                    <input type="time" name="exam_time" id="exam_time" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <input type="submit" value="Submit" name="submit" class="btn btn-success form-control">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php } else { ?>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Subject</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $args = array('type' => 'examschedule', 'status' => 'publish');

                            $examscheduls = get_posts($args);
                            foreach ($examscheduls as $examschedul) {
                                $query = mysqli_query($db_conn, "SELECT * FROM posts as p
                                INNER JOIN metadata as md ON (md.item_id = p.id)
                                INNER JOIN metadata as mp ON (mp.item_id = p.id) 
                                INNER JOIN metadata as mc ON (mc.item_id = p.id) 
                                INNER JOIN metadata as ms ON (ms.item_id = p.id) 
                                WHERE p.type = 'examschedule' AND p.status = 'publish' AND md.meta_key = 'day_name' AND md.meta_value = '$day' AND mp.meta_key = 'period_id' AND mp.meta_value = $period->id AND mc.meta_key = 'class_id' AND mc.meta_value = $class_id AND ms.meta_key = 'section_id' AND ms.meta_value = $section_id");
                                    if (mysqli_num_rows($query) > 0) {
                                        while ($timetable = mysqli_fetch_object($query)) {
                                // Fetch and display exam schedule data
                                //  $exam_data = fetch_exam_schedule();
                                //foreach ($exam_data as $exam) { 
                            ?>
                                <tr>
                                    <td><?php echo $date?></td>
                                    <td><?php echo $examschedul['exam_time'] ?></td>
                                    <td><?php echo $examschedul['class'] ?></td>
                                    <td><?php echo $examschedul['section'] ?></td>
                                    <td><?php echo $examschedul['subject'] ?></td>
                                </tr>
                            <?php } }?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } }
        ?>
    </div>
</section>

<?php include('footer.php') ?>