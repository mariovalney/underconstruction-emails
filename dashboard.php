<?php
    $show_notice = false;

    if (isset($_POST['submit_options'])) {
        if (isset($_POST['jg_uc_is_active']) && $_POST['jg_uc_is_active'] == '1') {
            update_option('jg_uc_is_active', '1', true);
        } else {
            update_option('jg_uc_is_active', '0', true);
        }

        $show_notice = true;
        $show_notice_text = "Configurações salvas!";
    }
?>
<style type="text/css">
    .jg-underconstruction-dashboard .col {
        margin-bottom: 0;
    }

    .jg-underconstruction-dashboard .col2-set::after {
        clear: both;
        content: "";
        display: table;
    }

    .jg-underconstruction-dashboard .col2-set .col-1,
    .jg-underconstruction-dashboard .col2-set .col-2 {
        width: 48%;
        float: left;
    }

    .jg-underconstruction-dashboard .col2-set .col-2 {
        float: right;
    }

    .jg-underconstruction-dashboard .sf-title {
        float: left;
        margin-bottom: .53em;
    }

    .jg-underconstruction-dashboard .version {
        font-size: 30%;
        padding: 0.387em 0.857em;
        border-radius: 3px;
        background-color: #fff;
        font-weight: 700;
        margin-left: 10px;
    }

    .jg-underconstruction-dashboard .sf-review {
        max-width: 360px;
        float: right;
        margin-bottom: .53em;
    }

    .jg-underconstruction-dashboard .sf-review p {
        font-size: .857em;
    }

    .jg-underconstruction-dashboard .sf-review + .boxed {
        clear: both;
    }

    .jg-underconstruction-dashboard .boxed {
        padding: 1.387em 2.244em;
        background: #fff;
        box-sizing: border-box;
        border: 1px solid #ddd;
        border-radius: 4px;
        position: relative;
        margin-bottom: 2.618em;
        width: 100%;
    }

    .jg-underconstruction-dashboard .boxed > h2:first-child {
        font-weight: 700;
        font-size: 1.1em;
    }

    .jg-underconstruction-dashboard .boxed .button {
        line-height: 16px;
        height: 37px;
        padding: 8px 20px;
        font-size: 15px;
    }

    .jg-underconstruction-dashboard .boxed p {
        font-size: .857em;
    }

    .jg-underconstruction-dashboard .boxed:before {
        content: "\f127";
        display: block;
        position: absolute;
        top: 1.387em;
        right: 1.387em;
        font-size: 1.618em;
        font-family: 'Dashicons';
        font-weight: 400;
        -webkit-font-smoothing: antialiased;
    }

    .jg-underconstruction-dashboard .boxed.config:before {
        content: "\f111";
    }

    .jg-underconstruction-dashboard .boxed.mails:before {
        content: "\f465";
    }

    .jg-underconstruction-dashboard form {
        margin-top: 20px;
        display: block;
    }

    .jg-underconstruction-dashboard form label {
        width: 79%;
        display: inline-block;
        vertical-align: middle;
    }

    .jg-underconstruction-dashboard form p.submit {
        margin: 0;
        padding: 0;
        display: inline-block;
        width: 20%;
        text-align: right;
        vertical-align: middle;
    }

    .jg-underconstruction-dashboard .jg-notice {
        display: block;
        background: #fff;
        padding: 1px 12px;
        margin: 5px 0 15px;
        position: relative;
        border-left: 4px solid #7ad03a;
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        float: none;
        clear: both;
    }

    .jg-underconstruction-dashboard .jg-notice p {
        margin: .5em 0;
        padding: 2px;
    }

    .jg-underconstruction-dashboard .jg-notice .notice-dismiss {
        height: 100%;
    }

    .jg-underconstruction-dashboard .jg-notice .notice-dismiss:focus {
        box-shadow: none!important;
    }

    .jg-underconstruction-dashboard .registries-details {
        text-align: right;
    }

    .jg-underconstruction-dashboard .registries-details li {
        display: inline-block;
        margin-left: 10px;
        padding-left: 10px;
        border-left: 1px solid #999;
    }

    .jg-underconstruction-dashboard .registries-details li.count {
        margin-left: 0;
        padding-left: 0;
        border-left: none;
    }

    .jg-underconstruction-dashboard .registries-list {
        font-size: 0;
        margin-top: 30px;
    }

    .jg-underconstruction-dashboard .registries-list li {
        display: inline-block;
        width: 50%;
        font-size: 18px;
        padding: 10px 15px;
        background: #F6F6F6;
        margin: 0;
        box-sizing: border-box;
    }

    .jg-underconstruction-dashboard .registries-list li:nth-child(4n+1),
    .jg-underconstruction-dashboard .registries-list li:nth-child(4n+2) {
        background: #F1F1F1;
    }

    .jg-underconstruction-dashboard .registries-list li span {
        font-size: 0.7em;
        vertical-align: middle;
        color: #AAA;
    }
