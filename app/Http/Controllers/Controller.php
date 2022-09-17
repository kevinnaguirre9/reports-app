<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResourceManager;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Laravel\Lumen\Routing\Controller as BaseController;
use ReportsApp\Shared\Domain\Bus\Command\CommandBus;
use ReportsApp\Shared\Domain\Bus\Command\Command;

/**
 * Class Controller
 *
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    /**
     * @param CommandBus $commandBus
     */
    public function __construct(private CommandBus $commandBus)
    {
    }

    /**
     * @param Command $command
     * @return void
     */
    public function handle(Command $command)
    {
        $this->commandBus->dispatch($command);
    }

    /**
     * @param array $payload
     * @return array
     */
    protected function mapRequestPayloadToCamelCase(array $payload) : array
    {
        $mapped = [];

        foreach ($payload as $key => $value)
            data_set($mapped, Str::camel($key),
                is_array($value) ? $this->mapRequestPayloadToCamelCase($value) : $value
            );

        return $mapped;
    }

    /**
     * Create a Response using the Resources Factory
     *
     * @param $resource
     * @param integer $code
     * @return Response
     */
    protected function createResponse($resource, $code = 200) : Response
    {
        return ResourceManager::createResponse(
            $resource,
            $code,
            getallheaders()['Content-Type']
        );
    }
}
