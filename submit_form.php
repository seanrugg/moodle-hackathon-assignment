<?php
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/course/moodleform.php');

class mod_hackathon_submit_form extends moodle_form {
    public function definition() {
        $mform = $this->_form;
        global $DB;
        
        // We need to fetch the instance settings to determine which fields are mandatory/type
        // In a real Moodle env, we would pass the $hackathon object to the constructor
        
        $mform->addElement('text', 'slides_url', 'Slides (Link or File Path)');
        $mform->addElement('text', 'video_url', 'Demo Video (Link or File Path)');
        $mform->addElement('text', 'site_url', 'Demo Site (Link)');
        $mform->addElement('text', 'repo_url', 'Code Repo (Link)');
        
        $mform->addElement('submit', 'submit', 'Submit Project');
    }
}
