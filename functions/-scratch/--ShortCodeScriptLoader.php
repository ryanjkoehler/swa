<?php
//abstract class ShortCodeLoader {
//from Michael Simpson: http://scribu.net/wordpress/optimal-script-loading.html
// This is an outstanding article and very informative. I put it to good use for my plugin. In addition, I re-wrote the Jedi-Master code to make it object oriented and reusable, so every time I create a new shortcode I can subclass it.
// 
// To use it,
// 1. Create a class for a new short that extends ShortCodeScriptLoader, e.g.
// 
// class YourSubclass extends ShortCodeScriptLoader {}
// 2. Implement the abstract method handle_shortcode() to do whatever
// 3. Implement the abstract method add_script() to add scripts calling wp_register_script() and wp_print_scripts()
// 4. Initialize the shortcode like:
// 
// $sc = new YourSubclass();
// $sc->register('shortcode');
// … somewhere in your code where your would normally call add_action().
// 
// Code:
// 



	abstract class ShortCodeLoader {
 
    /**
     * @param  $shortcodeName mixed either string name of the shortcode
     * (as it would appear in a post, e.g. [shortcodeName])
     * or an array of such names in case you want to have more than one name
     * for the same shortcode
     * @return void
     */
    public function register($shortcodeName) {
        $this->registerShortcodeToFunction($shortcodeName, 'handle_shortcode');
    }
 
    /**
     * @param  $shortcodeName mixed either string name of the shortcode
     * (as it would appear in a post, e.g. [shortcodeName])
     * or an array of such names in case you want to have more than one name
     * for the same shortcode
     * @param  $functionName string name of public function in this class to call as the
     * shortcode handler
     * @return void
     */
    protected function registerShortcodeToFunction($shortcodeName, $functionName) {
        if (is_array($shortcodeName)) {
            foreach ($shortcodeName as $aName) {
                add_shortcode($aName, array($this, $functionName));
            }
        }
        else {
            add_shortcode($shortcodeName, array($this, $functionName));
        }
    }
 
    /**
     * @abstract Override this function and add actual shortcode handling here
     * @param  $atts shortcode inputs
     * @return string shortcode content
     */
    public abstract function handle_shortcode($atts);
 
}
 
abstract class ShortCodeScriptLoader extends ShortCodeLoader {
 
    var $doAddScript;
 
    public function register($shortcodeName) {
        $this->registerShortcodeToFunction($shortcodeName, 'handle_shortcode_wrapper');
 
        // It will be too late to enqueue the script in the header,
        // so have to add it to the footer
        add_action('wp_footer', array($this, 'add_script_wrapper'));
    }
 
    public function handle_shortcode_wrapper($atts, $content) {
        // Flag that we need to add the script
        $this->doAddScript = true;
        return $this->handle_shortcode($atts, $content);
    }
 
    // Defined in super-class:
    //public abstract function handle_shortcode($atts);
 
    public function add_script_wrapper() {
        // Only add the script if the shortcode was actually called
        if ($this->doAddScript) {
            $this->add_script();
        }
    }
 
    /**
     * @abstract override this function with calls to insert scripts needed by your shortcode in the footer
     * Example:
     *   wp_register_script('my-script', plugins_url('my-script.js', __FILE__), array('jquery'), '1.0', true);
     *   wp_print_scripts('my-script');
     * @return void
     */
    public abstract function add_script();
 
}