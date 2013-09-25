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

class UsersController extends BaseController{
    private $user_list = array( 1 => 'tim', 4 => 'john',  3=> 'kim');
    public function getAction($request)
    {
        $url_elements = $request->getUrlElements();
        if (isset($url_elements[2]) && !empty($url_elements[2])) {
            $user_id = (int)$url_elements[2];
            if (isset($this->user_list[$user_id])) {
                $body = $this->user_list[$user_id];
            } else {
                $body = '';
            }

        } else {
            $body = $this->user_list;
        }
        RestUtils::sendResponse(200, json_encode($body), 'application/json');
    }

    public function postAction($request)
    {
        // TODO: Implement postAction() method.
        $data = $request->getRequestVars();
        RestUtils::sendResponse(200, json_encode($data['name']), 'application/json');
    }

    public function putAction($request)
    {
        // TODO: Implement putAction() method.
    }

}