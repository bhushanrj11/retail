<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <title>Govind Furniture</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/reset.min.css') ?>">
    
    <link rel='stylesheet prefetch' href='<?php echo base_url('assets/font-awesome/css/font-awesome.min.css') ?>'>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/login.css'); ?>">
    <style type="text/css">
        body{
            background: url(assets/img/login_background.jpg);
            background-size: cover;
        }
    </style>
</head>

<body>
    <input type="hidden" value="<?php echo $param; ?>" id="param"></input>
    <div class="container">  
        <?php if($this->session->flashdata('msg')){ ?>
            <div class="<?php echo  $this->session->flashdata('msg_type') ?>">
              <?php echo  $this->session->flashdata('msg') ?>
            </div>
        <?php } ?>
        <div class="info">
            <div> <h1> Govind Furniture </h1> </div>
            <div style="padding: 16px;font-size: 26px;color: #455a64; font-variant: small-caps;">Login </div>
        </div>
    </div>
    <div class="form">
        <div class="thumbnail"><img src="<?php echo base_url('assets/img/tmp.svg.png'); ?>" /></div>
     
        <form class="login-form" action="<?php echo base_url('login/validate'); ?>" method="post">
            <input type="text" placeholder="username" name="email" required autofocus />
            <input type="password" placeholder="password" name="passwd" required/>
            <button type="submit">login</button>
        </form>
    </div>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script type="text/javascript">
        $(document).ready(function () {
            if($('#param').val() == "signup"){
                setTimeout(function(){
                    $('form').animate({
                        height: "toggle",
                        opacity: "toggle"
                    }, "slow");
                },500); 
            }

            $('.message a').click(function() {
                $('form').animate({
                    height: "toggle",
                    opacity: "toggle"
                }, "slow");
            });
            setTimeout(function(){
                $('.alert').hide();    
            },5000);
        })
        
    </script>
</body>

</html>
