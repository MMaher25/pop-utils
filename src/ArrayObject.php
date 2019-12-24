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
 * Pop utils array object class
 *
 * @category   Pop
 * @package    Pop\Utils
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2020 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 * @version    1.0.0
 */
class ArrayObject implements \ArrayAccess, \Countable, \IteratorAggregate, \Serializable, ArrayableInterface, JsonableInterface
{

    /**
     * Array data
     * @var array
     */
    protected $data = [];

    /**
     * Constructor
     *
     * Instantiate the array object
     *
     * @param  array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * Create array object from JSON string
     *
     * @param  string  $jsonString
     * @param  int     $depth
     * @param  int     $options
     * @return ArrayObject
     */
    public static function createFromJson($jsonString, $depth = 512, $options = 0)
    {
        return (new self())->jsonUnserialize($jsonString, $depth, $options);
    }

    /**
     * Create array object from serialized string
     *
     * @param  string  $string
     * @return ArrayObject
     */
    public static function createFromSerialized($string)
    {
        return (new self())->unserialize($string);
    }

    /**
     * Method to get the count of the array object
     *
     * @return int
     */
    public function count()
    {
        return count($this->data);
    }

    /**
     * Method to iterate over the array object
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->data);
    }

    /**
     * Get the values as an array
     *
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }

    /**
     * JSON serialize the array object
     *
     * @param  int $options
     * @param  int $depth
     * @return string
     */
    public function jsonSerialize($options = 0, $depth = 512)
    {
        return json_encode($this->data, $options, $depth);
    }

    /**
     * Unserialize a JSON string
     *
     * @param  string  $jsonString
     * @param  int     $depth
     * @param  int     $options
     * @return ArrayObject
     */
    public function jsonUnserialize($jsonString, $depth = 512, $options = 0)
    {
        $this->data = json_decode($jsonString, true, $depth, $options);
        return $this;
    }

    /**
     * Serialize the array object
     *
     * @param  boolean $self
     * @return string
     */
    public function serialize($self = false)
    {
        return ($self)? serialize($this) : serialize($this->data);
    }

    /**
     * Unserialize a string
     *
     * @param  string $string
     * @throws Exception
     * @return ArrayObject
     */
    public function unserialize($string)
    {
        $data = @unserialize($string);
        if ($data instanceof ArrayObject) {
            return $data;
        } else if (is_array($data)) {
            $this->data = $data;
            return $this;
        } else {
            throw new Exception('Error: The string was not able to be correctly unserialized.');
        }
    }

    /**
     * Set a value
     *
     * @param  string $name
     * @param  mixed $value
     * @return ArrayObject
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
        return $this;
    }

    /**
     * Get a value
     *
     * @param  string $name
     * @return mixed
     */
    public function __get($name)
    {
        return (isset($this->data[$name])) ? $this->data[$name] : null;
    }

    /**
     * Is value set
     *
     * @param  string $name
     * @return boolean
     */
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    /**
     * Unset a value
     *
     * @param  string $name
     * @return void
     */
    public function __unset($name)
    {
        if (isset($this->data[$name])) {
            unset($this->data[$name]);
        }
    }

    /**
     * ArrayAccess offsetSet
     *
     * @param  mixed $offset
     * @param  mixed $value
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->__set($offset, $value);
    }

    /**
     * ArrayAccess offsetGet
     *
     * @param  mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->__get($offset);
    }

    /**
     * ArrayAccess offsetExists
     *
     * @param  mixed $offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return $this->__isset($offset);
    }

    /**
     * ArrayAccess offsetUnset
     *
     * @param  mixed $offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        $this->__unset($offset);
    }

}
