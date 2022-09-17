<?php

namespace App\Http\Resources\Schemas;

use League\Fractal\TransformerAbstract as Transformer;
use ReportsApp\Architecture\DataSource\Domain\DataSource as Entity;

/**
 * Class DataSource
 *
 * @package App\Http\Resources\Schemas
 */
final class DataSource extends Transformer
{
    /**
     * @param Entity $DataSource
     * @return array|\ReportsApp\Architecture\DataSource\Domain\ValueObjects\DataSourceId[]
     */
    public function transform(Entity $DataSource)
    {
        return array_merge(
            ['id' => $DataSource->getId()],
            $DataSource->toArray(),
            $this->getLinks($DataSource)
        );
    }

    /**
     * @param Entity $DataSource
     * @return array
     */
    public function getLinks(Entity $DataSource) : array
    {
        $data['_links'] = [
//            'self' => [
//                'href' => route('data-sources.get', ['id' => $DataSource->getId()]),
//            ],
        ];

        return $data;
    }

    /**
     * @return string
     */
    public function getType() : string
    {
        return 'data_sources';
    }
}
