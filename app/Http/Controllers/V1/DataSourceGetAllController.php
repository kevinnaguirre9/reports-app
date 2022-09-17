<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use ReportsApp\Architecture\DataSource\Application\SearchAll\AllDataSourcesSearcher;
use ReportsApp\Architecture\DataSource\Application\SearchAll\SearchAllDataSourcesQuery;
use Illuminate\Http\Response;

/**
 * Class DataSourceGetAllController
 *
 * @package App\Http\Controllers\V1
 */
final class DataSourceGetAllController extends Controller
{
    /**
     * @param AllDataSourcesSearcher $searcher
     */
    public function __construct(private AllDataSourcesSearcher $searcher)
    {
    }

    /**
     * @return Response
     */
    public function __invoke() : Response
    {
        $dataSources = ($this->searcher)(new SearchAllDataSourcesQuery());

        return $this->createResponse($dataSources, Response::HTTP_OK);
    }
}
