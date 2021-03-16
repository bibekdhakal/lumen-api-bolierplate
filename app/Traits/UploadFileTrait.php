<?php

namespace App\Traits;

trait UploadFileTrait
{
    public function uploadImage($actual_image, $image_path)
    {

        if ($actual_image->getClientOriginalName()) {
            $extension = $actual_image->getClientOriginalExtension();
            $image_name = date('YmdHis') . rand(1, 99999) . '.' . $extension;

            if (!file_exists($image_path)) {
                mkdir($image_path, 0755, true);
            }

            $actual_image->move($image_path, $image_name);

        }
        return $image_name;
    }

    public function removePhysicalFile(string $file, string $path)
    {
        try {
            $file = $path . '/' . $file;
            if (file_exists($file)) {
                unlink($file);
                return true;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
            throw new \Exception('Sorry could not remove file.');
        }
    }
}
