<?php

namespace ReportsApp\Architecture\AcademicPeriod\Application\Create;

use ReportsApp\Shared\Domain\Bus\Command\CommandHandler;

/**
 * Class CreateAcademicPeriodCommandHandler
 *
 * @package ReportsApp\Architecture\AcademicPeriod\Application\Create
 */
final class CreateAcademicPeriodCommandHandler implements CommandHandler
{
    /**
     * @param AcademicPeriodCreator $creator
     */
    public function __construct(private AcademicPeriodCreator $creator)
    {
    }

    /**
     * @param CreateAcademicPeriodCommand $command
     * @return void
     */
    public function __invoke(CreateAcademicPeriodCommand $command) : void
    {
        ($this->creator)($command);
    }
}
