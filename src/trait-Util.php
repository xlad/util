<?php
namespace xlad\Util;
/**
 * Utility php functions trait.
 *
 * @since      0.00.005
 * @version    0.00.002
 *
 * @package    xlad/util    composer packagist package
 * @author     xlad <xlad@mail.com>
 */
trait Util {

    /**
     * Check if an array key exists.
     *
     * @since    0.00.007
     * @version  0.00.001
     *
     * @access   public
     * @var      array    $d            the mixed object/ array.
     * @param    string   $visibility   public|protected|private.
     */
    public static function key_is( $array, $key ) {

        if (
            isset( $array[$key] )
            ||
            array_key_exists( $key, $array )
        ) {
            return true;
        }

    }

    /**
     * Convert dateTime in php format.
     *
     * @since    0.00.007
     * @version  0.00.001
     *
     * @access   public
     * @var      array    $dateTime     input Date time.
     * @param    string   $PHP format   php format .
     */

    public static function dateTime( $dateTime = null, $format = "Y-m-d H:i:s", $dateTimeZone = 'Europe/Bucharest' ) {

        $timeZone = new \DateTimeZone( $dateTimeZone );

        if( $dateTime !== null ) {
            $result = ( new \DateTime( $dateTime ) )->format( $format );
        }else {
            $date = ( new \DateTime() )->setTimezone( $timeZone );
            $result = $date->format( $format );
        }

        return $result;

    }

    /**
     * Check $var if is in array.
     *
     * @since    0.00.007
     * @version  0.00.001
     *
     * @access   public
     * @param    string   $var       variable.
     * @var      array    $array     array.
     */

    public static function inArray( $var, $array ) {

        $result = in_array ( $var, $array, true );

        return $result;

    }

    /**
     * Print values (display).
     *
     * @since    0.00.0017
     * @version  0.00.001
     *
     * @access   public
     * @param    string/array   $var       variable.
     * @var      array    $array     array.
     */

    public static function display( $variable, $sepparator = "-", $multiplier = 20, $nl = '<br/>' ) {

        echo( str_repeat( $sepparator, $multiplier ) . $nl );

        var_dump( $variable );

        echo( $nl . str_repeat( $sepparator, $multiplier ) . $nl );

    }

}