</style>

<div class="wrap about-wrap jg-underconstruction-dashboard">
    <div class="col one-col" style="overflow: hidden;">
        <h1 class="sf-title">
            <strong>Under Construction E-mails</strong><sup class="version">BETA</sup>
        </h1>

        <section class="sf-review">
            <p>Algum comentário?<br>Mande-nos um <a href="mailto:mariovalney@gmail.com">e-mail</a>.</p>
        </section>

        <?php 
            if ($show_notice) : ?>
            
                <div class="jg-notice">
                    <p><?php echo $show_notice_text ?></p>
                    <button type="button" class="notice-dismiss">
                        <span class="screen-reader-text">Dispensar este aviso.</span>
                    </button>
                </div>

                <script type="text/javascript">
                    jQuery(document).ready(function($) {
                        $('.jg-notice .notice-dismiss').on('click', function(event) {
                            event.preventDefault();

                            var el = $(this);

                            el.parents('.jg-notice').fadeOut('400', function() {
                                el.parents('.jg-notice').remove();
                            });
                        });
                    });
                </script>

        <?php endif; ?>

        <div class="col boxed config">
            <h2>Configurações</h2>
            <?php
                $jg_uc_is_active = get_option('jg_uc_is_active', '0');
            ?>
            <form action="" method="POST">
                <label>
                    <input name="jg_uc_is_active" id="jg_uc_is_active" type="checkbox" value="1" <?php checked(1, $jg_uc_is_active); ?> />
                    Ativar página "Em construção"
                </label>
                <p class="submit">
                    <input type="submit" name="submit_options" id="submit_options" class="button button-primary" value="Salvar">
                </p>
            </form>
        </div>

        <div class="col boxed mails">
            <?php
                $args = array(
                    'posts_per_page'   => -1,
                    'meta_key'         => '_jg_uc_registry_email',
                    'post_type'        => 'jg_uc_registries',
                    'post_status'      => 'publish'
                );

                $registries = get_posts($args);
            ?>

            <?php if (count($registries) > 0 ) :?>
                <h2>Lista de Registros</h2>
                <ul class="registries-details">
                    <li class="count"><?php echo count($registries) ?> Registro(s) encontrado(s)</li>
                    <li>Exportar para: <a id="export-csv" href="<?php echo jg_uc_get_asset('export-csv.php'); ?>" target="_blank">CSV</a></li>
                </ul>
                <ul class="registries-list">
                    <?php 
                        foreach ($registries as $registry) {
                            $email = get_post_meta($registry->ID, '_jg_uc_registry_email', true);
                            $date = mysql2date('d/m/Y', $registry->post_date);

                            echo '<li>' . $email . '<span>(' . $date . ')</span></li>';
                        }
                    ?>
                </ul>
            <?php else: ?>
                <h2>Lista de Registros</h2>
                <p style="font-size: 0.9em;">Nenhum registro encontrado</p>
            <?php endif; ?>
        </div>
    </div>
</div>