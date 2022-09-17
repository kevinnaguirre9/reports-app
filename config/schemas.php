<?php

use ReportsApp\Architecture\AcademicPeriod\Domain\AcademicPeriod;
use App\Http\Resources\Schemas\AcademicPeriod as AcademicPeriodSchema;
use ReportsApp\Architecture\DataSource\Domain\DataSource;
use App\Http\Resources\Schemas\DataSource as DataSourceSchema;

return [

    /*
    |--------------------------------------------------------------------------
    | API Schemas
    |--------------------------------------------------------------------------
    |
    | This file stores the configurations between Entities and its Schemas
    | to generate JSON:API Resources
    |
    */

    AcademicPeriod::class   => AcademicPeriodSchema::class,
    DataSource::class       => DataSourceSchema::class,
];
