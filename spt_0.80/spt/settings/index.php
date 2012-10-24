<?php

/**
 * file:    index.php
 * version: 36.0
 * package: Simple Phishing Toolkit (spt)
 * component:   Settings
 * copyright:   Copyright (C) 2011 The SPT Project. All rights reserved.
 * license: GNU/GPL, see license.htm.
 * 
 * This file is part of the Simple Phishing Toolkit (spt).
 * 
 * spt is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, under version 3 of the License.
 *
 * spt is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with spt.  If not, see <http://www.gnu.org/licenses/>.
 * */

// verify session is authenticated and not hijacked
$includeContent = "../includes/is_authenticated.php";
if ( file_exists ( $includeContent ) ) {
    require_once $includeContent;
} else {
    header ( 'location:../errors/404_is_authenticated.php' );
}
?>

<!DOCTYPE HTML> 
<html>
    <head>
        <title>spt - settings</title>
        <!--meta-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="welcome to spt - simple phishing toolkit.  spt is a super simple but powerful phishing toolkit." />
        <!--favicon-->
        <link rel="shortcut icon" href="../images/favicon.ico" />
        <!--css-->
        <link rel="stylesheet" href="../includes/jquery-ui.css" type="text/css" />
        <link rel="stylesheet" href="../includes/spt.css" type="text/css" />
        <link rel="stylesheet" href="spt_settings.css" type="text/css" />
        <!--scripts-->
        <script type="text/javascript" src="../includes/escape.js"></script>
        <script src="../includes/jquery.min.js"></script>
        <script src="../includes/jquery-ui.min.js"></script>
        <script>
            $(function() {
                $( "#tabs" ).tabs();
            });
        </script>
        <script language="Javascript" type="text/javascript">
            function updateSetting(setting,value) 
            { 
                //begin new request
                xmlhttp = new XMLHttpRequest();

                //send update request
                xmlhttp.open("POST","update_setting.php",true);
                xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                xmlhttp.send("setting="+setting+"&value="+value); 
            }
        </script> 
    </head>
    <body>
        <!--alert-->
        <?php include '../includes/alert.php'; ?>                 
        <div id="wrapper">
            <!--sidebar-->
            <?php include '../includes/sidebar.php'; ?>                 
            <!--popovers-->
            <?php
                if(isset($_GET['add_module']) && $_GET['add_module'] == "true"){
                    echo '
                        <div id="add_module">
                            <div>
                                <form action="module_upload.php" method="post" enctype="multipart/form-data">
                                    <table id="upload_module">
                                        <tr>
                                            <td style="text-align: left;"><h3>Add Module</h3></td>
                                            <td style="text-align: right;">
                                                <a class="tooltip"><img src="../images/lightbulb_sm.png" alt="help" /><span>Select the module file to be uploaded and click the add button.  You can only upload modules packaged using the ZIP file format.<br /><br />Be sure to see the documentation section of the spt website for full details on the required contents of a module.</span></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <input type="file"  name="file" />
                                            </td>
                                        </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: center;"><br /><a href=".#tabs-5"><img id="add_module_cancel" src="../images/cancel.png" alt="cancel" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="image" src="../images/accept.png" alt="accept" /></td>
                                    </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    ';                    
                }
                if(isset($_GET['add_smtp_server']) && $_GET['add_smtp_server'] == 'true' ){
                    echo '
                        <div id="add_smtp_server">
                            <div>
                                <table id="add_smtp_server_table">
                                    <tr>
                                        <form method="POST" action="smtp_add.php" />
                                            <tr>
                                                <td colspan=2 style="text-align: left;"><h3>Add SMTP Server</h3></td>
                                                <td style="text-align: right;">
                                                    <a class="tooltip"><img src="../images/lightbulb_sm.png" alt="help" /><span>Add the appropriate SMTP information for a new SMTP server to be used within campaigns and/or as the system\'s mail relay for system based email notification.</span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Host</td>
                                                <td style="text-align: left;"><input type="text" name="host" ';
                                                if(isset($_SESSION['temp_host'])){
                                                    echo 'value="'.$_SESSION['temp_host'].'"';
                                                    unset($_SESSION['temp_host']);
                                                }
                                                echo '/></td>
                                            </tr>
                                            <tr>
                                                <td>Port</td>
                                                <td style="text-align: left;"><input type="text" name="port" ';
                                                if(isset($_SESSION['temp_port'])){
                                                    echo 'value="'.$_SESSION['temp_port'].'"';
                                                    unset($_SESSION['temp_port']);
                                                }
                                                echo '/></td>
                                            </tr>
                                            <tr>
                                                <td>SSL</td>
                                                <td style="text-align: left;"><input type="checkbox" name="ssl" ';
                                                if(isset($_SESSION['temp_ssl'])){
                                                    echo 'CHECKED';
                                                    unset($_SESSION['temp_ssl']);
                                                }
                                                echo '/></td>
                                            </tr>
                                            <tr>
                                                <td>Username</td>
                                                <td style="text-align: left;"><input type="text" name="username" ';
                                                if(isset($_SESSION['temp_username'])){
                                                    echo 'value="'.$_SESSION['temp_username'].'"';
                                                    unset($_SESSION['temp_username']);
                                                }
                                                echo '/></td>    
                                            </tr>
                                            <tr>
                                                <td>Password</td>
                                                <td style="text-align: left;"><input type="password" name="password" ';
                                                if(isset($_SESSION['temp_password'])){
                                                    echo 'value="'.$_SESSION['temp_password'].'"';
                                                    unset($_SESSION['temp_password']);
                                                }
                                                echo '/></td>
                                            </tr>
                                            <tr>
                                                <td>Default SMTP Server</td>
                                                <td style="text-align: left;"><input type="checkbox" name="default" ';
                                                if(isset($_SESSION['temp_default'])){
                                                    echo 'CHECKED';
                                                    unset($_SESSION['temp_default']);
                                                }
                                                echo '/></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;"><br /><a href=".#tabs-2"><img id="add_smtp_server_cancel" src="../images/cancel.png" alt="cancel" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="image" src="../images/accept.png" alt="accept" /></td>
                                            </tr>
                                        </form>
                                    </tr>
                                </table>
                             </div>
                        </div>
                    ';
                }
                if(isset($_GET['edit_smtp_server'])){
                    //get smtp server
                    $smtp_server = $_GET['edit_smtp_server'];
                    $r = mysql_query("SELECT value FROM settings WHERE setting = 'smtp'");
                    while ($ra = mysql_fetch_assoc($r)){
                        $current_smtp_server = explode("|", $ra['value']);
                        if($current_smtp_server[0] == $smtp_server){
                            $smtp_server_host = $current_smtp_server[0]; 
                            $smtp_server_port = $current_smtp_server[1];
                            $smtp_server_ssl = $current_smtp_server[2];
                            $smtp_server_username = $current_smtp_server[3];
                            $smtp_server_password = $current_smtp_server[4];
                            $smtp_server_default = $current_smtp_server[5];
                        }
                    }
                    if(!isset($smtp_server_host)){
                        $_SESSION['alert_message'] = "please select an existing smtp server";
                        header('location:.#tabs-2');
                        exit;
                    }
                    echo '
                        <div id="edit_smtp_server">
                            <div>
                                <table id="edit_smtp_server_table">
                                    <tr>
                                        <form method="POST" action="smtp_edit.php" />
                                            <tr>
                                                <td colspan=2 style="text-align: left;"><h3>Edit SMTP Server</h3></td>
                                                <td style="text-align: right;">
                                                    <a class="tooltip"><img src="../images/lightbulb_sm.png" alt="help" /><span>Edit the smtp server information.  Don\'t worry about entering the password unless you want to change it.</span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Host</td>
                                                <td style="text-align: left;"><input type="text" name="host" value="'.$smtp_server_host.'"/></td>
                                            </tr>
                                            <tr>
                                                <td>Port</td>
                                                <td style="text-align: left;"><input type="text" name="port" value="'.$smtp_server_port.'"/></td>
                                            </tr>
                                            <tr>
                                                <td>SSL</td>
                                                <td style="text-align: left;"><input type="checkbox" name="ssl" ';
                                                if($smtp_server_ssl == 1){
                                                    echo 'CHECKED';
                                                }
                                                echo '/></td>
                                            </tr>
                                            <tr>
                                                <td>Username</td>
                                                <td style="text-align: left;"><input type="text" name="username" value="'.$smtp_server_username.'"/></td>    
                                            </tr>
                                            <tr>
                                                <td>Password</td>
                                                <td style="text-align: left;"><input type="password" name="password" /></td>
                                            </tr>
                                            <tr>
                                                <td>Default SMTP Server</td>
                                                <td style="text-align: left;"><input type="checkbox" name="default" ';
                                                if($smtp_server_default == 'default'){
                                                    echo 'CHECKED';
                                                }
                                                echo '/></td>
                                            </tr>
                                            <input type="hidden" name="current_host" value="'.$smtp_server_host.'" />
                                            <tr>
                                                <td colspan="2" style="text-align: center;"><br /><a href=".#tabs-2"><img id="add_smtp_server_cancel" src="../images/cancel.png" alt="cancel" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="image" src="../images/accept.png" alt="accept" /></td>
                                            </tr>
                                        </form>
                                    </tr>
                                </table>
                             </div>
                        </div>
                    ';
                }
                if(isset($_GET['test_smtp_server'])){
                    //get smtp server
                    $smtp_server = $_GET['test_smtp_server'];
                    $r = mysql_query("SELECT value FROM settings WHERE setting = 'smtp'");
                    while ($ra = mysql_fetch_assoc($r)){
                        $test_smtp_server = explode("|", $ra['value']);
                        if($test_smtp_server[0] == $smtp_server){
                            $test_smtp_server_host = $test_smtp_server[0]; 
                            $test_smtp_server_port = $test_smtp_server[1];
                            $test_smtp_server_ssl = $test_smtp_server[2];
                            $test_smtp_server_username = $test_smtp_server[3];
                            $test_smtp_server_default = $test_smtp_server[5];
                        }
                    }
                    if(!isset($test_smtp_server_host)){
                        $_SESSION['alert_message'] = "please select an existing smtp server";
                        header('location:.#tabs-2');
                        exit;
                    }
                    echo '
                        <div id="test_smtp_server">
                            <div>
                                <table id="test_smtp_server_table">
                                    <tr>
                                        <form method="POST" action="smtp_test.php" />
                                            <tr>
                                                <td colspan=2 style="text-align: left;"><h3>Test '.$test_smtp_server_host.'</h3></td>
                                                <td style="text-align: right;">
                                                    <a class="tooltip"><img src="../images/lightbulb_sm.png" alt="help" /><span>Enter an email address you\'d like to send a test message to and hit "Send It."  Check that email addresses mailbox and ensure you receive the email.  If the email is not there, then check your SMTP settings and try again.</span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Test Email</td>
                                                <td style="text-align: left;"><input type="text" name="test_email" /></td>
                                            </tr>
                                            <input type="hidden" name="current_host" value="'.$test_smtp_server_host.'"/>
                                            <tr>
                                                <td colspan="2" style="text-align: center;"><br /><a href=".#tabs-2"><img id="test_smtp_server_cancel" src="../images/cancel.png" alt="cancel" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="image" src="../images/accept.png" alt="accept" /></td>
                                            </tr>
                                        </form>
                                    </tr>
                                </table>
                             </div>
                        </div>
                    ';
                }
                if(isset($_GET['add_ldap_server']) && $_GET['add_ldap_server'] == 'true'){
                    echo '
                        <div id="add_ldap_server">
                            <div>
                                <table id="add_ldap_server_table">
                                    <tr>
                                        <form method="POST" action="ldap_add.php" />
                                            <tr>
                                                <td colspan=2 style="text-align: left;"><h3>Add LDAP Server</h3></td>
                                                <td style="text-align: right;">
                                                    <a class="tooltip"><img src="../images/lightbulb_sm.png" alt="help" /><span>Add the appropriate SMTP information for a new SMTP server to be used within campaigns and/or as the system\'s mail relay for system based email notification.</span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Host</td>
                                                <td style="text-align: left;"><input type="text" name="host" ';
                                                if(isset($_SESSION['temp_host'])){
                                                    echo 'value="'.$_SESSION['temp_host'].'"';
                                                    unset($_SESSION['temp_host']);
                                                }
                                                echo '/></td>
                                            </tr>
                                            <tr>
                                                <td>Port</td>
                                                <td style="text-align: left;"><input type="text" name="port" ';
                                                if(isset($_SESSION['temp_port'])){
                                                    echo 'value="'.$_SESSION['temp_port'].'"';
                                                    unset($_SESSION['temp_port']);
                                                }
                                                echo '/></td>
                                            </tr>
                                            <tr>
                                                <td>SSL</td>
                                                <td style="text-align: left;"><input type="checkbox" name="ssl" ';
                                                if(isset($_SESSION['temp_ssl'])){
                                                    echo 'CHECKED';
                                                    unset($_SESSION['temp_ssl']);
                                                }
                                                echo '/></td>
                                            </tr>
                                            <tr>
                                                <td>Username</td>
                                                <td style="text-align: left;"><input type="text" name="username" ';
                                                if(isset($_SESSION['temp_username'])){
                                                    echo 'value="'.$_SESSION['temp_username'].'"';
                                                    unset($_SESSION['temp_username']);
                                                }
                                                echo '/></td>    
                                            </tr>
                                            <tr>
                                                <td>Password</td>
                                                <td style="text-align: left;"><input type="password" name="password" ';
                                                if(isset($_SESSION['temp_password'])){
                                                    echo 'value="'.$_SESSION['temp_password'].'"';
                                                    unset($_SESSION['temp_password']);
                                                }
                                                echo '/></td>
                                            </tr>
                                            <tr>
                                                <td>Base DN</td>
                                                <td style="text-align: left;"><input type="text" name="basedn" ';
                                                if(isset($_SESSION['temp_basedn'])){
                                                    echo 'value="'.$_SESSION['temp_basedn'].'"';
                                                    unset($_SESSION['temp_basedn']);
                                                }                                                
                                                echo '/></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;"><br /><a href=".#tabs-3"><img id="add_ldap_server_cancel" src="../images/cancel.png" alt="cancel" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="image" src="../images/accept.png" alt="accept" /></td>
                                            </tr>
                                        </form>
                                    </tr>
                                </table>
                             </div>
                        </div>                
                    ';                
                }
                if(isset($_GET['edit_ldap_server'])){
                    //get ldap server
                    $ldap_server = $_GET['edit_ldap_server'];
                    $r = mysql_query("SELECT value FROM settings WHERE setting = 'ldap'");
                    while ($ra = mysql_fetch_assoc($r)){
                        $current_ldap_server = explode("|", $ra['value']);
                        if($current_ldap_server[0] == $ldap_server){
                            $ldap_server_host = $current_ldap_server[0]; 
                            $ldap_server_port = $current_ldap_server[1];
                            $ldap_server_ssl = $current_ldap_server[2];
                            $ldap_server_username = $current_ldap_server[3];
                            $ldap_server_password = $current_ldap_server[4];
                            $ldap_basedn = $current_ldap_server[5];
                        }
                    }
                    if(!isset($ldap_server_host)){
                        $_SESSION['alert_message'] = "please select an existing ldap server";
                        header('location:.#tabs-3');
                        exit;
                    }
                    echo '
                        <div id="edit_ldap_server">
                            <div>
                                <table id="edit_ldap_server_table">
                                    <tr>
                                        <form method="POST" action="ldap_edit.php" />
                                            <tr>
                                                <td colspan=2 style="text-align: left;"><h3>Edit LDAP Server</h3></td>
                                                <td style="text-align: right;">
                                                    <a class="tooltip"><img src="../images/lightbulb_sm.png" alt="help" /><span>Edit the ldap server information.  Don\'t worry about entering the password unless you want to change it.</span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Host</td>
                                                <td style="text-align: left;"><input type="text" name="host" value="'.$ldap_server_host.'"/></td>
                                            </tr>
                                            <tr>
                                                <td>Port</td>
                                                <td style="text-align: left;"><input type="text" name="port" value="'.$ldap_server_port.'"/></td>
                                            </tr>
                                            <tr>
                                                <td>SSL</td>
                                                <td style="text-align: left;"><input type="checkbox" name="ssl" ';
                                                if($ldap_server_ssl == 1){
                                                    echo 'CHECKED';
                                                }
                                                echo '/></td>
                                            </tr>
                                            <tr>
                                                <td>Username</td>
                                                <td style="text-align: left;"><input type="text" name="username" value="'.$ldap_server_username.'"/></td>    
                                            </tr>
                                            <tr>
                                                <td>Password</td>
                                                <td style="text-align: left;"><input type="password" name="password" /></td>
                                            </tr>
                                            <tr>
                                                <td>Base DN</td>
                                                <td style="text-align: left;"><input type="text" name="basedn" value="'.$ldap_basedn.'"/></td>
                                            </tr>
                                            <input type="hidden" name="current_host" value="'.$ldap_server_host.'"/>
                                            <tr>
                                                <td colspan="2" style="text-align: center;"><br /><a href=".#tabs-3"><img id="add_ldap_server_cancel" src="../images/cancel.png" alt="cancel" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="image" src="../images/accept.png" alt="accept" /></td>
                                            </tr>
                                        </form>
                                    </tr>
                                </table>
                             </div>
                        </div>
                    ';
                }
                if(isset($_GET['test_ldap_server'])){
                    //validate and get host
                    if(isset($_GET['test_ldap_server']) && preg_match( '/^[a-zA-Z0-9\-\_\.]/' , $_GET['test_ldap_server']) ){
                        $test_ldap_server = $_GET['test_ldap_server'];
                    }
                    else{
                        $_SESSION['alert_message'] = 'host was either empty or not a valid hostname';
                        header ( 'location:.#tabs-3' );
                        exit;
                    }
                    $r = mysql_query("SELECT value FROM settings WHERE setting = 'ldap'");
                    while ($ra = mysql_fetch_assoc($r)){
                        $current_test_ldap_server = explode("|", $ra['value']);
                        //if the ldap server matches get all the other details about that ldap server
                        if($current_test_ldap_server[0] == $test_ldap_server){
                            $test_ldap_server_host = $current_test_ldap_server[0]; 
                            $test_ldap_server_port = $current_test_ldap_server[1];
                            $test_ldap_server_ssl = $current_test_ldap_server[2];
                            $test_ldap_server_username = $current_test_ldap_server[3];
                            $test_ldap_server_password = $current_test_ldap_server[4];
                            $test_ldap_basedn = $current_test_ldap_server[5];
                        }
                    }
                    //throw error if no match found
                    if(!isset($test_ldap_server_host)){
                        $_SESSION['alert_message'] = "please select an existing ldap server";
                        header('location:.#tabs-3');
                        exit;
                    }
                    echo '
                        <div id="test_ldap_server">
                            <div>
                                <table id="test_ldap_server_table">
                                <form method="POST" action="ldap_test.php">
                                    <tr>
                                        <td colspan=2 style="text-align: left;"><h3>Test LDAP Server</h3></td>
                                        <td></td>
                                        <td style="text-align: right;">
                                            <a class="tooltip"><img src="../images/lightbulb_sm.png" alt="help" /><span>Test the ldap server information.</span></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan=2>Bind Test</td>
                                        <input type="hidden" name="type" value="bind" />
                                        <input type="hidden" name="host" value="'.$test_ldap_server_host.'" />
                                        <td style="text-align: left;"><input type="submit" value="Bind"/></td>
                                    </tr>
                                    <tr>
                                        <td><br /><br /></td>
                                    </tr>
                                </form>
                                <form method="POST" action="ldap_test.php">
                                    <tr>
                                        <td colspan=3>Test Authentication</td>
                                    </tr>
                                        <td colspan=2>Username</td>
                                        <td><input type="text" name="username" /></td>
                                    <tr>
                                    </tr>
                                        <td colspan=2>Password</td>
                                        <td><input type="password" name="password" /></td>
                                    <tr>
                                    </tr>
                                        <input type="hidden" name="type" value="auth" />
                                        <input type="hidden" name="host" value="'.$test_ldap_server_host.'" />
                                        <td colspan=2></td>
                                        <td style="text-align: left;"><input type="submit" value="Test Auth"/></td>
                                    <tr>
                                    </tr>
                                </form>
                                    <tr>
                                        <td colspan="3" style="text-align: center;"><br /><a href=".#tabs-3"><img id="add_ldap_server_cancel" src="../images/accept.png" alt="accept" /></a></td>
                                    </tr>
                                </table>
                             </div>
                        </div>
                    ';
                }

            ?>
            <!--content-->
            <div id="content">
                <br />
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1">General</a></li>
                        <li><a href="#tabs-2">SMTP</a></li>
                        <li><a href="#tabs-3">LDAP</a></li>
                        <li><a href="#tabs-4">APIs</a></li>
                        <li><a href="#tabs-5">Modules</a></li>
                    </ul>
                    <div id="tabs-1">
                        <table class="standard_table" >
                            <tr>
                                <td>Backup Database</td>
                                <td><a href="backup_db.php">Download</a></td>
                            </tr>
                            <tr>
                                <td>Restore Database</td>
                                <td>
                                    <form action="restore_db.php" method="post" enctype="multipart/form-data" >
                                        <input type="file" name="file" />
                                        <input type="submit" value="Restore Now" />
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>System Time</td>
                                <td>Current: <?php print strftime('%c'); ?></td>
                                <td>
                                    <a class="tooltip"><img src="../images/lightbulb_sm.png" alt="help" /><span>If the date/time is wrong, have your system administrator update the system time on the server hosting this application.  A simple way to update the time would be to run a command such as this at the command line as root: <strong>ntpdate pool.ntp.org</strong>.</span></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Time Zone</td>
                                <td>
                                    <?php 
                                        //connect to database
                                        include '../spt_config/mysql_config.php';
                                        //get current timezone
                                        $r = mysql_query("SELECT value FROM settings WHERE setting = 'time_zone'");
                                        while($ra = mysql_fetch_assoc($r)){
                                            $tz = $ra['value'];
                                        }
                                    ?>
                                        <select name="timezones" onchange="updateSetting('timezone',this.value)">
                                            <option value="-12.0" <?php if(isset($tz) && $tz == "-12.0"){echo "SELECTED";} ?>>(GMT -12:00) Eniwetok, Kwajalein</option>
                                            <option value="-11.0" <?php if(isset($tz) && $tz == "-11.0"){echo "SELECTED";} ?>>(GMT -11:00) Midway Island, Samoa</option>
                                            <option value="-10.0" <?php if(isset($tz) && $tz == "-10.0"){echo "SELECTED";} ?>>(GMT -10:00) Hawaii</option>
                                            <option value="-9.0" <?php if(isset($tz) && $tz == "-9.0"){echo "SELECTED";} ?>>(GMT -9:00) Alaska</option>
                                            <option value="-8.0" <?php if(isset($tz) && $tz == "-8.0"){echo "SELECTED";} ?>>(GMT -8:00) Pacific Time (US &amp; Canada)</option>
                                            <option value="-7.0" <?php if(isset($tz) && $tz == "-7.0"){echo "SELECTED";} ?>>(GMT -7:00) Mountain Time (US &amp; Canada)</option>
                                            <option value="-6.0" <?php if(isset($tz) && $tz == "-6.0"){echo "SELECTED";} ?>>(GMT -6:00) Central Time (US &amp; Canada), Mexico City</option>
                                            <option value="-5.0" <?php if(isset($tz) && $tz == "-5.0"){echo "SELECTED";} ?>>(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima</option>
                                            <option value="-4.0" <?php if(isset($tz) && $tz == "-4.0"){echo "SELECTED";} ?>>(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
                                            <option value="-3.5" <?php if(isset($tz) && $tz == "-3.5"){echo "SELECTED";} ?>>(GMT -3:30) Newfoundland</option>
                                            <option value="-3.0" <?php if(isset($tz) && $tz == "-3.0"){echo "SELECTED";} ?>>(GMT -3:00) Brazil, Buenos Aires, Georgetown</option>
                                            <option value="-2.0" <?php if(isset($tz) && $tz == "-2.0"){echo "SELECTED";} ?>>(GMT -2:00) Mid-Atlantic</option>
                                            <option value="-1.0" <?php if(isset($tz) && $tz == "-1.0"){echo "SELECTED";} ?>>(GMT -1:00 hour) Azores, Cape Verde Islands</option>
                                            <option value="0.0" <?php if(isset($tz) && $tz == "0.0"){echo "SELECTED";} ?>>(GMT) Western Europe Time, London, Lisbon, Casablanca</option>
                                            <option value="1.0" <?php if(isset($tz) && $tz == "1.0"){echo "SELECTED";} ?>>(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris</option>
                                            <option value="2.0" <?php if(isset($tz) && $tz == "2.0"){echo "SELECTED";} ?>>(GMT +2:00) Kaliningrad, South Africa</option>
                                            <option value="3.0" <?php if(isset($tz) && $tz == "3.0"){echo "SELECTED";} ?>>(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
                                            <option value="3.5" <?php if(isset($tz) && $tz == "3.5"){echo "SELECTED";} ?>>(GMT +3:30) Tehran</option>
                                            <option value="4.0" <?php if(isset($tz) && $tz == "4.0"){echo "SELECTED";} ?>>(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi</option>
                                            <option value="4.5" <?php if(isset($tz) && $tz == "4.5"){echo "SELECTED";} ?>>(GMT +4:30) Kabul</option>
                                            <option value="5.0" <?php if(isset($tz) && $tz == "5.0"){echo "SELECTED";} ?>>(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
                                            <option value="5.5" <?php if(isset($tz) && $tz == "5.5"){echo "SELECTED";} ?>>(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
                                            <option value="5.75" <?php if(isset($tz) && $tz == "5.75"){echo "SELECTED";} ?>>(GMT +5:45) Kathmandu</option>
                                            <option value="6.0" <?php if(isset($tz) && $tz == "6.0"){echo "SELECTED";} ?>>(GMT +6:00) Almaty, Dhaka, Colombo</option>
                                            <option value="7.0" <?php if(isset($tz) && $tz == "7.0"){echo "SELECTED";} ?>>(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
                                            <option value="8.0" <?php if(isset($tz) && $tz == "8.0"){echo "SELECTED";} ?>>(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
                                            <option value="9.0" <?php if(isset($tz) && $tz == "9.0"){echo "SELECTED";} ?>>(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
                                            <option value="9.5" <?php if(isset($tz) && $tz == "9.5"){echo "SELECTED";} ?>>(GMT +9:30) Adelaide, Darwin</option>
                                            <option value="10.0" <?php if(isset($tz) && $tz == "10.0"){echo "SELECTED";} ?>>(GMT +10:00) Eastern Australia, Guam, Vladivostok</option>
                                            <option value="11.0" <?php if(isset($tz) && $tz == "11.0"){echo "SELECTED";} ?>>(GMT +11:00) Magadan, Solomon Islands, New Caledonia</option>
                                            <option value="12.0" <?php if(isset($tz) && $tz == "12.0"){echo "SELECTED";} ?>>(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka</option>                                </select>
                                        </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="tabs-2">
                        <a href="?add_smtp_server=true#tabs-2" id="add_smtp_server_button" class="popover_button" ><img src="../images/package_add_sm.png" alt="add" /> SMTP Server</a>
                        <table class="standard_table" >
                            <tr>
                                <td><h3>Host</h3></td>
                                <td><h3>Port</h3></td>
                                <td><h3>SSL?</h3></td>
                                <td><h3>Username</h3></td>
                                <td><h3>Default?</h3></td>
                                <td><h3>Actions</h3></td>
                            </tr>
                            <?php
                                //get all existing SMTP Servers
                                $r = mysql_query("SELECT value FROM settings WHERE setting = 'SMTP'");
                                while ($ra = mysql_fetch_assoc($r)){
                                    $smtp_setting = explode("|",$ra['value']);
                                    echo "
                                        <tr>
                                            <td><a href=\"?edit_smtp_server=".$smtp_setting[0]."#tabs-2\">".$smtp_setting[0]."</a></td>
                                            <td>".$smtp_setting[1]."</td>
                                            <td>";
                                    if($smtp_setting[2] == 1){
                                        echo "Y";
                                    }else{
                                        echo "N";
                                    }
                                    echo "
                                            </td>
                                            <td>".$smtp_setting[3]."</td>
                                            <td>";
                                    if($smtp_setting[5] == "default"){
                                        echo "<img src=\"../images/accept_sm.png\" alt=\"default\" />";
                                    }else{}
                                    echo "
                                            </td>
                                            <td>
                                                <a href=\"?edit_smtp_server=".$smtp_setting[0]."#tabs-2\"><img src=\"../images/pencil_sm.png\" alt=\"edit\" /></a>
                                                <a href=\"?test_smtp_server=".$smtp_setting[0]."#tabs-2\"><img src=\"../images/email_to_friend_sm.png\" alt=\"edit\" /></a>                                                
                                                <a href=\"delete_smtp.php?smtp=".$ra['value']."\"><img src=\"../images/cancel_sm.png\" alt=\"delete\" /></a>
                                            </td>
                                        </tr>
                                    ";
                                }
                            ?>
                        </table>  
                    </div>
                    <div id="tabs-3">
                        <a href="?add_ldap_server=true#tabs-3" id="add_ldap_server_button" class="popover_button"><img src="../images/package_add_sm.png" alt="add" /> LDAP Server</a>                
                        <table class="standard_table" >
                            <tr>
                                <td><h3>Host</h3></td>
                                <td><h3>Port</h3></td>
                                <td><h3>SSL?</h3></td>
                                <td><h3>Username</h3></td>
                                <td><h3>Base DN</h3></td>
                                <td><h3>Actions</h3></td>
                            </tr>
                            <?php
                                //get all existing ldap Servers
                                $r = mysql_query("SELECT value FROM settings WHERE setting = 'ldap'");
                                while ($ra = mysql_fetch_assoc($r)){
                                    $ldap_setting = explode("|",$ra['value']);
                                    echo "
                                        <tr>
                                            <td><a href=\"?edit_ldap_server=".$ldap_setting[0]."#tabs-3\">".$ldap_setting[0]."</a></td>
                                            <td>".$ldap_setting[1]."</td>
                                            <td>";
                                    if($ldap_setting[2] == 1){
                                        echo "Y";
                                    }else{
                                        echo "N";
                                    }
                                    echo "
                                            </td>
                                            <td>".$ldap_setting[3]."</td>
                                            <td>".$ldap_setting[5]."</td>
                                            <td>
                                                <a href=\"?edit_ldap_server=".$ldap_setting[0]."#tabs-3\"><img src=\"../images/pencil_sm.png\" alt=\"edit\" /></a>
                                                <a href=\"?test_ldap_server=".$ldap_setting[0]."#tabs-3\"><img src=\"../images/directory_listing_sm.png\" alt=\"edit\" /></a>                                                
                                                <a href=\"delete_ldap.php?ldap=".$ra['value']."\"><img src=\"../images/cancel_sm.png\" alt=\"delete\" /></a>
                                            </td>
                                        </tr>
                                    ";
                                }
                            ?>
                        </table>                
                    </div>
                    <div id="tabs-4">
                        <table class="standard_table" >
                            <tr>
                                <td>Google API Key</td>
                                <td><input type="text" name="google_api_key" <?php
                                    //connect to database
                                    include '../spt_config/mysql_config.php';
                                    //get current API value
                                    $r = mysql_query("SELECT value FROM settings WHERE setting = 'google_api'");
                                    while ($ra = mysql_fetch_assoc($r)){
                                        $api_key = $ra['value'];
                                        echo "value=\"".$api_key."\" ";
                                    }
                                ?>size="80" onchange="updateSetting('google_api',this.value)"/></td>
                            </tr>
                        </table>                
                    </div>
                    <div id="tabs-5">
                        <a href="?add_module=true#tabs-5" id="add_module_button" class="popover_button" ><img src="../images/package_add_sm.png" alt="add" /> Module</a>
                        <table class="standard_table" >
                            <tr>
                                <td><h3>Name</h3></td>
                                <td><h3>Dependencies</h3></td>
                                <td><h3>Description</h3></td>
                                <td class="td_center"><h3>Uninstall</h3></td>
                            </tr>
                            <?php
                            //connect to database
                            include "../spt_config/mysql_config.php";

                            //pull in all installed modules from the modules table
                            $r = mysql_query ( 'SELECT * FROM settings_modules ORDER BY core, name' ) or die ( '<div id="die_error">There is a problem with the database...please try again later</div>' );
                            while ( $ra = mysql_fetch_assoc ( $r ) ) {
                                echo "
                                                <tr>\n
                                                    <td>" . $ra['name'] . "</td>\n
                                                    <td>";

                                //set the current module name to a temp variable
                                $t = $ra['name'];

                                //query for module dependencies
                                $r2 = mysql_query ( "SELECT * FROM settings_modules_dependencies WHERE module = '$t'" ) or die ( '<div id="die_error">There is a problem with the database...please try again later</div>' );
                                while ( $ra2 = mysql_fetch_assoc ( $r2 ) ) {
                                    echo $ra2['depends_on'] . "<br />";
                                }

                                echo "
                                                    <td  id=\"module_description\">" . $ra['description'] . "</td>\n
                                                    <td class=\"td_center\">";

                                //check to see if the module is a core component or not and if there are any dependencies
                                $r3 = mysql_query ( "SELECT * FROM settings_modules_dependencies WHERE depends_on = '$t'" ) or die ( '<div id="die_error">There is a problem with the database...please try again later</div>' );
                                if ( mysql_num_rows ( $r3 ) > 0 || $ra['core'] == 1 ) {
                                    echo "--";
                                } else {
                                    echo "<a href=\"module_uninstall.php?m=" . $t . "\"><img src=\"../images/package_delete_sm.png\" alt=\"delete\" /></a>";
                                }

                                echo "
                                                    </td>\n
                                            </tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>        
    </body>
</html>
