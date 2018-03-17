<?php
namespace xlad\Util;
/**
 * Utility php trait for object and array conversion.
 *
 * @since      0.00.005
 * @version    0.00.007
 *
 * @package    xlad/util    composer packagist package
 * @author     xlad <xlad@mail.com>
 */
trait ObjectArrayOperations {

	/**
	 * PHP - Convert mixed array & objects recursively.
	 *
	 * @since    0.0.0
	 * @access   public
	 * @var      array    $d            the mixed object/ array.
	 * @param    string   $visibility   public|protected|private.
	 *
	 * @initialAuthor    https://coderwall.com/joakley77
	 * @source    https://coderwall.com/p/8mmicq/php-convert-mixed-array-objects-recursively
	 * @initialAuthor    [answer by ramonztro]
	 * @source    http://stackoverflow.com/questions/4345554/convert-php-object-to-associative-array
	 *
	 *
	 * @todo - $visibility public&&protected limitation.
	 */
    public static function objectToArray( $d, $visibility = '' ) {
        if ( is_object( $d ) ) {

			$object = $d;

			switch( $visibility ) {
				case( 'public' ):
					$d = get_object_vars( $d );
					break;
				case( 'protected' ):
					break;
				default: //all public&&protected&&privvaate
					$reflectionClass = new \ReflectionClass( get_class( $object ) );
					$array = array();
					foreach ( $reflectionClass->getProperties() as $property ) {
						$property->setAccessible( true );
						$array[$property->getName()] = $property->getValue( $object );
						$property->setAccessible( false );
					}

					$d = $array;
			}
		}

        return is_array( $d ) ? array_map( __METHOD__, $d ) : $d;
    }

    public static function arrayToObject( $d ) {
        return is_array( $d ) ? (object) array_map( __METHOD__, $d ) : $d;
    }

	/**
	 * PHP - Convert mixed objects with Private/ Protected keys recursively.
	 *
	 * @since    0.00.005
	 * @access   public
	 * @var      array    $d    the mixed object/ array.
	 *
	 * @initialAuthor    https://coderwall.com/joakley77
	 * @source    http://stackoverflow.com/questions/4345554/convert-php-object-to-associative-array [answer by ramonztro]
	 */
    public static function privateObjectToArray ( $object ) {

		$reflectionClass = new \ReflectionClass(get_class($object));
		$array = array();
		foreach ($reflectionClass->getProperties() as $property) {
			$property->setAccessible(true);
			$array[$property->getName()] = $property->getValue($object);
			$property->setAccessible(false);
		}

		return $array;

	}

}
