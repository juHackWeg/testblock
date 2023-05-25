<?php

class block_testblock_edit_form extends block_edit_form {
    protected function specific_definition($mform) {
        $mform->addElement('text', 'config_searchstring', get_string('searchstring', 'block_testblock'));
        $mform->setType('config_searchstring', PARAM_TEXT);
    }
}
