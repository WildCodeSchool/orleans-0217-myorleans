<?php
/**
 * Created by PhpStorm.
 * User: HaGii
 * Date: 28/06/2017
 * Time: 12:07
 */

namespace MyOrleansBundle\Service;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = 'image'.(uniqid()) . '.' . $file->guessExtension();

        $file->move($this->targetDir, $fileName);

        return $fileName;
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }
}
