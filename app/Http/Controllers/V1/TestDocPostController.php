<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use ReportsApp\Architecture\Documents\DocumentRepository;
use Illuminate\Http\Testing\FileFactory;

final class TestDocPostController extends Controller
{
    public function __construct(private DocumentRepository $documentRepository)
    {
    }

    public function __invoke()
    {
        $File = (new FileFactory())->create('test.txt', 0, 'text/plain')->getContent();

        $this->documentRepository->store('test.txt', $File);
    }
}
