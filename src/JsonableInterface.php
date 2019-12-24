<?php
/**
 * Pop PHP Framework (http://www.popphp.org/)
 *
 * @link       https://github.com/popphp/popphp-framework
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2020 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 */

/**
 * @namespace
 */
namespace Pop\Utils;

/**
 * Pop utils jsonable interface
 *
 * @category   Pop
 * @package    Pop\Utils
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2020 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 * @version    1.0.0
 */
interface JsonableInterface extends \JsonSerializable
{

    /**
     * JSON serialize the array object
     *
     * @param  int $options
     * @param  int $depth
     * @return string
     */
    public function jsonSerialize($options = 0, $depth = 512);

    /**
     * Unserialize a JSON string
     *
     * @param  string  $jsonString
     * @param  int     $depth
     * @param  int     $options
     * @return ArrayObject
     */
    public function jsonUnserialize($jsonString, $depth = 512, $options = 0);

}