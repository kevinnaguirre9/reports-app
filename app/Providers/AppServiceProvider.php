<?php

namespace App\Providers;

use Doctrine\ODM\MongoDB\DocumentManager;
use ReportsApp\Architecture\AcademicPeriod\Domain\AcademicPeriodRepository;
use ReportsApp\Architecture\AcademicPeriod\Infrastructure\Persistence\MongoDbAcademicPeriodRepository;
use ReportsApp\Architecture\DataSource\Domain\DataSourceRepository;
use ReportsApp\Architecture\DataSource\Infrastructure\Persistence\MongoDbDataSourceRepository;
use ReportsApp\Architecture\Documents\DocumentRepository;
use ReportsApp\Architecture\Documents\GoogleCloudStorageDocumentRepository;
use ReportsApp\Shared\Infrastructure\Doctrine\DocumentManagerFactory;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 *
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(DocumentManager::class, fn () => DocumentManagerFactory::create());

        $this->app->bind(AcademicPeriodRepository::class, MongoDbAcademicPeriodRepository::class);

        $this->app->bind(DataSourceRepository::class, MongoDbDataSourceRepository::class);

        $this->app->bind(DocumentRepository::class, function ($app) {
            return new GoogleCloudStorageDocumentRepository(
                ['keyFile' => config('filesystems.disks.gcs.key_file')],
                config('filesystems.disks.gcs.bucket'),
            );
        });
    }
}
