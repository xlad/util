<?php
namespace xlad\Util;
/**
 * Utility php trait.
 *
 * @since      0.00.005
 * @version    0.00.001
 *
 * @package    Util
 * @author     xlad <xlad@mail.com>
 */
trait Util {

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
    public static function objectToArray($d) {
        if (is_object($d))
            $d = get_object_vars($d);

        return is_array($d) ? array_map(__METHOD__, $d) : $d;
    }

    public static function arrayToObject($d) {
        return is_array($d) ? (object) array_map(__METHOD__, $d) : $d;
    }
    
}
