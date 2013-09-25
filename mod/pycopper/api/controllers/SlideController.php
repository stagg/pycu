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

class SlideController extends BaseController {
    public function getAction($request)
    {
        // TODO: Implement getAction() method.
        //Return the view!
        $url_elements = $request->getUrlElements();
        if (isset($url_elements[2])) {
            $id = (int)$url_elements[2];
            $body = new stdClass();
            switch($id) {
                case 2:
                    $body->id = $id;
                    $body->name = 'Scrum_Checklist_by_Randy_Beggs';
                    $body->author = 'Randy Beggs';
                    $body->url = 'data/Scrum_Checklist_by_Randy_Beggs/Scrum_Checklist_by_Randy_Beggs.htm';
                    break;
                case 4:
                    $body->id = $id;
                    $body->name = 'CSP-325';
                    $body->author = '';
                    $body->url = 'data/CSP-325/CSP-325.htm';
                    break;
            }
            RestUtils::sendResponse(200, json_encode($body), 'application/json');
        }
    }

    public function postAction($request)
    {
        // TODO: Implement postAction() method.
    }

    public function putAction($request)
    {
        // TODO: Implement putAction() method.
    }

    public function deleteAction($request)
    {
        // TODO: Implement putAction() method.
    }
}