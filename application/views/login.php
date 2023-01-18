<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Kesra | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url();?>assets/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?=base_url();?>assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url();?>assets/admin/dist/css/adminlte.min.css">
    <!-- Sweetalert -->
    <script src="<?=base_url();?>node_modules/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body class="hold-transition login-page">

    <?php if ($this->session->flashdata('loggin_err_no_user') || $this->session->flashdata('loggin_err_no_session')) {

    if ($this->session->flashdata('loggin_err_no_user')) {
        $message = $this->session->flashdata('loggin_err_no_user');
    } else if ($this->session->flashdata('loggin_err_no_session')) {
        $message = $this->session->flashdata('loggin_err_no_session');
    }

    ?>
    <script>
    swal({
        title: "Error!",
        text: "<?=$message?>",
        icon: "error"
    });
    </script>
    <?php }?>

    <div class="login-box">
        <div class="login-logo">
            <a href="<?=base_url();?>assets/admin/index2.html">E-OFFICE</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Silahkan Login</p>

                <form action="<?=base_url();?>Login/login_process" method="post">
                    <div class="input-group mb-3">
                        <input type="username" name="username" class="form-control" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">

                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


                <!-- <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p> -->
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?=base_url();?>assets/admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?=base_url();?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url();?>assets/admin/dist/js/adminlte.min.js"></script>
</body>

</html>