<?php

use function WPT\Helpers\setting;

defined('ABSPATH') or exit;

?>

<div class="wrap">
    <h1>
        <?php echo WPT_PLUGIN_NAME; ?>
    </h1>

    <form method="post" action="options.php">
        <?php settings_fields('wpt-options'); ?>
        <?php do_settings_sections('wpt-options'); ?>

        <h2 class="title">
            <?php _e('API', 'wp-plugin-template'); ?>
        </h2>

        <table class="form-table">
            <tr valign="top">
                <th scope="row">
                    <?php _e('Enabled', 'wp-plugin-template'); ?>
                </th>
                <td>
                    <label>
                        <input type="radio" name="wpt_cron_enabled" value="0" <?php checked(0, esc_attr(setting('cron_enabled'))); ?>>
                        <span>
                            No
                        </span>
                    </label>
                    <br><br>
                    <label>
                        <input type="radio" name="wpt_cron_enabled" value="1" <?php checked(1, esc_attr(setting('cron_enabled'))); ?>>
                        <span>
                            Yes
                        </span>
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Text', 'wp-plugin-template'); ?>
                </th>
                <td>
                    <input type="text" name="wpt_text_option" value="<?php echo esc_attr(setting('text_option')); ?>">
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Radio', 'wp-plugin-template'); ?>
                </th>
                <td>
                    <label>
                        <input type="radio" name="wpt_radio_option" value="0" <?php checked(0, esc_attr(setting('radio_option', 0))); ?>>
                        <span>
                            No
                        </span>
                    </label>
                    <br><br>
                    <label>
                        <input type="radio" name="wpt_radio_option" value="1" <?php checked(1, esc_attr(setting('radio_option', 0))); ?>>
                        <span>
                            Yes
                        </span>
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Select', 'wp-plugin-template'); ?>
                </th>
                <td>
                    <select name="wpt_select_option">
                        <option value="1" <?php selected(setting('select_option'), 1); ?>>1</option>
                        <option value="10" <?php selected(setting('select_option'), 10); ?>>10</option>
                        <option value="25" <?php selected(setting('select_option'), 25); ?>>25</option>
                    </select>
                </td>
            </tr>
        </table>

        <hr>

        <h2>
            <?php _e('Cron Jobs', 'wp-plugin-template'); ?>
        </h2>

        <table class="form-table">
            <tr valign="top">
                <th scope="row">
                    <?php _e('Test', 'wp-plugin-template'); ?>
                </th>
                <td>
                    <label>
                        <input type="radio" name="wpt_test_cron_enabled" value="0" <?php checked(0, esc_attr(setting('test_cron_enabled'))); ?>>
                        <span>
                            No
                        </span>
                    </label>
                    <br><br>
                    <label>
                        <input type="radio" name="wpt_test_cron_enabled" value="1" <?php checked(1, esc_attr(setting('test_cron_enabled'))); ?>>
                        <span>
                            Yes
                        </span>
                    </label>
                </td>
            </tr>
        </table>

        <hr>

        <?php submit_button(); ?>
    </form>
</div>
