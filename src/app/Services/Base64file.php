<?php
namespace App\Services;

use Illuminate\Support\Arr;
use Imagick;

class Base64File
{

    protected $base;

    public function __construct($base)
    {
        $this->base = $base;
    }

    public function getMimeType()
    {
        $binary = $this->toBinary();
        $finfo  = finfo_open();
        return finfo_buffer($finfo, $binary, FILEINFO_MIME_TYPE);
    }

    public function getExtension()
    {
        $mimetype = $this->getMimeType();

        $extensions = [
            'image/jpeg'      => 'jpg',
            'image/png'       => 'png',
            'image/bmp'       => 'bmp',
            'image/svg+xml'   => 'svg',
            'application/pdf' => 'pdf',
            'application/vnd.ms-powerpoint' => 'ppt',
            'application/msword' => 'doc',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
        ];

        return Arr::has($extensions, $mimetype) ? $extensions[$mimetype] : null;
    }

    public function toBinary()
    {
        return base64_decode($this->stripHeader());
    }

    public function toFile($filepath)
    {
        $folder = substr($filepath, 0, strrpos($filepath, '/'));

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $data = $this->toBinary();

        return file_put_contents("$filepath", $data, FILE_BINARY);

    }

    public function resize($width, $height)
    {
        $image = new Imagick();

        $decoded_base64 = $this->toBinary();

        if ($image->readImageBlob($decoded_base64)) {
            if ($image->resizeImage($width, $height, Imagick::FILTER_LANCZOS, 1)) {
                $this->base = base64_encode($image);
                $image->destroy();
            } else {
                return false;
            }
        } else {
            $image->destroy();
            return false;
        }

        return true;
    }

    public function toJpgFile($filepath)
    {
        $folder = substr($filepath, 0, strrpos($filepath, '/'));

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $data = $this->toBinary();

        $image = new Imagick();

        $decoded_base64 = $this->toBinary();

        $image->readImageBlob($decoded_base64);

        $image->setImageFormat('jpg');

        return file_put_contents("$filepath", $image);
    }

    protected function stripHeader()
    {
        $index = strpos($this->base, ',');
        if ($index === false) {
            return $this->base;
        }

        return substr($this->base, $index + 1);
    }

}
