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
 * Main snippets page.
 *
 * @package    local_feedbackbank
 * @author     Abhinav Gandham <abhinavgandham@gmail.com>
 * @copyright  2026 Abhinav Gandham
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */


require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/classes/snippet.php');
require_once(__DIR__ . '/classes/category.php');
require_once(__DIR__ . '/createsnippet_form.php');
require_once(__DIR__ . '/classes/manager.php');
require_once(__DIR__ . '/classes/snippet_table.php');
require_login();

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/local/feedbackbank/snippets.php'));
$PAGE->set_title(get_string('pluginname', 'local_feedbackbank'));
$PAGE->set_heading(get_string('pluginname', 'local_feedbackbank'));

$action = optional_param('action', '', PARAM_ALPHA);
$id     = optional_param('id', 0, PARAM_INT);

if ($action === 'delete' && $id) {
    require_sesskey();
    manager::delete_snippet($id);
    redirect($PAGE->url);
}

$createsnippetform = new createsnippet_form();

if ($createsnippetform->is_cancelled()) {
    redirect($PAGE->url);
} else if ($createsnippetform->get_data()) {
    manager::create_snippet($createsnippetform->get_data());
}

echo $OUTPUT->header();

echo get_string('managesnippets', 'local_feedbackbank');

echo $createsnippetform->render();

$table = new snippet_table();
$table->render();

echo $OUTPUT->footer();
