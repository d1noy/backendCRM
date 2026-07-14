<?php

namespace App\Models;

use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'images',
        'category_id',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    /**
     * Add Category
     *
     * @return HasOne
     */


    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }


    /**
     * Default image
     *
     * @return Attribute
     */
    public function defaultImage(): Attribute
    {
        return Attribute::get(function (){
            if(isset($this->images[0]) && is_string($this->images[0])){
               return asset($this->images[0]);
            }
            return '';
        });
    }

    /**
     * Get image_urls attribute
     *
     * @return Attribute
     */
    public function imageUrls(): Attribute
    {
        return Attribute::get(function (){
            if(isset($this->images[0]) && is_string ($this->images[0])){
                $images = [];

                foreach ($this->images as $image){
                    $images[] = asset($image);
                }
                return $images;
            }
            return [];
        });
    }
    /**
     * Images
     *
     * @param array|UploadedFile|null $files
     * @return void
     */
    public function updateImages(array|UploadedFile|null $files)
    {
        if($files){
            $images = [];

            foreach($files as $image){
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

                $outputPath = public_path('images/') . '/' . $imageName;
                if(file_exists($image->getRealPath())){
                    $this->createThumbinalWithWatermark($image->getRealPath(), $outputPath);
                    $images[] = 'images/' .  $imageName;
                }
            }

            $this->images = $images;
            $this->save();
        }
    }

    /**
     * Watermark
     *
     * @param $sourcePatch
     * @param $outputPatch
     * @return void
     */
    private function createThumbinalWithWatermark($sourcePatch, $outputPatch): void
    {
        [$originalWidth, $originalHeight,$imageType] = getimagesize($sourcePatch);


        $srcImage = match ($imageType){
            IMAGETYPE_JPEG => imagecreatefromjpeg($sourcePatch),
            IMAGETYPE_PNG => imagecreatefrompng($sourcePatch ),
        };

        $maxWidth = 300;
        $maxHeight = 300;

        if($originalWidth > $originalHeight){
            $newWidth = $originalWidth;
            $newHeight = $originalHeight * $newWidth / $originalWidth;
        }
        else{
            $newHeight = $maxHeight;
            $newWidth = $originalWidth * $newHeight / $originalHeight;

        } if($newWidth > $maxWidth){
            $newWidth = $maxWidth * $newHeight / $originalWidth;
            $newHeight = $maxWidth;
        }
        if($newHeight > $maxHeight){
            $newWidth = $maxHeight * $newHeight / $newHeight;
            $newHeight = $maxHeight;
        }

        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresized($newImage, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);
        $text = 'Shop';
        $fontSize = 10;
        $fontColor = imagecolorallocate($newImage, 100, 100, 100);
        imagestring($newImage, $fontSize, $newWidth - 40, $newHeight - 40, $text, $fontColor);
        imagejpeg($newImage, $outputPatch, 90);
        imagedestroy($newImage);
        imagedestroy($srcImage);
    }

}
