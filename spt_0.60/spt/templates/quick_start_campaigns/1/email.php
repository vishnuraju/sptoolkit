<?php

/**
 * file:    email.php
 * version: 2.0
 * package: Simple Phishing Toolkit (spt)
 * component:	Email template - Quick Start campaign templates (Amazon.com)
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

//get delivery date
$today_day = date ( "l" );

if ( $today_day == "Monday" ) {
     $add_days = "5";
} elseif ( $today_day == "Tuesday" ) {
     $add_days = "4";
} elseif ( $today_day == "Wednesday" ) {
     $add_days = "5";
} elseif ( $today_day == "Thursday" ) {
     $add_days = "5";
} elseif ( $today_day == "Friday" ) {
     $add_days = "5";
} elseif ( $today_day == "Saturday" ) {
     $add_days = "5";
} else {
     $add_days = "4";
}

$delivery_day = mktime( 0, 0, 0, date("m")  , date("d")+$add_days, date("Y") );
$delivery_date = date( "l, F d, Y", $delivery_day );

//this is the email template

//populate the variables below with what you want the email to look like
//the variable @link will be generated by the application, just place the
//variable @link somewhere in the email.

//You can also use @fname (first name), @lname (last name) and @url (phishing url).

//This will populate the subject line of the email that is sent
$subject = 'Your Amazon.com order of "Omron HBW-980G Fat Loss ..." has shipped!';

//This will set the sender's name and email address as well as reply to address
$sender_email = "notify@amazon.com";
$sender_friendly = "Amazon.com Customer Service";
$reply_to = "no-reply@amazon.com";

//Set the Content Type and transfer encoding
$content_type = "text/html; charset=utf-8";

//Set the fake link
$fake_link = "https://www.amazon.com/gp/css/homepage.html";

//This will populate the body of the email
$message = '<html><body>';
$message .= 'Hello @fname @lname,<br /><br />Shipping Confirmation<br />Order # <a href=@url>084-4204913-8652358</a><br /><br />Your estimated delivery date is:  <br />'. $delivery_date .'<br /><br /><a href=@url>Track your package</a>.<br /><br />Thank you for shopping with us. We thought you would like to know that we shipped this portion of your order separately to give you quicker service. You will not be charged any extra shipping fees and the remainder of your order will follow as soon as those items become available. If you need to return an item from this shipment or manage other orders please visit <a href=@url>Your Orders on Amazon.com</a>.<br /><br />Shipment Details:<br /><br />Omron HBW-980G Fat Loss Monitor Black - $109.95<br />Item Subtotal - $109.95<br />Shipping & Handling - $0.00<br />Total Before Tax - $109.95<br />Shipment Total - $109.95<br />Paid by card on file - $109.95<br /><br />You have only been charged for the items sent in this shipment. Per our policy you only pay for items when we ship them to you.<br /><br />Returns are easy. Visit our <a href=@url>Customer Service page</a> if you need to return an item or need any further assistance with your order.<br /><br />We hope to see you again soon!<br />Amazon.com';
$message .= '</body></html>';
?>