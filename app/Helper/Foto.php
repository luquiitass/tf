<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 10/10/17
 * Time: 16:22
 */

namespace App\Helper;


trait Foto
{
    public function guardarFoto($data , $path, $nombre,$ext){

        //dd($data);
        if ($this->is_base64Image($data)){
            if (!str_contains($data,'user.png')){
                $base64_str = substr($data, strpos($data, ",")+1); // get the image code
                $image = base64_decode($base64_str); // decode the image
                $new_path = getcwd().'/img/' . $nombre .'.'. $ext;
                file_put_contents($new_path ,$image);
            }
        }else{
            \Log::info("Imagen no es base64");
        }
    }

    public function is_base64Image($s)
    {
            \Log::info('doto' . $s);
          return str_contains($s,'image/') && str_contains($s,';base64,');

    }

}