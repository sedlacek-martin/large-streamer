<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Attribute\Route;

class FileController extends AbstractController
{

    #[Route('/file/small')]
    public function serveSmallAction(): StreamedResponse
    {
        return $this->makeDownloadResponse('/storage/video/01.mp4', 'video/mp4', 'downloaded small video.mp4');
    }

    #[Route('/file/large')]
    public function serveLargeAction(): StreamedResponse
    {
        return $this->makeDownloadResponse('/storage/video/02.mp4', 'video/mp4', 'downloaded large video.mp4');

    }

    #[Route('/file/medium')]
    public function serveMediumAction(): StreamedResponse
    {
        return $this->makeDownloadResponse('/storage/img/01.png', 'image/png', 'downloaded medium image.png');
    }


    protected function makeDownloadResponse(string $path, string $mimeType, string $filename)
    {
        $projectDir = $this->getParameter('kernel.project_dir');

        $response = new StreamedResponse(function() use ($projectDir, $path) {
            $fileStream = fopen($projectDir . $path, 'r');

            // Output the file content in chunks
            while (!feof($fileStream)) {
                echo fread($fileStream, 1024); // Adjust chunk size as needed
                flush();
            }

            fclose($fileStream);
        });
        $response->headers->set('Content-Type', $mimeType);
        $disposition = HeaderUtils::makeDisposition(
            HeaderUtils::DISPOSITION_ATTACHMENT,
            $filename,
        );
        $response->headers->set('Content-Disposition', $disposition);


        return $response;
    }



}