<?php
$this->load->helper('url');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>:: STOCK MANAGEMENT SYSTEM ::</title>

        <!-- Bootstrap -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <link href="<?php echo base_url() . "assets/css/bootstrap.min.css"; ?>" rel="stylesheet">
        <link href="<?php echo base_url() . "assets/css/signin.css"; ?>"  rel="stylesheet">
        <link href="<?php echo base_url() . "assets/css/style.css"; ?>"  rel="stylesheet">
        <script src="<?php echo base_url() . "assets/js/bootstrap.min.js"; ?>"></script>

    </head>
    <body style="padding-top: 0px;">
        <div class="container-fluid">
            <div class="row">
                <div  class="col-sm-12" style="background-color:#4C9ED9;text-align: center;">
                    <h1>Stock Management System <small>(easy to manage)</small></h1></div>
            </div> 
        </div> 
        <div class="container">
                <form class="form-signin" action="<?php echo base_url() . "main/login_handler"; ?>" method="POST">

                    <h2 class="form-signin-heading"> Please sign in</h2>
                    <input  class="form-control login-control-width" type="email" autofocus="" required placeholder="Email address" name="email" value="">
                    <input id="inputPassword" class="form-control login-control-width" type="password" required placeholder="Password" name="pwd" value="">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="remember-me">
                            Remember me
                        </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block login-control-width" type="submit" value="continue">Sign in</button>
                </form>
        </div>
        <?php
        $this->load->view('footer');
        ?>

<!--<script>
        <?php
        if ($_SESSION['oms_msg_str'] != "") {
            echo "$(document).ready(function () {"
            . "$('#myModal').find('.modal-title').text('" . $_SESSION['oms_msg_hdr'] . "');"
            . "$('#myModal').find('.modal-body').text('" . $_SESSION['oms_msg_str'] . "');"
            . "$('#myModal').modal('show');"
            . " });";
            $_SESSION['oms_msg_str'] = "";
        }
        ?>
</script>-->