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