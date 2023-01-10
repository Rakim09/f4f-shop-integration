<?php
/**
 * F4F Shop Integration
 *
 * @package   f4f-shop-integration
 * @author    R-DEV <office@r-dev.cloud>
 * @copyright 2022 F4F Shop Integration
 * @license   MIT
 * @link      https://r-dev.cloud
 */
?>
<?php
/**
 * @see \F4fShopIntegration\App\Backend\Settings
 */
?>
<div class="wrap">
    <h2><?= $this->plugin->name() ?></h2>
    <form method="POST" action="options.php">
        <?php
        settings_fields('f4f-shop-integration-general-settings');
        do_settings_sections('f4f-shop-integration-general-settings');
        ?>
        <?php submit_button(); ?>
    </form>
</div>