<?php
/**
 * @package python_copper
 * @author joshstagg
 * @copyright Josh Stagg
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require(dirname(__FILE__) . '/../../../config.php');
require_once('RESTlib.php');


spl_autoload_register('apiAutoload');

if(!RestUtils::processRequest()) {
    RestUtils::sendResponse(400);
}

function apiAutoload($classname)
{
    if (file_exists (__DIR__ .'/controllers/'.$classname.'.php')) {
        if (preg_match('/[a-zA-Z]+Controller$/', $classname)) {
            include __DIR__ . '/controllers/' . $classname . '.php';
            return true;
        } elseif (preg_match('/[a-zA-Z]+Model$/', $classname)) {
            include __DIR__ . '/models/' . $classname . '.php';
            return true;
        } elseif (preg_match('/[a-zA-Z]+View$/', $classname)) {
            include __DIR__ . '/views/' . $classname . '.php';
            return true;
        }
    }
    return false;
}

