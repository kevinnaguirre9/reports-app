<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use ReportsApp\Architecture\AcademicPeriod\Application\Find\AcademicPeriodFinder;
use ReportsApp\Architecture\AcademicPeriod\Application\Find\FindAcademicPeriodQuery;
use ReportsApp\Architecture\AcademicPeriod\Domain\Exceptions\AcademicPeriodNotFound;
use ReportsApp\Shared\Domain\Exceptions\InvalidUuid;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

/**
 * Class AcademicPeriodGetController
 *
 * @package App\Http\Controllers\V1
 */
final class AcademicPeriodGetController extends Controller
{
    /**
     * @param AcademicPeriodFinder $finder
     */
    public function __construct(private AcademicPeriodFinder $finder)
    {
    }

    /**
     * @param string $id
     * @param Request $request
     * @return Response
     * @throws AcademicPeriodNotFound
     * @throws InvalidUuid
     * @throws UnknownProperties
     */
    public function __invoke(string $id, Request $request) : Response
    {
        $AcademicPeriod = ($this->finder)(new FindAcademicPeriodQuery(id: $id));

        return $this->createResponse($AcademicPeriod, Response::HTTP_OK);
    }

}
