<?php

namespace ReportsApp\Architecture\AcademicPeriod\Application\Create;

use ReportsApp\Architecture\AcademicPeriod\Domain\AcademicPeriod;
use ReportsApp\Architecture\AcademicPeriod\Domain\AcademicPeriodRepository;
use ReportsApp\Architecture\AcademicPeriod\Domain\Events\AcademicPeriodRegistered;
use ReportsApp\Architecture\AcademicPeriod\Domain\ValueObjects\AcademicPeriodId;
use ReportsApp\Shared\Domain\Bus\Event\EventBus;

/**
 * Class AcademicPeriodCreator
 *
 * @package ReportsApp\Architecture\AcademicPeriod\Application\Create
 */
final class AcademicPeriodCreator
{
    /**
     * @param AcademicPeriodRepository $repository
     * @param EventBus $eventBus
     */
    public function __construct(
        private AcademicPeriodRepository $repository,
        private EventBus $eventBus,
    )
    {
    }

    /**
     * @param CreateAcademicPeriodCommand $command
     * @return void
     */
    public function __invoke(CreateAcademicPeriodCommand $command) : void
    {
        $AcademicPeriod = AcademicPeriod::create(
            new AcademicPeriodId(),
            $command->name,
            $command->startDate,
            $command->endDate,
            $command->description
        );

        $this->repository->save($AcademicPeriod);

        $this->eventBus->dispatch(...$AcademicPeriod->pullDomainEvents());
    }
}
