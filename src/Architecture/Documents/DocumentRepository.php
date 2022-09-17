<?php

namespace ReportsApp\Architecture\Documents;

interface DocumentRepository
{
    /**
     * @param string $location
     * @param $contents
     * @param array $options
     * @return void
     */
    public function store(string $location, $contents, array $options = []) : void;

    /**
     * @param string $location
     * @return void
     */
    public function delete(string $location) : void;

    /**
     * @param string $location
     * @return bool
     */
    public function exists(string $location) : bool;

    /**
     * @param string $location
     * @return string
     */
    public function getPublicUrl(string $location) : string;
}
