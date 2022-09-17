<?php

namespace ReportsApp\Architecture\Documents;

use Google\Cloud\Storage\Bucket;
use Google\Cloud\Storage\StorageClient;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemException;
use League\Flysystem\GoogleCloudStorage\GoogleCloudStorageAdapter;

/**
 * Class GoogleCloudStorageDocumentRepository
 *
 * @package ReportsApp\Architecture\Documents
 */
final class GoogleCloudStorageDocumentRepository implements DocumentRepository
{
    /**
     * @var StorageClient
     */
    private StorageClient $StorageClient;

    /**
     * @var Bucket
     */
    private Bucket $Bucket;

    /**
     * @var GoogleCloudStorageAdapter
     */
    private GoogleCloudStorageAdapter $GoogleCloudStorageAdapter;

    /**
     * @var Filesystem
     */
    private Filesystem $FileSystem;

    /**
     * @param array $configurationOptions
     * @param string $bucketName
     */
    public function __construct(array $configurationOptions, string $bucketName)
    {
        $this->StorageClient = new StorageClient($configurationOptions);
        $this->Bucket = $this->StorageClient->bucket($bucketName);
        $this->GoogleCloudStorageAdapter = new GoogleCloudStorageAdapter($this->Bucket);
        $this->FileSystem = new Filesystem($this->GoogleCloudStorageAdapter);
    }

    /**
     * Store a file in Google Cloud Storage.
     *
     * @param string $location
     * @param $contents
     * @param array $options
     * @return void
     * @throws FilesystemException
     */
    public function store(string $location, $contents, array $options = []): void
    {
        $this->FileSystem->write($location, $contents);
    }

    /**
     * Delete a file from Google Cloud Storage.
     *
     * @param string $location
     * @return void
     * @throws FilesystemException
     */
    public function delete(string $location): void
    {
        $this->FileSystem->delete($location);
    }

    /**
     * Check if a file or directory exists in Google Cloud Storage.
     *
     * @throws FilesystemException
     */
    public function exists(string $location): bool
    {
        return $this->FileSystem->has($location);
    }

    /**
     * @param string $location
     * @return string
     */
    public function getPublicUrl(string $location): string
    {
        return $this->Bucket
            ->object($location)
            ->signedUrl(new \DateTime('tomorrow'));
    }
}
