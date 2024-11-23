<?php include('../includes/config.php') ?>

<?php include('header.php') ?>
<?php include('sidebar.php') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Subjects</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Students</a></li>
                    <li class="breadcrumb-item active">Subjects</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- .main Content   -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxs -->

        <div class="row">
            <div class="col-lg">
                <div class="card">
                    <div class="card-header py-2">
                        <h3 class="card-title">Subjects</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive bg-white">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    $args = array('type' => 'subject', 'status' => 'publish',);
                                    $subjects = get_posts($args);
                                    foreach ($subjects as $subject) { ?>
                                        <tr>
                                            <td><?= $count++ ?></td>
                                            <td><?= $subject->title ?></td>
                                            <td><?= $subject->publish_date ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php include('footer.php') ?>