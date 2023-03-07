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
 * MYRESULTS BLOCK
 *
 * @package    block_myresults
 * @copyright  2017 Tristan daCosta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class block_myresults extends block_base {

    function init() {
        $this->title = get_string('pluginname', 'block_myresults');
    }

    public function get_content() {
        global $CFG, $DB, $PAGE, $USER;
        
        if ($this->content !== null) {
          return $this->content;
        }

        if (empty($this->instance)) {
            $this->content = '';
            return $this->content;
        }

        $DB_DEBUG = get_config('block_myresults', 'debugdb');
        $intro = get_config('block_myresults', 'blurb');

        $this->content = new stdClass();
        $this->content->items = array();
        $this->content->text = array();
        $this->content->icons = array();
        $this->content->footer = '';
        $this->content->icons[] = html_writer::empty_tag('img', array('src' => 'images/icons/1.gif', 'class' => 'icon'));
        $gradeitems = '';
        if (strpos($USER->username, 'ec1') !== false || strpos($USER->username, 'ec2') !== false) {

            $gradeitems = $intro;
            // Wrap grades in main accordion
            $gradeitems .= '
            <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <div class="accordion" id="accordion1">
                <div class="accordion-group" id="main-group">
                    <div class="accordion-heading" id="main-heading">
                        <a id="loadcontent" class="accordion-toggle btn btn-primary" data-toggle="collapse" data-parent="#accordion1" href="#showResults"><i class="fa fa-eye"></i>
                        '.get_string('showresults', 'block_myresults').'
                        </a>
                        <div id="showResults" class="accordion-body collapse">
                            <div class="accordion-inner" id="main-inner">
                                <div id="fetched">
                                    <div class="loader" style="text-align:center;">
                                        <div id="preloader">
                                            <div id="loader">
                                            </div>
                                        </div>
                                        <h3 id="loading_message">'.get_string("please_wait", "block_myresults").'</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            if ($DB_DEBUG) {
                $gradeitems .= include_once "fetch.php";
            } else {
            $gradeitems .= '
                    <script>
                        $(document).ready(function () {
                            $("#loadcontent").one("click", function () {
                                console.log("results requested");
                                $("#fetched").load("../blocks/myresults/fetch.php");
                                console.log("loading");
                               setTimeout(function(){ $( "#loading_message" ).html( "<h3>'.get_string("longwait", "block_myresults").'</h3>" ); }, 10000);
                                setTimeout(function(){ $( "#loading_message" ).html( "<h3>'.get_string("longerwait", "block_myresults").'</h3>" ); }, 20000);
                                setTimeout(function(){ $( "#loading_message" ).html( "<h3>'.get_string("longestwait", "block_myresults").'</h3>" ); }, 30000);
                            });
                            $("#fetched").animate({
                                height: "auto"
                            },600);
                        });
                    </script>';
                    // $gradeitems .= '
                    //     <script type="text/javascript">
                    //         $(document).ready(function(){
                    //             $(".btn-group .btn").click(function(){
                    //                 var inputValue = $(this).find("input").val();
                    //                 if(inputValue != &apos;all&apos;){
                    //                     var target = $(&apos;table tr[data-status="&apos; + inputValue + &apos;"]&apos;);
                    //                     $("table tbody tr").not(target).hide();
                    //                     target.fadeIn();
                    //                 } else {
                    //                     $("table tbody tr").fadeIn();
                    //                 }
                    //             });
                    //             // Changing the class of status label to support Bootstrap 4
                    //             var bs = $.fn.tooltip.Constructor.VERSION;
                    //             var str = bs.split(".");
                    //             if(str[0] == 4){
                    //                 $(".label").each(function(){
                    //                     var classStr = $(this).attr("class");
                    //                     var newClassStr = classStr.replace(/label/g, "badge");
                    //                     $(this).removeAttr("class").addClass(newClassStr);
                    //                 });
                    //             }
                    //         });
                    //     </script>';
            }
                    
        } // END "if student"
        
        $this->content->text = $gradeitems;

    } //END PUBLIC FUNCTION get_content


    public function applicable_formats() {
        return array('site-index' => true, 'my' => true,);
    }

    public function instance_allow_multiple() {
          return false;
    }
    
    function has_config() {return true;}

} // END class block_myresults
