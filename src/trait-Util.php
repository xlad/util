<?php
namespace xlad\Util;
/**
 * Utility php functions trait.
 *
 * @since      0.00.005
 * @version    0.00.003
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

    public static function display( $variable, $sepparator = "-", $multiplier = 10, $nl = '<br/>' ) {

        echo( str_repeat( $sepparator, $multiplier ) . $nl . '<pre>' );

        print_r( $variable );

        echo( '</pre>' . $nl . str_repeat( $sepparator, $multiplier ) . $nl );

    }

    /**
     *
     *
     */

    public static function myEach(&$arr) {

		$key = key($arr);
		$result = ($key === null) ? false : [$key, current($arr), 'key' => $key, 'value' => current($arr)];
		next($arr);
		return $result;

	}

    /**
     * Return array of string split by capitalised letter(s).
     */

    public function strSplitCapitalized ( $string ) {

        return preg_split( '/(?=[A-Z])/', $string, -1, PREG_SPLIT_NO_EMPTY );

    }

    /**
     * Check if values are changed
     */
    public function diffValues( $array1, $array2 ) {

        $diff = array();

////$this->display( $values, 'VALUES --- ' );
        foreach( $array1 as $key => $value ) {
            if(
                $this->key_is( $array2, $key )
                &&
                (string) $array2[$key] !== (string) $value
            ) {
                $diff[] = $key;
            }
////$this->display( $value, '$value --- ' );
////$this->display( $dbValues[$key], '$dbValues[$key] --- ' );
        }

        return $diff;

    }

    /**
     * Sanitize data values for db insertion or comparison.
     *
     * @since    0.0.007
     * @since    0.0.001
     *
     * @param    array    $element    The input array.
     */
    public function sanitizeData( $element, $dateKeys = array( 'data' ) ) {

        foreach ( $element as $key => $value ) {

            if ( ! is_array( $value ) ) {

                (string) $value;
                $value = trim( $value );

                if ( $element[$key] === NULL || $element[$key] == 'NULL' || $element[$key] == "" )
                    $element[$key] = "";

                if ( $this->inArray( $key, $dateKeys ) ) {
                    if ( $element[$key] == "" || $element[$key] == "0000-00-00T00:00:00" || $element[$key] == NULL || $element[$key] == 'NULL' ) {
                        $element[$key] = "0000-00-00 00:00:00";
                    } else {
                        $element[$key] = $this->dateTime( $value, "Y-m-d H:i:s" );
                    }
                }

            }

        }

        return $element;

    }


	function uniqueMultidimensionalArray( $array, $keys = array() ) {

		$result = $array;
		//array to store duplicates keys
		$instances = array();

		if( empty( $keys ) ) {
			$keys = array_keys( $array );
		}

		for( $i = 0, $size = count( $array ); $i < $size; ++$i ) {

			$instances[$i] = array();

			foreach( $array as $k => $v ) {

				$equal = true;

				foreach( $keys as $key ) {

					if ( $array[$i][$key] !== $v[$key] ) {
						$equal = false;
					}

				}

				if( $equal === true ) {
					$instances[$i][] = $k;
					if( count( $instances[$i] ) > 1 ) {
						unset( $result[$k] );
					}
				}

			}

		}

		//ad dupes (instances)
		foreach( $result as $i => $value ) {
			$result[$i]['instances'] = count( $instances[$i] );
		}

		return $result;

	}

	function arraysEqual( $arr1, $arr2, $keys = array() ) {
		//if(arr1.length !== arr2.length)
		//	return false;
		if( !empty( $keys ) ) {
			foreach( $arr1 as $key => $value ) {
				if( $arr1[$key] != $arr2[$key] )
					return false;
			};
		} else {
			foreach( $keys as $key ) {
				if( $arr1[$key] != $arr2[$key] )
					return false;
			}
		}

		return true;
	}


    /**
     * Return the values for a set of keys from an array.
     *
     * @since    0.00.005
     * @since    0.00.001
     *
     * @var      array    $keys      the set of keys to be used.
     * @var      array    $array     array to process.
     *
     * @return   array    named array with pairs '@key' => 'value'
     */
    public function prepareValues( $keys = array(), $array = array() ) {

        $values = array();

        foreach( $keys as $key ) {
            $values[$key] = $array[$key] ? $array[$key] : '';
        }

        return $values;

    }


    /**
     * Return the values for a set of keys from an array.
     *
     * @since    0.00.006
     * @since    0.00.001
     *
     * @var      array    $columns    the set of keys to be used.
     * @var      array    $values     array to process.
     * @param    string   $delimiter  @string delimiter to format the output.
     *                    use [' AND ' / ' OR '] for mysql WHERE/ LIKE search
     *                    use [', '] for insert update
     *
     * @return   string   SQL string
     */
    public function stringSQL( $columns = array(), $values = array(), $delimiter = ' OR ' ) {

        foreach( $columns as $key => $column ) {
            $conditions[] = "`" . $column . "`='" . $values[$column] . "'";
        }

        $sql = implode( $delimiter, $conditions );

        return $sql;

    }


    /**
     *
     */
    public function tableName( $table ) {

        global $wpdb;
        return( $wpdb->prefix . $table . $this->Sufix );

    }


}
