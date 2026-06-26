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
 * Manager utility class for handling operations related to snippets and categories.
 *
 * @package    local_textsnippets
 * @author     Abhinav Gandham <abhinavgandham@gmail.com>
 * @copyright  2026 Abhinav Gandham
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class manager {
    /**
     * Method that creates a new category with the provided name.
     *
     * @param string $name The name of the category to be created.
     * @return category The created category object.
     */
    private static function create_category(string $name): category {
        global $USER;

        $category = new category();
        $category->set('userid', $USER->id);
        $category->set('name', $name);
        $category->create();

        return $category;
    }

    /**
     * Method that creates a new snippet with the provided data.
     *
     * @param stdClass $data The data for creating the snippet, including label, content, and category.
     */
    public static function create_snippet(\stdClass $data) {
        global $USER, $DB;

        $snippet = new snippet();
        $snippet->set('userid', $USER->id);
        $category = $category = $DB->get_record(category::TABLE, ['userid' => $USER->id, 'name' => $data->category]);
        if ($category) {
            $snippet->set('categoryid', $category->id);
        } else {
            $category = self::create_category($data->category);
            $category = $DB->get_record(category::TABLE, ['userid' => $USER->id, 'name' => $data->category]);
            $snippet->set('categoryid', $category->id);
        }
        $snippet->set('label', $data->label);
        $snippet->set('content', $data->content['text']);
        $snippet->create();
    }

    /**
     * Method that deletes a snippet with the provided ID.
     *
     * @param int $id The ID of the snippet to be deleted.
     */
    public static function delete_snippet(int $id) {
        $snippet = new snippet($id);
        $snippet->delete();
    }

    public static function get_user_snippets(): array {
        global $USER, $DB;

        $snippets = [];
        $records = $DB->get_records(snippet::TABLE, ['userid' => $USER->id]);
        foreach ($records as $record) {
            $snippets[] = new snippet($record->id);
    }
        return $snippets;
    }
}
