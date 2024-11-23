<?php include("header.php") ?>

<section class="bg-light vh-100 d-flex">
    <div class="col-3 m-auto">
        <div class="card">
            <div class="card-body">
                <div class="border rounded-circle mx-auto d-flex" style="width:100px;height:100px">
                    <i class="fa fa-user prefix fa-3x m-auto"></i>
                </div><br>
                <form action="actions/login.php" method="POST">
                    <!--material input-->
                    <div class="md-form">
                        <input type="text" id="email" name="email" class="form-control" placeholder="Your Email">
                        <label for="email" style="font-family: Arial, sans-serif;"></label><br>
                    </div>
                    <div class="md-form">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Your Password">
                        <label for="password" style="font-family: Arial, sans-serif;"></label><br>
                    </div>
                    <button class="btn btn-danger btn-block" name="login">Login</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include("footer.php") ?>