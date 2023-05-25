<?php

use core_external\util as external_util;

/**
 * Form for editing HTML block instances.
 *
 * @package   block_testblock
 * @copyright 1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class block_testblock extends block_base {
    function init() {
        $this->title = get_string('pluginname', 'block_testblock');
    }

    function get_results() {
        // Search Term
        $searchTerm = "Moodle Blocks";

        // API Key and Search Engine ID
        $apiKey = ''; // Enter your API Key here
        $searchEngineId = '36e7c6cc2801d7e56';

        // API endpoint
        $endpoint = 'https://www.googleapis.com/customsearch/v1';

        // Number of results to retrieve
        $numResults = 10;

        // Construct the API URL
        $url = $endpoint . '?key=' . $apiKey . '&cx=' . $searchEngineId . '&q=' . urlencode($searchTerm) . '&num=' . $numResults;

        // Make the API call
        $response = file_get_contents($url);

        // Decode the JSON response
        $data = json_decode($response, true);

        // Check if there are search results
        if (isset($data['items'])) {
	    $formatted = "";
            // Iterate over each search result and print the title and link
            foreach ($data['items'] as $item) {
                $title = $item['title'];
                $link = $item['link'];
		
		$result .= '<h2>' . $title . '</h2>' . '<br>' . '<a href="' . $link . '">' . $link . '</a><br><br>';
            }
        } else {
            $result = 'No search results found.';
        }
	
	return $result;
    }

    function get_content() {
        $this->content = new stdClass;
	$this->content->text = $this->get_results();
        $this->content->footer = 'This is the footer';
        return $this->content;
    }
}
