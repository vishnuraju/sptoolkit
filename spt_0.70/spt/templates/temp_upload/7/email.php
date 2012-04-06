<?php

/**
 * file:    email.php
 * version: 2.0
 * package: Simple Phishing Toolkit (spt)
 * component:	Email template - Quick Start campaign templates (mailbox migration required)
 * copyright:	Copyright (C) 2011 The SPT Project. All rights reserved.
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

//this is the email template

//populate the variables below with what you want the email to look like
//the variable @link will be generated by the application, just place the
//variable @link somewhere in the email.

//You can also use @fname (first name), @lname (last name) and @url (phishing url).
$subject = 'Mailbox migration';

//This will set the sender's name and email address as well as reply to address
$sender_email = "emailadmin@mail.com";
$sender_friendly = "Email Administrator";
$reply_to = "no-reply@mail.com";

//Set the Content Type and transfer encoding
$content_type = "text/html; charset=utf-8";

//Set the fake link
$fake_link = "https://login.live.com/login.srf?cbcxt=out&vv=910&wa=wsignin1.0&wtrealm=urn:federation:MicrosoftOnline";

//This will populate the body of the email
$message = '<html><body>Information Technology Services (ITS) employees are currently upgrading e-mail accounts.  This will provide you the ability to store a greatly increased amount of e-mail correspondence in your e-mail account.<br /><br />Your account has been identified as one of the accounts which are to be upgraded.  Please click the link below and follow the instructions.<br /><br />@link<br /><br />The new quota level for e-mail accounts will after the upgrade be set to 100GB.<br /><br />Regards,<br />Information Technology Services Help Desk</body></html>';
?>