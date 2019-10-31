<?php
    //ne pas oublier de tester avec 127.0.0.1 et non localhost
    $err = null;
    $user;
    $cap;
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $key= "6LfGSMAUAAAAADxhTld6xjFzF4gi7abm7FShHlUr";//cle secrete fourni sur le site : https://www.google.com/recaptcha/admin/site/348145862/setup

if(isset($_POST['formsubmit'] ) ){
    $email = ($_POST['email']); 
    $recap = ($_POST['g-recaptcha-response']);

    $response = file_get_contents($url.'?secret='.$key.'&response='.$recap);
    $response = json_decode($response);

    print_r($response);die();
    
    if($response->success == true){
        header("location:home.php");
    }
    else{
        $err = 1;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="pack/bootstrap.css">

    <!-- 1 - Ajouter ca ici-->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Document</title>
</head>
<body>
<div class="navbar bg-dark">
    <div class="navbar-brand text-light">
        Recaptcha | <small> sonatel academy </small>
    </div>
</div>    

    <div id="theform" class="col-sm-8 col-md-5 mx-auto mt-5 p-4">

        <form class="col-12 " action="#" method="POST">
            <div class="form-group">
                <label for=""> User </label>
                <input name="email" type="text" class="form-control" placeholder="user@gmail.com">
            </div>

            <!-- 2 - Ajouter ca ici avec data-sitekey la clé du site fournit par : https://www.google.com/recaptcha/admin/site/348145862/setup-->
            <div class="g-recaptcha mt-2" data-sitekey="6LfGSMAUAAAAACxJ7IOHeKH-7CEf2H3n-JQFNgPE"></div>

            <button class="btn btn-outline-primary mt-3" type="submit" name="formsubmit"> Connect </button>

            <?php

                    if($err != null){
                        ?>
                            <div class="alert alert-danger mt-4"> Veillez completer le captcha </div>
                        <?php
                    }
            ?>

        </form>



    </div>

    <!-- ================================= FRAMEWORKS -->
    <script src="pack/bootstrap.js"></script>
</body>
</html>