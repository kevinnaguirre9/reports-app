<?php

namespace ReportsApp\Shared\Infrastructure\Doctrine\CustomTypes;

use Illuminate\Support\Str;

/**
 * Class CustomTypeRegistrar
 *
 * @package ReportsApp\Shared\Infrastructure\Doctrine\CustomTypes
 */
final class CustomTypesSearcher
{
    private const CUSTOM_TYPES_PATH = 'Infrastructure/Persistence/Doctrine';

    /**
     * @param string $path
     * @param string $contextName
     * @return array
     */
    public static function inPath(string $path, string $contextName): array
    {
        $possibleCustomTypesDirectories = self::possibleCustomTypesPaths($path);

        $customTypesDirectories = array_filter($possibleCustomTypesDirectories, self::isExistingCustomTypePath());

        return array_reduce($customTypesDirectories, self::customerTypeClassesSearcher($contextName), []);
    }

    /**
     * Scan all directories in path, and return only those that are not '.' or '..'
     *
     * @param string $path
     * @return array
     */
    private static function modulesInPath(string $path): array
    {
        return array_filter(
            scandir($path),
            static fn(string $possibleModule) => !in_array($possibleModule, ['.', '..']),
        );
    }

    /**
     * Gets full directory where custom types are located
     *
     * @param string $path
     * @return array
     */
    private static function possibleCustomTypesPaths(string $path): array
    {
        return array_map(
            static function (string $module) use ($path) {

                $customTypesPath = self::CUSTOM_TYPES_PATH;

                return realpath("$path/$module/$customTypesPath");
            },
            self::modulesInPath($path)
        );
    }

    /**
     * Just checks if directory exists
     *
     * @return callable
     */
    private static function isExistingCustomTypePath(): callable
    {
        return static fn(string $path) => !empty($path);
    }

    /**
     * @param $contextName
     * @return callable
     */
    private static function customerTypeClassesSearcher($contextName): callable
    {
        return static function (array $totalNamespaces, string $path) use ($contextName) {

            $possibleFiles = scandir($path);

            $files = array_filter($possibleFiles, static fn($file) => Str::endsWith($file, 'Type.php'));

            $namespaces = array_map(
                static function (string $file) use ($path, $contextName) {

                    $fullPath = "$path/$file";

                    $splitPath = explode(
                        DIRECTORY_SEPARATOR."src".DIRECTORY_SEPARATOR.$contextName.DIRECTORY_SEPARATOR
                        , $fullPath
                    );

                    $classWithoutSuffix = str_replace(['.php', '/'], ['', '\\'], $splitPath[1]);

                    return "ReportsApp\\$contextName\\$classWithoutSuffix";
                },
                $files
            );

            return array_merge($totalNamespaces, $namespaces);
        };
    }
}
