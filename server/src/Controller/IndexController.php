<?php

namespace App\Controller;

use Aws\S3\S3Client;
use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Cache\Adapter\RedisTagAwareAdapter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    /**
     * @throws InvalidArgumentException
     * @throws \RedisException
     */
    #[Route('/api/v1/test', name: 'index')]
    public function index(): JsonResponse
    {
        $s3 = new S3Client([
            'version' => 'latest',
            'region'  => 'us-east-1',
            'endpoint' => 'http://minio:9000',
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'    => 'FN88CVZP6H0IILD7FCOS',
                'secret' => 'LSsflJAQWubEzp2maAMHUZWisJGIfGKt4/YcuZHd'
            ],
        ]);

        $s3->createBucket(['Bucket' => 'test']);


        // Send a PutObject request and get the result object.
        $insert = $s3->putObject([
            'Bucket' => 'test',
            'Key'    => 'testkey',
            'Body'   => 'Hello from MinIO!!'
        ]);

// Download the contents of the object.
        $retrive = $s3->getObject([
            'Bucket' => 'test',
            'Key'    => 'testkey',
            'SaveAs' => 'testkey_local'
        ]);

// Print the body of the result by indexing into the result object.
        echo $retrive['Body'];
        die();

//        return $this->json([
//            'message' => $client->get('testKey'),
//            'path' => 'src/Controller/IndexController.php',
//        ]);
    }
}
