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
 * Course list block settings
 *
 * @package    block_myresults
 * @copyright  2017 Tristan daCosta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

// if ($ADMIN->fulltree) {
     $options = array('', "access","ado_access", "ado", "ado_mssql", "borland_ibase", "csv", "db2", "fbsql", "firebird", "ibase", "informix72", "informix", "mssql", "mssql_n", "mssqlnative", "mysql", "mysqli", "mysqlt", "oci805", "oci8", "oci8po", "odbc", "odbc_mssql", "odbc_oracle", "oracle", "postgres64", "postgres7", "postgres", "proxy", "sqlanywhere", "sybase", "vfp");
    $settings->add(new admin_setting_configtext('block_myresults/dbhost', get_string('dbhost', 'block_myresults'), get_string('dbhost_desc', 'block_myresults'), 'localhost'));

    $settings->add(new admin_setting_configtext('block_myresults/dbport', get_string('dbport', 'block_myresults'), get_string('dbport_desc', 'block_myresults'), '3306'));

    $settings->add(new admin_setting_configtext('block_myresults/dbuser', get_string('dbuser', 'block_myresults'), '', ''));

    $settings->add(new admin_setting_configpasswordunmask('block_myresults/dbpass', get_string('dbpass', 'block_myresults'), '', ''));

    $settings->add(new admin_setting_configtext('block_myresults/dbname', get_string('dbname', 'block_myresults'), '', ''));

    $settings->add(new admin_setting_configtext('block_myresults/dbtable', get_string('dbtable', 'block_myresults'), get_string('dbtable_desc', 'block_myresults'), ''));

    $settings->add(new admin_setting_configcheckbox('block_myresults/debugdb', get_string('debugdb', 'block_myresults'), get_string('debugdb_desc', 'block_myresults'), 0));

	$name = 'block_myresults/blurb';
    $title = get_string('blurb', 'block_myresults');
    $description = get_string('blurbdesc', 'block_myresults');
    $default = '';
	$setting = new admin_setting_confightmleditor($name,
         $title, $description, $default);
	$settings->add($setting);

    // Enable or disable outcomes.
    $name = 'block_myresults/enableoutcomes';
    $title = get_string('enableoutcomes', 'block_myresults');
    $description = get_string('enableoutcomes', 'block_myresults');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $settings->add($setting);

    // // Group award course list
    // $settings->add(new admin_setting_configtext('block_myresults/show_ga', get_string('show_ga', 'block_myresults'), get_string('show_ga_desc', 'block_myresults'), '', PARAM_NOTAGS, 75));

    // // Help button & modal header colour
    // $name = 'block_myresults/modalbg';
    // $title = get_string('modalbg', 'block_myresults');
    // $description = get_string('modalbgdesc', 'block_myresults');
    // $previewconfig = null;
    // $setting = new admin_setting_configcolourpicker($name, $title, $description, '#4d5351', $previewconfig);
    // $settings->add($setting);

    // Modal icon
    $settings->add(new admin_setting_configtext('block_myresults/fa_icon', get_string('fa_icon', 'block_myresults'), get_string('fa_icon_desc', 'block_myresults'), 'fa-question-circle-o'));

    // Enable or disable overdue notifications.
    $name = 'block_myresults/enableoverdue';
    $title = get_string('enableoverdue', 'block_myresults');
    $description = get_string('enableoverdue_desc', 'block_myresults');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $settings->add($setting);

    // overdue allowance in weeks
    $options = range(0,6);
    $settings->add(new admin_setting_configselect('block_results/allowance',
        get_string('allowance', 'block_myresults'),
        get_string('allowance_desc', 'block_myresults'), '2', $options));

	// // Course Background Colour.
 //    $name = 'block_myresults/coursebg';
 //    $title = get_string('coursebg', 'block_myresults');
 //    $description = get_string('coursebgdesc', 'block_myresults');
 //    $previewconfig = null;
 //    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#4d5351', $previewconfig);
 //    $settings->add($setting);

 //    // Course Font Colour.
 //    $name = 'block_myresults/coursefont';
 //    $title = get_string('coursefont', 'block_myresults');
 //    $description = get_string('coursefontdesc', 'block_myresults');
 //    $previewconfig = null;
 //    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#ffffff', $previewconfig);
 //    $settings->add($setting);

 //    // Session Background Colour.
 //    $name = 'block_myresults/sessionbg';
 //    $title = get_string('sessionbg', 'block_myresults');
 //    $description = get_string('sessionbgdesc', 'block_myresults');
 //    $previewconfig = null;
 //    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#009688', $previewconfig);
 //    $settings->add($setting);

 //    // Session Font Colour.
 //    $name = 'block_myresults/sessionfont';
 //    $title = get_string('sessionfont', 'block_myresults');
 //    $description = get_string('sessionfontdesc', 'block_myresults');
 //    $previewconfig = null;
 //    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#ffffff', $previewconfig);
 //    $settings->add($setting);

 //    // Result Background Colour.
 //    $name = 'block_myresults/resultbg';
 //    $title = get_string('resultbg', 'block_myresults');
 //    $description = get_string('resultbgdesc', 'block_myresults');
 //    $previewconfig = null;
 //    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#ffffff', $previewconfig);
 //    $settings->add($setting);

 //    // Pass Font Colour.
 //    $name = 'block_myresults/passfont';
 //    $title = get_string('passfont', 'block_myresults');
 //    $description = get_string('passfontdesc', 'block_myresults');
 //    $previewconfig = null;
 //    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#7ad27a', $previewconfig);
 //    $settings->add($setting);

 //    // Fail Font Colour.
 //    $name = 'block_myresults/failfont';
 //    $title = get_string('failfont', 'block_myresults');
 //    $description = get_string('failfontdesc', 'block_myresults');
 //    $previewconfig = null;
 //    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#fd7676', $previewconfig);
 //    $settings->add($setting);

 //    // No Grade Font Colour.
 //    $name = 'block_myresults/nogradefont';
 //    $title = get_string('nogradefont', 'block_myresults');
 //    $description = get_string('nogradefontdesc', 'block_myresults');
 //    $previewconfig = null;
 //    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#efefef', $previewconfig);
 //    $settings->add($setting);

 //    // Withdrawn Font Colour.
 //    $name = 'block_myresults/withdrawnfont';
 //    $title = get_string('withdrawnfont', 'block_myresults');
 //    $description = get_string('withdrawnfontdesc', 'block_myresults');
 //    $previewconfig = null;
 //    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#efefef', $previewconfig);
 //    $settings->add($setting);

 //    // Subjects Top Background Colour.
 //    $name = 'block_myresults/subjecttopbg';
 //    $title = get_string('subjecttopbg', 'block_myresults');
 //    $description = get_string('subjecttopbgdesc', 'block_myresults');
 //    $previewconfig = null;
 //    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#4d5351', $previewconfig);
 //    $settings->add($setting);

 //    // Subjects Bottom Background Colour.
 //    $name = 'block_myresults/subjectbottombg';
 //    $title = get_string('subjectbottombg', 'block_myresults');
 //    $description = get_string('subjectbottombgdesc', 'block_myresults');
 //    $previewconfig = null;
 //    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#009688', $previewconfig);
 //    $settings->add($setting);

 //    // Subjects Font Colour.
 //    $name = 'block_myresults/subjectfont';
 //    $title = get_string('subjectfont', 'block_myresults');
 //    $description = get_string('subjectfontdesc', 'block_myresults');
 //    $previewconfig = null;
 //    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#ffffff', $previewconfig);
 //    $settings->add($setting);

// }


