<?php
namespace xlad\Util;
/**
 * File Operation functions trait.
 *
 * @since      0.00.007
 * @version    0.00.001
 *
 * @package    xlad/util    composer packagist package
 * @author     xlad <xlad@mail.com>
 */
trait FileOperation {

    /**
     * Search line in file which contains a string
     *
     * @reference  http://stackoverflow.com/questions/19760564/php-find-a-string-in-file-then-show-its-line-number
     */
    public function searchFileLine( $file, $search = '', $dir = '' ) {

		$lines = file( $dir . $file );
        $line_number = false;
        $key = 0;

        /*while ( list( $key, $line ) = myEach( $lines ) and ! $line_number ) {
           $line_number = ( strpos( $line, $search ) !== FALSE ) ? $key + 1 : $line_number;
           $result = $line;
        }*/
        
        foreach( $lines as $key => $line ) {
		
			if( ! $line_number ) {
				$line_number = ( strpos( $line, $search ) !== FALSE ) ? $key + 1 : $line_number;
				$result = $line;
			}
		
		}

        return $result;
		
    }

}
