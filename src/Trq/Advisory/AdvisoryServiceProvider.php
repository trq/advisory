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
        $this->commands('advisory.check');

        $this->app['advisory.check'] = $this->app->share(function($app)
        {
            return new Commands\AdvisoryCheckerCommand(new SecurityChecker);
        });
	}

}
