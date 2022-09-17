<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Response;
use League\Fractal\Manager as Encoder;
use League\Fractal\Resource\{ResourceInterface, Item, Collection};
use App\Http\Resources\Serializers\HalSerializer;
use Illuminate\Pagination\LengthAwarePaginator;
use Nyholm\Psr7\Uri;
use Illuminate\Support\Facades\URL;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

/**
 * Class ResourceManager
 *
 * @package App\Http\Resources
 */
class ResourceManager
{
    /**
     * @var Encoder
     */
    protected static Encoder $encoder;

    /**
     * @var array
     */
    protected static array $transformers = [];

    /**
     * Get an Encoder Instance
     *
     * @return Encoder
     */
    public static function getEncoder() : Encoder
    {
        return static::$encoder ?? static::initEncoder()
        ;
    }

    /**
     * @return Encoder
     */
    protected static function initEncoder() : Encoder
    {
        static::$encoder = new Encoder();
        static::$transformers = config('schemas');

        return static::$encoder;
    }

    /**
     * @param $resource
     * @return ResourceInterface
     */
    protected static function getItem($resource) : ResourceInterface
    {
        $transformer = static::getTransformer($resource) ?: null;
        $type = $transformer?->getType();

        return new Item($resource, $transformer, $type);
    }

    /**
     * @param $resource
     * @return ResourceInterface
     */
    protected static function getCollection($resource) : ResourceInterface
    {
        $items = $resource;

        if ($resource instanceof LengthAwarePaginator){
            $items = $resource->getCollection();
            $resource->withPath(URL::full());
            $paginator = new IlluminatePaginatorAdapter($resource);
        }

        $transformer = isset($items[0])
            ? static::getTransformer($items[0])
            : null
        ;
        $type = $transformer?->getType();

        $collection = new Collection($items, $transformer, $type);
        isset($paginator) && $collection->setPaginator($paginator);

        return $collection;
    }

    /**
     * Get transformer for resource
     *
     * @param $resource
     * @return mixed
     */
    protected static function getTransformer($resource)
    {
        $transformer = static::$transformers[get_class($resource)];

        return new $transformer;
    }

    /**
     * Encode a resource
     *
     * @param mixed $resource
     * @return array
     */
    public static function encode($resource)
    {
        $encoder = static::getEncoder();

        static::$encoder->setSerializer(
            new HalSerializer(new Uri(URL::full()))
        );

        $resource = !is_iterable($resource)
            ? static::getItem($resource)
            : static::getCollection($resource)
        ;

        return $encoder->createData($resource)->toArray();
    }

    /**
     * Create a Response with a json encoded content from a resource
     *
     * @param mixed $resource
     * @param integer $code The HTTP StatusType Code
     * @param string $type
     * @return Response
     */
    public static function createResponse(
        $resource,
        int $code = 200,
        string $type = 'hal+json'
    ) : Response{

        return new Response(
            json_encode(static::encode($resource), JSON_UNESCAPED_SLASHES),
            $code,
            ['Content-Type' => 'application/hal+json']
        );
    }
}
