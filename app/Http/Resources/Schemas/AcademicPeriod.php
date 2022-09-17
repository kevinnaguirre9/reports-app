<?php

namespace App\Http\Resources\Schemas;

use League\Fractal\TransformerAbstract as Transformer;
use ReportsApp\Architecture\AcademicPeriod\Domain\AcademicPeriod as Entity;

final class AcademicPeriod extends Transformer
{
    /**
     * @param Entity $city
     * @return array|string[]
     */
    public function transform(Entity $AcademicPeriod)
    {
        return array_merge(
            ['id' => $AcademicPeriod->getId()],
            $AcademicPeriod->toArray(),
            $this->getLinks($AcademicPeriod)
        );
    }

    /**
     * @param Entity $AcademicPeriod
     * @return array
     */
    public function getLinks(Entity $AcademicPeriod) : array
    {
        $data['_links'] = [
            'self' => [
                'href' => route('academic-periods.get', ['id' => $AcademicPeriod->getId()]),
            ],
        ];

        return $data;
    }

    /**
     * @return string
     */
    public function getType() : string
    {
        return 'academic_periods';
    }
}
