<?php

namespace App\Services;

use Cloudinary\Api\Upload\UploadApi;

class CloudinaryService
{
    protected $uploadApi;

    public function __construct()
    {
        $this->uploadApi = new UploadApi();
    }

    public function uploadImage($file, $folder = 'profile_images')
    {
        $options=[
            'transformation' => [
                'width' => 500,
                'height' => 500,
                'crop' => 'limit'
            ]
        ];
        return $this->uploadFile($file, 'image', $folder, $options);
    }

    public function uploadResume($file, $folder = 'user_resumes', $options = [])
    {
        return $this->uploadFile($file, 'raw', $folder, $options);
    }

    protected function uploadFile($file, $resourceType, $folder, $options)
    {
        return $this->uploadApi->upload(
            $file->getRealPath(),
            array_merge([
                'folder' => $folder,
                'resource_type' => $resourceType,
            ], $options)
        );
    }
}
