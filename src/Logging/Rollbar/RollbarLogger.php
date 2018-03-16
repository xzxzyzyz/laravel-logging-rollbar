<?php

namespace Xzxzyzyz\Laravel\Logging\Rollbar;

use Illuminate\Support\Facades\Auth;

class RollbarLogger
{
    /**
     * @param  array $config
     *
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        $defaults = [
            'environment' => app()->environment(),
            'root' => base_path(),
        ];

        $config = array_merge($defaults, $config);

        if (empty($config['access_token'])) {
            throw new \InvalidArgumentException('Rollbar access token not configured');
        }

        if (empty($config['person_fn'])) {
            $config['person_fn'] = function() {
                return $this->person();
            };
        }

        $rollbar = new \Rollbar\Rollbar;
        $rollbar->init($config);

        $logger = new \Rollbar\Laravel\RollbarLogHandler($rollbar->logger(), app());

        $handler = new \Monolog\Handler\PsrHandler($logger);

        return new \Monolog\Logger('rollbar', [$handler]);
    }

    /**
     * @return array|null
     */
    public function person()
    {
        if (Auth::guest()) {
            return null;
        }

        return [
            'id' => Auth::user()->id,
            'username' => Auth::user()->name,
            'email' => Auth::user()->email,
        ];
    }
}
