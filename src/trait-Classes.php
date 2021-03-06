<?php
namespace xlad\Util;
/**
 * Utility php trait for PHP Classes.
 *
 * @since      0.00.005
 * @version    0.00.001
 *
 * @package    xlad/util    composer packagist package
 * @author     xlad <xlad@mail.com>
 */
trait phpClasses {

	/**
	 * Set the class arguments even if they are not defined.
	 *
	 * @since    0.00.005
	 * @access   public
	 * @var      none
	 * @param    none
	 */
    public static function updateClassArguments( $arguments ) {
		
		if( !empty( $arguments ) ) {
            foreach( $arguments[0] as $key => $property ) {
                if( property_exists( $this, $key ) ) {
                    $this->{$key} = $property;
				} else {
                    $this->{$key} = $property;
				}
				var_dump($key);
				var_dump($property);
			}
		}
		
	}
    
}
