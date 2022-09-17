<?php

namespace ReportsApp\Architecture\DataSource\Application\SearchAll;

use ReportsApp\Architecture\DataSource\Domain\DataSourceRepository;

/**
 * Class AllDataSourcesSearcher
 *
 * @package ReportsApp\Architecture\DataSource\Application\SearchAll
 */
final class AllDataSourcesSearcher
{
    /**
     * @param DataSourceRepository $repository
     */
    public function __construct(
        private DataSourceRepository $repository,
    )
    {
    }

    /**
     * @param SearchAllDataSourcesQuery $query
     * @return array
     */
    public function __invoke(SearchAllDataSourcesQuery $query) : array
    {
        return $this->repository->searchAll();
    }
}
