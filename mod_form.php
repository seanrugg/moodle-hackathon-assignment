<?php
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/course/moodleform.php');

class mod_hackathon_mod_form extends moodle_course_module_form {
    public function definition() {
        $mform = $this->_form;

        $mform->addElement('header', 'general');
        $mform->addElement('text', 'name', get_string('modname', 'mod_hackathon'), array('size' => '64'));
        $mform->setType('name', FORM_REQUIRED);
        $mform->addElement('editor', 'intro', get_string('description', 'mod_hackathon'), IMAGE_CKEDITOR);
        $mform->setType('intro', FORM_OPTIONAL);

        $mform->addElement('header', 'submission_settings');
        
        // Slides
        $mform->addElement('checkbox', 'slides_mandatory', get_string('mod_hackathon_slides', 'mod_hackathon') . ' Mandatory');
        $mform->addElement('select', 'slides_type', 'Slides Submission Type', 
            array(0 => 'File Only', 1 => 'Link Only', 2 => 'Either'));
        $mform->setDefault('slides_type', 2);

        // Video
        $mform->addElement('checkbox', 'video_mandatory', get_string('mod_hackathon_video', 'mod_hackathon') . ' Mandatory');
        $mform->addElement('select', 'video_type', 'Video Submission Type', 
            array(0 => 'File Only', 1 => 'Link Only', 2 => 'Either'));
        $mform->setDefault('video_type', 2);

        // Site & Repo
        $mform->addElement('checkbox', 'site_mandatory', get_string('mod_hackathon_site', 'mod_hackathon') . ' Mandatory');
        $mform->addElement('checkbox', 'repo_mandatory', get_string('mod_hackathon_repo', 'mod_hackathon') . ' Mandatory');

        $mform->addElement('header', 'group_settings');
        $mform->addElement('select', 'groupmode', get_string('groupmode'), 
            array(0 => get_string('nogroups', 'core'), 
                  1 => get_string('separategroups', 'core'), 
                  2 => get_string('visiblegroups', 'core')));

        // Grading integration - using Moodle's core grading options
        $mform->addElement('header', 'grading_settings');
        $mform->addElement('select', 'gradingmethod', get_string('gradingmethod'), 
            array(0 => get_string('simplegrading', 'core'), 
                  1 => get_string('rubicgrading', 'core'), 
                  2 => get_string('guidegrading', 'core')));

        $this->standard_coursemodule_elements();
        $this->standard_coursemodule_buttons();
    }
}
