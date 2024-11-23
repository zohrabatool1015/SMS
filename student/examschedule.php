<?php include('../includes/config.php') ?>

<?php include('header.php') ?>
<?php include('sidebar.php') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Examination Schedule
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Student</a></li>
                    <li class="breadcrumb-item active">Examination Schedule</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
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
                            <th>Room</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch and display exam schedule data
                        //$exam_data = fetch_exam_schedule();
                        //foreach ($exam_data as $exam) { 
                        ?>
                        <tr>
                            <td><?php //echo $exam['exam_date'] 
                                ?></td>
                            <td><?php //echo $exam['exam_time'] 
                                ?></td>
                            <td><?php //echo $exam['class'] 
                                ?></td>
                            <td><?php //echo $exam['section'] 
                                ?></td>
                            <td><?php //echo $exam['subject'] 
                                ?></td>
                            <td><?php //echo $exam['room'] 
                                ?></td>
                        </tr>
                        <?php //} 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>

<?php include('footer.php') ?>