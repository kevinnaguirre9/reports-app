<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use ReportsApp\Architecture\AcademicPeriod\Application\SearchAll\AllAcademicPeriodsSearcher;
use ReportsApp\Architecture\AcademicPeriod\Application\SearchAll\SearchAllAcademicPeriodsQuery;
use Illuminate\Http\Response;

/**
 * Class AcademicPeriodGetAllController
 *
 * @package App\Http\Controllers\V1
 */
final class AcademicPeriodGetAllController extends Controller
{
    /**
     * @param AllAcademicPeriodsSearcher $searcher
     */
    public function __construct(private AllAcademicPeriodsSearcher $searcher)
    {
    }

    /**
     * @return Response
     */
    public function __invoke(): Response
    {
        $academicPeriods = ($this->searcher)(new SearchAllAcademicPeriodsQuery());

        return $this->createResponse($academicPeriods, Response::HTTP_OK);
    }
}
