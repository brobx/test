<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageHelper
{
    /**
     * @var string
     */
    protected static $imagePath = 'uploads/';

    /**
     * The file that was uploaded.
     *
     * @var UploadedFile
     */
    protected $file;

    /**
     * @var
     */
    protected $name;

    /**
     * @var string
     */
    protected $parameterName;

    /**
     * ImageService constructor.
     * @param UploadedFile $file
     * @param string $parameterName
     */
    public function __construct (UploadedFile $file, $parameterName = 'image')
    {
        $this->file = $file;
        $this->name = time() . "{$file->getClientOriginalName()}";
        $this->parameterName = $parameterName;
    }

    /**
     * Named constructor.
     *
     * @param Request $request
     * @param string $parameterName
     * @return ImageHelper|null
     */
    public static function fromRequest(Request $request, $parameterName = 'image')
    {
        // no image file.
        if(! $request->hasFile($parameterName))
        {
            return null;
        }

        $instance = new static($request->file($parameterName));

        return $instance;
    }

    /**
     * @param $image
     * @return bool
     */
    public static function delete($image)
    {
        return File::delete(static::$imagePath . $image);
    }

    /**
     * Moves the file to a subdirectory within the uploads.
     *
     * @return $this
     */
    public function move()
    {
        $this->file->move(static::$imagePath, $this->name);

        return $this;
    }

    /**
     * Saves the uploaded image.
     *
     * @return mixed
     */
    public function save()
    {
        // Move new image to the path
        $this->move();

        return $this->name;
    }

    /**
     * Deletes the old image.
     *
     * @param $image
     * @return bool
     */
    public function deleteImage($image)
    {
        if(! $image)
        {
            return true;
        }

        return File::delete(static::$imagePath . $image);
    }

    /**
     * @param $name
     * @return string
     */
    public static function getImagePath($name)
    {
        if(filter_var($name, FILTER_VALIDATE_URL))
        {
            return $name;
        }

        return '/' . static::$imagePath . $name;
    }
}