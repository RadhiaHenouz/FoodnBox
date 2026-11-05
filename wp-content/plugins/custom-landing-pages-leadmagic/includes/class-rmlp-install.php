<?php

/**
 * Installation related functions and actions
 *
 */
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Install Class.
 */
class RMLP_Install {

    public static function update_options() {
        $rmlp = RM_LP::instance();
        update_site_option('rmlp_version', $rmlp->version);
    }

}