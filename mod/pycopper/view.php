<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package
 * @subpackage
 * @author joshstagg
 * @copyright Josh Stagg
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../config.php');

require_login();

if (isset($_POST['id'])) {       // POST has precedence
    $param = $_POST['id'];
} else if (isset($_GET['id'])) {
    $param = $_GET['id'];
} else {
    print_error('missingparam', '', '', 'id');
}

redirect(new moodle_url("/mod/pycopper/#/slide/$param"));
