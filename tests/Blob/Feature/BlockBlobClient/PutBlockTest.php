<?php

declare(strict_types=1);

namespace AzureOss\Storage\Tests\Blob\Feature\BlockBlobClient;

use AzureOss\Storage\Blob\Clients\BlobContainerClient;
use AzureOss\Storage\Blob\Exceptions\ContainerNotFoundException;
use AzureOss\Storage\Blob\Options\Block;
use AzureOss\Storage\Blob\Options\BlockType;
use AzureOss\Storage\Tests\Blob\BlobFeatureTestCase;
use PHPUnit\Framework\Attributes\Test;

class PutBlockTest extends BlobFeatureTestCase
{
    #[Test]
    public function puts_block(): void
    {
        $this->expectNotToPerformAssertions();

        $this->withContainer(__METHOD__, function (BlobContainerClient $containerClient) {
            $block = new Block('ABCDEF', BlockType::UNCOMMITTED);

            $containerClient->getBlockBlobClient("test")->putBlock($block, 'Lorem');
        });
    }

    #[Test]
    public function throws_when_container_doesnt_exist(): void
    {
        $this->expectException(ContainerNotFoundException::class);

        $block = new Block('ABCDEF', BlockType::UNCOMMITTED);

        $this->serviceClient->getContainerClient('noop')->getBlockBlobClient('noop')->putBlock($block, "Lorem");
    }
}
