<?php

/*
Plugin Name: @web559 Core Functionality Plugin
Plugin URI: http://www.ericshansby.com
Description: Miscellaneous enhancements.
Version: 0.1
Author: Eric Shansby
Author URI: http://www.ericshansby.com
License: A "Slug" license name e.g. GPL2
*/




/**
 * The short description
 *
 * As many lines of extendend description as you want {@link element}
 * links to an element {@link http://www.example.com Example hyperlink inline link} links to
 * a website. The inline source tag displays function source code in the description:
 * {@source } 
 * 
 * Here are the tags:
 *
 * @abstract
 * @access       public or private
 * @author       author name <author@email>
 * @copyright    name date
 * @deprecated   description
 * @deprec       alias for deprecated
 * @example      /path/to/example
 * @exception    Javadoc-compatible, use as needed
 * @global       type $globalvarname  OR  type description of global variable usage in a function     
 * @ignore
 * @internal     private information for advanced developers only
 * @param        type [$varname] description
 * @return       type description
 * @link         URL
 * @name         procpagealias or $globalvaralias
 * @magic        phpdoc.de compatibility
 * @package      package name
 * @see          name of another element that can be documented,
 *                produces a link to it in the documentation
 * @since        a version or a date
 * @static
 * @staticvar    type description of static variable usage in a function
 * @subpackage    sub package name, groupings inside of a project
 * @throws       Javadoc-compatible, use as needed
 * @todo         phpdoc.de compatibility
 * @var        type    a data type for a class variable
 * @version    version
 */


/**
 * Include all files in the functions and includes folder folder
 *
 * I find it more convenient to split tasks into different files.
 * Instead of adding code directly to functions.php, add your code
 * to a PHP file in the includes folder.
 *
 * @example wp-content/themes/{theme}/functions/charts.on.php
 * @example wp-content/themes/{theme}/includes/charts.on.php
 */



/* Include all files in the FUNCTIONS folder ending in .on.php */
foreach (glob( dirname( __FILE__ ) . "/functions/*.on.php") as $filename) {
    include $filename;
}

/* Include all files in the INCLUDES folder ending in .on.php */
foreach (glob( dirname( __FILE__ ) . "/includes/*.on.php") as $filename) {
    include $filename;
}

