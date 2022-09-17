<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use ReportsApp\Architecture\AcademicPeriod\Application\Create\CreateAcademicPeriodCommand;
use Illuminate\Http\{JsonResponse, Request, Response};
use Illuminate\Validation\ValidationException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

/**
 * Class AcademicPeriodPostController
 *
 * @package App\Http\Controllers\V1
 */
final class AcademicPeriodPostController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     * @throws UnknownProperties
     */
    public function __invoke(Request $request) : JsonResponse
    {
        $this->validate($request, $this->getRequestRules());

        $dataRequest = $request->all();

        $mappedRequest = $this->mapRequestPayloadToCamelCase($dataRequest);

        //Create academic period using the Command + Command Handler
        $this->handle(new CreateAcademicPeriodCommand($mappedRequest));

        return response()
            ->json(['message' => 'Academic Period created successfully'], Response::HTTP_CREATED);
    }

    /**
     * @return string[]
     */
    private function getRequestRules() : array
    {
        return [
            'name'          => 'required|string',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date',
            'description'   => 'string',
        ];
    }
}
