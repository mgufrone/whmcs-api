<?php namespace Queiroz\WhmcsApi\Facades;
 
use Illuminate\Support\Facades\Facade;
 
class WhmcsApi extends Facade {
 
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor() { return 'WhmcsApi'; }
 
}