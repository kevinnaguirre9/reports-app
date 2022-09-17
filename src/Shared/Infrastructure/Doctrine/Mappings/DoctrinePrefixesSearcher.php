<?php

namespace ReportsApp\Shared\Infrastructure\Doctrine\Mappings;

/**
 * Class DoctrinePrefixesSearcher
 *
 * @package ReportsApp\Shared\Infrastructure\Doctrine\Mappings
 */
final class DoctrinePrefixesSearcher
{
    private const MAPPINGS_PATH = 'Infrastructure/Persistence/Doctrine';

    /**
     * @param string $path
     * @param string $baseNamespace
     * @return array
     */
    public static function inPath(string $path, string $baseNamespace): array
    {
        $possibleMappingDirectories = self::possibleMappingPaths($path);

        $mappingDirectories = array_filter($possibleMappingDirectories, self::isExistingMappingPath());

        return array_flip(self::reindex(self::namespaceFormatter($baseNamespace), $mappingDirectories));
    }

    /**
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
     * @param string $path
     * @return array
     */
    private static function possibleMappingPaths(string $path): array
    {
        $modulesWithRealPaths = [];

        foreach (self::modulesInPath($path) as $module) {

            $mappingsPath = self::MAPPINGS_PATH;

            $modulesWithRealPaths[$module] = realpath("$path/$module/$mappingsPath");
        }

        return $modulesWithRealPaths;
    }

    /**
     * @return callable
     */
    private static function isExistingMappingPath(): callable
    {
        return static fn(string $path) => !empty($path);
    }

    /**
     * @param string $baseNamespace
     * @return callable
     */
    private static function namespaceFormatter(string $baseNamespace): callable
    {
        return static fn(string $path, string $module) => "$baseNamespace\\$module\Domain";
    }

    /**
     * Returns a new collection with the keys reindexed by `$fn`.
     * Optionally `$fn` receive the key as the second argument.
     *
     * @param callable $fn   function to generate the key
     * @param iterable $coll collection to be reindexed
     *
     * @since 0.1
     */
    private static function reindex(callable $fn, iterable $coll): array
    {
        $result = [];

        foreach ($coll as $key => $value) {
            $result[$fn($value, $key)] = $value;
        }

        return $result;
    }
}
