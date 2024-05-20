<?php

namespace App\Services;

use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;

class CloudinaryService
{
    protected $uploadApi;

    public function __construct()
    {
        $this->uploadApi = new UploadApi();
    }

    public function uploadImage($file, $folder = 'profile_images')
    {
        $options = [
            'transformation' => [
                'width' => 500,
                'height' => 500,
                'crop' => 'limit'
            ]
        ];

        // Disable SSL certificate verification
        $curlOptions = [CURLOPT_SSL_VERIFYPEER => false];

        // Perform the image upload with specified options and cURL options
        return $this->uploadFile($file, 'image', $folder, $options, $curlOptions);
    }

    public function uploadResume($file, $folder = 'user_resumes', $options = [])
    {
        // Upload a resume file with specified options
        return $this->uploadFile($file, 'raw', $folder, $options);
    }

    protected function uploadFile($file, $resourceType, $folder, $options, $curlOptions = [])
    {
        // Set cURL options for this request
        Configuration::instance([
            'clientOptions' => $curlOptions,
        ]);

        // Perform the actual file upload using Cloudinary UploadApi
        return $this->uploadApi->upload(
            $file->getRealPath(),
            array_merge([
                'folder' => $folder,
                'resource_type' => $resourceType,
            ], $options)
        );
    }
}
