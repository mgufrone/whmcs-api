<?php namespace Gufy\Whmcs\Models;

use Whmcs;
use Config;
class Base
{
  private static $instance;
  public static function getInstance()
  {
    if(null === static::$instance)
    static::$instance = app()->make('Whmcs');
    return static::$instance;
  }
  public function execute()
  {
    Config::set('whmcs.response', 'object');
    $args = func_get_args();
    return call_user_func_array(array(Base::getInstance(),'execute'), $args);
  }
  public static function __callStatic($function, $arguments=[])
  {
    $class = new static();
    return call_user_func_array(array($class, 'get'.ucwords($function)),$arguments);
  }
}
