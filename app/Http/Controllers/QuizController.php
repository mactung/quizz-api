<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    //
    public function index () {
        return view('quiz.index');
    }

    public function saveImageBase64 ($image64){
        $extension = explode('/', explode(':', substr($image64, 0, strpos($image64, ';')))[1])[1];
        $replace = substr($image64, 0, strpos($image64, ',')+1); 
            // find substring fro replace here eg: data:image/png;base64,
        $image = str_replace($replace, '', $image64); 
        $image = str_replace(' ', '+', $image); 
        $folder = str_split($word)[0];
        $imagePath = '/' . $folder. '/' . $word . '.' . $extension;
        File::delete('images' . $imagePath);
        Storage::disk('public_images')->put($imagePath, base64_decode($image));
        return $imagePath;
    }

    public function saveImage($url){
        $url = str_replace(' ', '%20', $url);
        $ch = curl_init ($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
        curl_setopt($ch,CURLOPT_TIMEOUT,3000);
        $raw = curl_exec($ch);
        curl_close ($ch);
        if(isset(pathinfo($url)['extension'])){
            $extension = pathinfo($url)['extension'];
            if (strpos($extension, '?') !== false) {
                $extension = explode('?', $extension)[0];
            }
            $folder = str_split($word)[0];
            $imagePath = '/' . $folder. '/' . $word . '.' . $extension;
            Storage::disk('public_images')->put($imagePath, $raw);
        }
        return $imagePath;
    }
}
