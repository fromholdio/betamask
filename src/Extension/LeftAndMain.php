<?php

namespace SilverStripe\Betamask\Extension;

use SilverStripe\Core\Environment;
use SilverStripe\Core\Extension;
use SilverStripe\View\TemplateGlobalProvider;

class LeftAndMain extends Extension implements TemplateGlobalProvider
{

    private const ENV_DEV = 'dev';
    private const ENV_TEST = 'test';

    private static array $environments = [
        self::ENV_DEV => 'dev',
        'live' => 'prod',
    ];

    public static function getEnvironmentLabel(): string
    {
        $env = Environment::getEnv('SS_ENVIRONMENT_TYPE');

        // If environment type defined in config, return its value
        if (array_key_exists($env, self::$environments)) {
            return self::$environments[$env];
        }

        // Default is always test
        return self::ENV_TEST;
    }

    public static function getEnvironmentCss(): string
    {
        return strtolower(self::getEnvironmentLabel());
    }

    public static function get_template_global_variables(): array
    {
        return [
            'EnvironmentLabel' => 'getEnvironmentLabel',
            'EnvironmentCss' => 'getEnvironmentCss',
        ];
    }
}
