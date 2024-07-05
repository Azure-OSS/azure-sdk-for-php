<?php

declare(strict_types=1);

namespace AzureOss\Storage\Tests\Blob\Feature\ContainerClient;

use AzureOss\Storage\Blob\Clients\BlobContainerClient;
use AzureOss\Storage\Blob\Exceptions\ContainerAlreadyExistsException;
use AzureOss\Storage\Tests\Blob\BlobFeatureTestCase;
use PHPUnit\Framework\Attributes\Test;

class CreateContainerTest extends BlobFeatureTestCase
{
    #[Test]
    public function container_is_created(): void
    {
        $this->withContainer(__METHOD__, function (BlobContainerClient $containerClient) {
            $this->assertTrue($containerClient->exists());
        });
    }

    #[Test]
    public function throws_exception_when_container_already_exists(): void
    {
        $this->expectException(ContainerAlreadyExistsException::class);

        $this->withContainer(__METHOD__, function (BlobContainerClient $containerClient) {
            $containerClient->create();
        });
    }
}
