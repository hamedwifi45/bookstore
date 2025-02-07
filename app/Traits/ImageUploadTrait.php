<?php
namespace App\Traits;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; // أو استخدام Imagick

trait ImageUploadTrait {
    protected $image_path = 'app/public/images/covers';
    protected $img_height = 600;
    protected $img_width = 600;

    public function uploadImg($img) {
        $img_name = $this->imageName($img);

        // إنشاء كائن ImageManager
        $manager = new ImageManager(new Driver());

        // تحميل الصورة وتعديلها
        $image = $manager->read($img->getRealPath());
        $image->resize($this->img_width, $this->img_height);
        $image->save(storage_path($this->image_path . '/' . $img_name));

        return 'images/covers/' . $img_name;
    }

    public function imageName($img) {
        return time() . "-" . $img->getClientOriginalName();
    }
}