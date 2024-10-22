<?php

class Directories
{
    private $baseDir = 'directories'; // for 777 permissions.

    public function createDirectoryWithFile($folderName, $fileContent)
    {
        $folderPath = $this->baseDir . '/' . $folderName;

        // to check if directory already exists
        if (is_dir($folderPath)) {
            return [
                'status' => 'error',
                'message' => 'A directory already exists with that name.'
            ];
        }

        // to create the directory
        if (!mkdir($folderPath, 0777, true)) {
            return [
                'status' => 'error',
                'message' => 'Failed to create directory.'
            ];
        }

        // to set permissions to ensure access
        chmod($folderPath, 0777);

        // to create the readme.txt file inside the directory
        $filePath = $folderPath . '/readme.txt';
        $file = fopen($filePath, 'w');
        if (!$file) {
            return [
                'status' => 'error',
                'message' => 'Failed to create file.'
            ];
        }

        fwrite($file, $fileContent);
        fclose($file);

        return [
            'status' => 'success',
            'path' => $filePath
        ];
    }
}
