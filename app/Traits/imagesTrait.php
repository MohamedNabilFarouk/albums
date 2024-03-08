<?php

namespace App\Traits;


trait imagesTrait
{

    function saveImages($photo, $folder)
    {
        $file_origi_name = $photo->getClientOriginalName();
        $file_name = time().'-'.$file_origi_name;
        $path= $folder;
        $photo ->move($path , $file_name );
        return $file_name;
    }

}




