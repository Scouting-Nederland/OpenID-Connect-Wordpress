<?php
/**
 * Show the user profile fields in the user profile and edit user profile pages
 * 
 * @param WP_User $user The user object
 */
function scouting_oidc_user_profile_fields($user) {
    ?>
    <h2><?php esc_html_e('Scouts Online (SOL) Profile Information', 'scouting-openid-connect'); ?></h2>

    <table class="form-table" role="presentation">
        <?php
        if (get_option('scouting_oidc_user_scouting_id')) {
            ?>
            <tr>
                <th><label for="scouting_id"><?php esc_html_e('Scouting ID', 'scouting-openid-connect'); ?></label></th>
                <td>
                    <input type="text" name="scouting_id" id="scouting_id" value="<?php echo esc_attr(get_the_author_meta('scouting_oidc_id', $user->ID)); ?>" class="regular-text" readonly disabled/>
                </td>
            </tr>
            <?php
        }
        if (get_option('scouting_oidc_user_birthdate')) {
            ?>
            <tr>
                <th><label for="birthdate"><?php esc_html_e('Birthdate', 'scouting-openid-connect'); ?></label></th>
                <td>
                    <input type="date" name="birthdate" id="birthdate" value="<?php echo esc_attr(get_the_author_meta('scouting_oidc_birthdate', $user->ID)); ?>" class="regular-text" readonly disabled/>
                </td>
            </tr>
            <?php
        }
        if (get_option('scouting_oidc_user_gender')) {
            ?>
            <tr>
                <th><label for="gender"><?php esc_html_e("Gender", "scouting-openid-connect"); ?></label></th>
                <td>
                    <select name="gender" id="gender" style="width: 15em;" disabled>
                        <option value="male" <?php selected(get_the_author_meta('scouting_oidc_gender', $user->ID), 'male'); ?>><?php esc_html_e('Male', 'scouting-openid-connect'); ?></option>
                        <option value="female" <?php selected(get_the_author_meta('scouting_oidc_gender', $user->ID), 'female'); ?>><?php esc_html_e('Female', 'scouting-openid-connect'); ?></option>
                        <option value="other" <?php selected(get_the_author_meta('scouting_oidc_gender', $user->ID), 'other'); ?>><?php esc_html_e('Other', 'scouting-openid-connect'); ?></option>
                        <option value="unknown" <?php selected(get_the_author_meta('scouting_oidc_gender', $user->ID), 'unknown'); ?>><?php esc_html_e('Unknown', 'scouting-openid-connect'); ?></option>
                    </select>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}

/**
 * Move infix field between first and last name fields
 * 
 * @param WP_User $user The user object
 */
function add_infix_field_between_names($user) {
    ?>
    <table class="user-infix-table">
        <tr class="user-infix-name-wrap">
            <th><label for="infix"><?php esc_html_e('Infix', 'scouting-openid-connect'); ?></label></th>
            <td>
                <input type="text" name="infix" id="infix" value="<?php echo esc_attr(get_the_author_meta('scouting_oidc_infix', $user->ID)); ?>" class="regular-text" />
            </td>
        </tr>
    </table>
    <script type="text/javascript" defer>
        document.addEventListener("DOMContentLoaded", function() {
            var infixRow = document.querySelector('.user-infix-name-wrap');
            var firstNameRow = document.querySelector('.user-first-name-wrap');
            var table = document.querySelector('.user-infix-table');
            firstNameRow.parentNode.insertBefore(infixRow, firstNameRow.nextSibling);
            table.remove();
        });
    </script>
    <?php
}
?>