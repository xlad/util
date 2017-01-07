<?php

/**
 * Utility php class.
 *
 * @since      0.0.1
 *
 * @package    Util
 * @author     xlad <xlad@mail.com>
 */
class Util {

	/**
	 * PHP - Convert mixed array & objects recursively.
	 *
	 * @since    0.0.0
	 * @access   public
	 * @var      array    $d    the mixed object/ array.
	 * 
	 * @initialAuthor    https://coderwall.com/joakley77
	 * @source    https://coderwall.com/p/8mmicq/php-convert-mixed-array-objects-recursively
	 */
    public static function object_to_array($d) {
        if (is_object($d))
            $d = get_object_vars($d);

        return is_array($d) ? array_map(__METHOD__, $d) : $d;
    }

    public static function array_to_object($d) {
        return is_array($d) ? (object) array_map(__METHOD__, $d) : $d;
    }
    
}
