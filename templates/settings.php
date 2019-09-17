<div class="wrap">
    <h1 class="pw-page-header"><?php esc_html_e('Pushe webpush settings', 'pushe-webpush'); ?></h1>
    <?php settings_errors() ?>

    <div class="pw-main">
        <form method="POST" action="options.php">
            <?php
            settings_fields('pushe_webpush_settings');
            do_settings_sections('pushe_settings');
            submit_button(null, 'primary', 'submit', true, null);
            ?>
        </form>
    </div>

</div>