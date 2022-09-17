<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use ReportsApp\Architecture\DataSource\Application\Create\CreateDataSourceCommand;
use Illuminate\Http\{JsonResponse, Request, Response};
use Illuminate\Validation\ValidationException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

/**
 * Class DataSourcePostController
 *
 * @package App\Http\Controllers\V1
 */
final class DataSourcePostController extends Controller
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

        $this->handle(new CreateDataSourceCommand($mappedRequest));

        return response()
            ->json(['message' => 'Data Source created successfully'], Response::HTTP_CREATED);
    }

    /**
     * @return string[]
     */
    private function getRequestRules() : array
    {
        return [
            'name'                  => 'required|string',
            'type'                  => 'required|string',
            'academic_period_id'    => 'required|string',
            'description'           => 'string',
        ];
    }
}
