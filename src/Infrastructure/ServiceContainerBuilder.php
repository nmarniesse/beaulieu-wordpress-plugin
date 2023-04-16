<?php

declare(strict_types=1);

namespace Beaulieu\Infrastructure;

use Beaulieu\Domain\MovieRepositoryInterface;
use DI\Container;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

final class ServiceContainerBuilder
{
    private const PROJECT_PATH = __DIR__ . '/../../';
    private const TWIG_PATH = 'src/Infrastructure/Resources/Templates';

    private static ?Container $container = null;

    public static function build(): Container
    {
        if (null === self::$container) {
            // See https://php-di.org/doc/
            $container = new Container([
                MovieRepositoryInterface::class => \DI\get(PodMovieRepository::class),
                Environment::class => self::loadTwig(),
            ]);
        }

        return $container;
    }

    private static function loadTwig(): Environment
    {
        $loader = new FilesystemLoader(self::PROJECT_PATH . self::TWIG_PATH);

        $twig = new Environment($loader, [
            'debug' => true,
        ]);
        $twig->addExtension(new DebugExtension());

        return $twig;
    }
}
