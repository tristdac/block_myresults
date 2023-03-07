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
 * Strings for component 'block_myresults', language 'en'
 *
 * @package   block_myresults
 * @copyright 2017 Tristan daCosta
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['myresults:addinstance'] = 'Add a myresults block';
$string['myresults:myaddinstance'] = 'Add a myresults block to my moodle';
$string['pluginname'] = 'My Results';

// GLOBAL SETTINGS
$string['showresults'] = 'Show My Results';
$string['blurb'] = 'Introduction';
$string['blurbdesc'] = 'Short introduction will appear above results. Try to keep it short and sweet and use dynamic HTML elements to display more information';
$string['coursebg'] = 'Course Title Heading Background Colour';
$string['coursebgdesc'] = 'Course Title Heading Background Colour';
$string['coursefont'] = 'Course Title Heading Font Colour';
$string['coursefontdesc'] = 'Ensure contrasting colour to background';
$string['sessionbg'] = 'Session Block Background Colour';
$string['sessionbgdesc'] = 'Session Block Background Colour';
$string['sessionfont'] = 'Session Block Font Colour';
$string['sessionfontdesc'] = 'Ensure contrasting colour to background';
$string['resultbg'] = 'Result Block Background Colour';
$string['resultbgdesc'] = 'Result Block Background Colour';
$string['passfont'] = 'Pass Icon Colour';
$string['passfontdesc'] = 'Usually a green shade';
$string['failfont'] = 'Fail Icon Colour';
$string['failfontdesc'] = 'Usually a red shade';
$string['nogradefont'] = 'No Grade Icon Colour';
$string['nogradefontdesc'] = 'The icon colour when no grade has been entered';
$string['withdrawnfont'] = 'Withdrawn Icon Colour';
$string['withdrawnfontdesc'] = 'Usually an amber shade';
$string['subjecttopbg'] = 'Subjects Top Background Colour';
$string['subjecttopbgdesc'] = 'Subjects dropdown list uses linear gradient top to bottom';
$string['subjectbottombg'] = 'Subjects Bottom Background Colour';
$string['subjectbottombgdesc'] = 'If you dont want to use a gradient background, select the same colour as "Subjects Top Background Colour"';
$string['subjectfont'] = 'Subjects Font Colour';
$string['subjectfontdesc'] = 'Ensure contrasting colour to both top and bottom gradient colours';
$string['dbhost'] = 'Database host';
$string['dbport'] = 'Database port';
$string['dbname'] = 'Database name';
$string['dbuser'] = 'Database user';
$string['dbpass'] = 'Database password';
$string['dbencoding'] = 'Database encoding';
$string['dbport_desc'] = 'Port to use on remote DB. Defaults to "3306" if empty';
$string['dbhost_desc'] = 'Type database server IP address or host name';
$string['dbtable'] = 'Remote table';
$string['dbtable_desc'] = 'Remote table name in which results data is stored';
$string['debugdb'] = 'Debug Connection';
$string['debugdb_desc'] = 'Debug connection and queries to external database';
$string['understanding_heading'] = 'Understanding Your Results';
$string['understanding_content'] = "<p>Here is some help on understanding the results you see. If you have a question that hasn't been answered here, please speak to your LDT or course tutor.</p><table id='help_table'>

<tr><td class='himage' id='sess'><span class='sesh' style='position:initial'><i class='fa fa-calendar'></i> 2018/2019</span></td><td>The academic year in which your course commenced</td></tr>

<tr><td class='himage' id='ga'><span class='ga'><i class='fa fa-trophy'></i> Group Award</span></td><td>Group Award results will be available once released by the Awarding Body.</td></tr>

<tr><td class='himage' id='gu'><span class='label-A'>A</span> <span class='label-B'>B</span> <span class='label-C'>C</span></td><td>Your successful result of a Graded Unit</td></tr>

<tr><td class='himage' id='success'><span class='label-Pass'>Pass</span></td><td>You have passed or have been successful</td></tr>

<tr><td class='himage' id='unsuc'><span class='label-Fail'>Fail</span></td><td>You have not been successful</td></tr>

<tr><td class='himage' id='trans'><span class='label-Withdrawn'>Withdrawn</span> <span class='label-Transferred'>Transferred</span></td><td>You were either transferred or withdrawn from this unit</td></tr>

<tr><td class='himage' id='nores'><span class='label-No Result'>No Result</span></td><td>No result has been entered for this unit</td></tr>

<tr><td class='himage' id='resover'><div class='overdue'><i class='fa fa-clock-o'></i> Awaiting Result</div></td><td>This unit has passed it's completion date but no result has been entered... check back again soon</td></tr>

</table><p><h5>Think there's an error with your results?</h5><p>In the first instance, contact the lecturer who delivered unit in question. Failing that, discuss this with your LDT (if you have one) or one of your current lecturers.</p><p></p>";
$string['seemore'] = 'See unit results';
$string['enableoutcomes'] = "Enable Outcomes";
$string['enableoutcomesdesc'] = "Enable or disable the display of outcomes per course";
// $string['show_ga'] = 'Courses to show Group Award Result';
// $string['show_ga_desc'] = 'Some courses (mainly Higher & Nats) record relevant results against the group award. Add course codes in the box (comma seperated) for courses which we should display the results of group awards. All others are ignored.';
$string['modalbg'] = 'Modal button and header background';
$string['modalbgdesc'] = 'Looks best if colour mimics your themes primary colour, but should be a dark color as font is white.';
$string['fa_icon'] = 'Help Icon';
$string['fa_icon_desc'] = 'Usage: Enter full name of Font Awesome icon (including any <a href="http://fontawesome.io/examples/" target="new">extensions</a>. ie fa-2x). <a href="http://fontawesome.io/icons/" target="new">Click here</a> for full list.';
$string['levelhelp'] = 'You have been resulted at a different level for this unit. Your lecturer may level you up or down where appropriate.';
$string['gotit'] = 'Got it <i class="fa fa-thumbs-up"></i>';
$string['please_wait'] = 'Retrieving results...';
$string['longwait'] = "... Calculating results";
$string['longerwait'] = "... Translating results";
$string['longestwait'] = "Things are taking a bit longer than expected... please be patient";
$string['enableoverdue'] = "Enable Overdue Notification";
$string['enableoverdue_desc'] = "Will show 'Awaiting Result' next to results are overdue (determined by allowance setting below)";
$string['allowance'] = "Overdue Result Allowance";
$string['allowance_desc'] = "Number of weeks allowance given after end date before showing 'Awaiting Result' to students";
