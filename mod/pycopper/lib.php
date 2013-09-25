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
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function pycopper_add_instance($data, $mform = null) {
    global $CFG, $DB;
    require_once("$CFG->libdir/resourcelib.php");

    $cmid = $data->coursemodule;

    $data->timemodified = time();

    $data->id = $DB->insert_record('pycopper', $data);
    return $data->id;
}

/**
 * Update page instance.
 * @param object $data
 * @param object $mform
 * @return bool true
 */
function pycopper_update_instance($data, $mform) {
    global $CFG, $DB;
    require_once("$CFG->libdir/resourcelib.php");

    $data->id  = $data->instance;

    $DB->update_record('pycopper', $data);

    return true;
}

/**
 * Delete page instance.
 * @param int $id
 * @return bool true
 */
function pycopper_delete_instance($id) {
    global $DB;

    if (!$page = $DB->get_record('pycopper', array('id'=>$id))) {
        return false;
    }

    // note: all context files are deleted automatically

    $DB->delete_records('pycopper', array('id'=>$page->id));

    return true;
}