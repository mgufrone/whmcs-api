<?php namespace Queiroz\WhmcsApi;

use Illuminate\Support\ServiceProvider;

class WhmcsApiServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('queiroz/whmcs-api');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

		$this->app['WhmcsApi'] = $this->app->share(function() {
			
			return new WhmcsApi();

		});

		$this->app->booting(function() {
		  
		  $loader = \Illuminate\Foundation\AliasLoader::getInstance();

		  $loader->alias('Whmcs', 'Queiroz\WhmcsApi\Facades\WhmcsApi');

		});

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('WhmcsApi');
	}

}