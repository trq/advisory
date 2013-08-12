<?php namespace Trq\Advisory;

use Illuminate\Support\ServiceProvider;
use SensioLabs\Security\SecurityChecker;

class AdvisoryServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->commands('advisory.checkerCommand');

        $this->app['advisory.securityChecker'] = $this->app->share(function($app)
		{
			return new SecurityChecker;
		});

        $this->app['advisory.checkerCommand'] = $this->app->share(function($app)
        {
            return new Commands\AdvisoryCheckerCommand($app['advisory.securityChecker']);
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('advisory.securityChecker', 'advisory.checkerCommand');
	}

}
