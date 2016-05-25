<?php
/**
 * Página "Em Construção".
 * Para desenvolvedores: altere como quiser!
 *
 * @package underconstruction-emails
 */
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title><?php echo wp_title(); ?></title>
        <meta charset="UTF-8">
        <meta name="author" content="<?php bloginfo("name"); ?>">
        <meta name="description" content="<?php bloginfo("description"); ?>">
        <meta name="keywords" content="wordpress, em contrução, em breve">
        <meta property="og:title" content="<?php echo wp_title(); ?>">
        <meta property="og:image" content="<?php echo jg_uc_get_asset('img/facebook.jpg') ?>">
        <meta property="og:description" content="<?php bloginfo("description"); ?>">
        
        <script type="text/javascript">
            var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
        </script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?php echo jg_uc_get_asset('css/style.css') ?>">

    </head>
    <body>
        <section class="wrap">
            <div class="row">
                <div class="col-xs-12">
                    <img class="logo" src="<?php echo jg_uc_get_asset('img/logo.png') ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h1>Olá! Seja bem-vindo a <?php bloginfo("name"); ?>.</h1>
                    <p class="lead">Estamos preparando um novo site e você não pode ficar de fora. <br>Então o que acha de cadastrar seu e-mail abaixo?</p>
                </div>
            </div>
            <div class="row form panel panel-default">
                <div class="panel-body">
                    <form id="save-registry-form" action="" method="POST">
                        <div class="form-group has-feedback no-feedback col-md-offset-1 col-md-8 col-sm-9 col-xs-12">
                            <label class="control-label sr-only" for="customerEmail">E-mail</label>
                            <input type="email" class="form-control check-email input-lg" id="customerEmail" name="customerEmail" placeholder="email@exemplo.com" aria-describedby="customerEmailStatus" required="required" autocomplete="off">
                            <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                            <span id="customerEmailStatus" class="sr-only">[OK]</span>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-12">
                            <button type="submit" id="save-registry" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                    <p id="formStatus"><span class="glyphicon" aria-hidden="true"></span><span class="msg"></span></p>
                </div>
            </div>
        </section>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
        <script src="<?php echo jg_uc_get_asset('js/main.js') ?>"></script>
    </body>
</html>