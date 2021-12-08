<?php
namespace Afkar\Test\Support;

class Config implements \ArrayAccess
{
	
	/**
     * Main array of configuration data .
     *  
     * @var array $items
     */
    protected static array $items = [];
	
	private function __construct() {}

	/**
     * Get the Config object, so it can be used as a dependency of getConfig
     * 
     * @return Config
     */
    public static function getConfig()
    {
        return new self;
    }
	/**
	 * Config Constructor.
	 * 
	 * @param mixed $itemsData
	 */
	public static function setItems($items)
	{
		foreach ($items as $key => $item) {
			static::$items[$key] = $item;
		}
	}

	public static function getItems()
	{
		return static::$items;
	}
	
	/**
	 * Summary of get
	 * @param mixed $key
	 * @param mixed $default
	 * @return mixed
	 */
	public static function get($key, $default = null)
	{
		if(is_array($key)){
			return static::getMany($key);
		}
		
		return Arr::get(static::$items, $key, $default);
	}
	
	/**
	 * Summary of getMany
	 * @param mixed $keys
	 * @return array
	 */
	public static function getMany($keys)
	{
		$config = [];
		foreach ($keys as $key => $default) {
			if(is_numeric($key)){
				[$key, $default] = [$default, null];
			}
			$config[$key] = Arr::get(static::$items, $key, $default);
		}
		
		return $config;
	}
	
	/**
	 * Summary of push
	 * @param mixed $key
	 * @param mixed $value
	 * @return void
	 */
	public function push($key, $value)
	{
		$array = $this->get($key);
		
		$array[] = $value;
		
		$this->set($key, $value);
	}
	
	/**
	 * Summary of all
	 * @return array
	 */
	public function all()
	{
		return static::$items;
	}
	
	/**
	 * Summary of set
	 * @param mixed $key
	 * @param mixed $value
	 * @return mixed
	 */
	public static function set($key, $value = null)
	{
		$keys = is_array($key) ? $key : [$key => $value];
		
		foreach ($keys as $key => $value) {
			return Arr::set(static::$items, $key, $value);
		}
	}
	
	/**
	 * Summary of exists
	 * @param mixed $key
	 * @return bool
	 */
	public function exists($key)
	{
		return Arr::exists(static::$items, $key);
	}
	
    
	/**
	 * Whether an offset exists
	 * Whether or not an offset exists.
	 *
	 * @param mixed $offset An offset to check for.
	 *
	 * @return bool Returns `true` on success or `false` on failure.
	 */
	public function offsetExists($offset) 
    {
		return $this->exists($offset);
	}
	
	/**
	 * Offset to retrieve
	 * Returns the value at specified offset.
	 *
	 * @param mixed $offset The offset to retrieve.
	 *
	 * @return mixed Can return all value types.
	 */
	public function offsetGet($offset) 
    {
        return static::get($offset);
	}
	
	/**
	 * Assigns a value to the specified offset.
	 *
	 * @param mixed $offset The offset to assign the value to.
	 * @param mixed $value The value to set.
	 */
	public function offsetSet($offset, $value) 
    {
		return static::set($offset, $value);
	}
	
	/**
	 * Unsets an offset.
	 *
	 * @param mixed $offset The offset to unset.
	 */
	function offsetUnset($offset) 
    {
        return $this->set($offset, null);
	}
	
}