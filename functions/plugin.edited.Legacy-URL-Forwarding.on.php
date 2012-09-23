<?php
/*
Plugin Name: Legacy URL Forwarding
Plugin URI: http://code.olib.co.uk/
Description: Allows you to have old URLs redirected the correct post/page of Wordpress
Version: 1.2
Author: OllyBenson
Author URI: http://code.olib.co.uk
License: GPL2
    Copyright 2011  Olly Benson  (email : ollybenson@googlemail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
/*
To function call this function: doUrlForwarding(); at the first line of code on the 404.php page.
*/
DEFINE('REDIRECT_TYPE','301');

function doUrlForwarding() {
  $filename = strtolower(basename($_SERVER['REQUEST_URI']));
  
  $filename = substr(strtolower( $_SERVER['REQUEST_URI']), 1);



  // $idAtEndOfURL = strtolower(basename($_SERVER['REQUEST_URI']));

  $query = new WP_Query( array('meta_key' => '_old_url', 'meta_value'=>$filename,'post_type'=>'any'));

	if (empty($query->post->ID)) {
	

  $query = new WP_Query( array('meta_key' => 'Old URL', 'meta_value'=>$filename,'post_type'=>'any'));

  //	// if (strlen($filename) == 4 && preg_match($filename, '/^(\d{4})$/' ))
	// if (strlen($filename) == 4 )
	// 	{
	// 		$query = new WP_Query( array('meta_key' => '_old_id', 'meta_value'=>$filename,'post_type'=>'any'));
	// 	}
	}

  if (!empty($query->post->ID)) {
    wp_redirect(get_permalink($query->post->ID),REDIRECT_TYPE);
    }
  }

// function doUrlForwarding() {
//   $filename = strtolower(str_replace(get_home_url()."/","","http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']));
//   $query = new WP_Query( array('meta_key' => 'EE Slug', 'meta_value'=>$filename,'post_type'=>'any'));
// 
// if (empty($query->post->ID)  
// 
//   if (!empty($query->post->ID)) {
//     wp_redirect(get_permalink($query->post->ID),REDIRECT_TYPE);
//     }
//   }
// 

//  add_action('404_template','doUrlForwarding');



