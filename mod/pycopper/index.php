<?php
/**
 * @package python_copper
 * @author joshstagg
 * @copyright Josh Stagg
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require(dirname(__FILE__) . '/../../config.php');
require_login();

//api request
$uri = $_SERVER['REQUEST_URI'];
$url_parts = explode('?', $uri);
if (sizeof($url_parts) === 2 && isset($url_parts[1])) { // TODO Strengthen this check
    require('api/index.php');
} else {
    // Core Template
    echo file_get_contents( __DIR__.'/templates/core.html');
}
