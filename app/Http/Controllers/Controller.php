<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use \Datetime;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use stdClass;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    // public function redirectLogin()
    // {
    // }

    // public function getMetaTags()
    // {
    // }

    public function uploadImg($fileUpload, $savePath, $ext=array('jpg', 'png', 'jpeg')) 
    {
        $result         = new stdClass();
        $now            = new DateTime();
        $listFileName   = array();
        $result->status = 'success';

        $fileExt = $fileUpload->extension();
        if ($fileUpload->isValid() && in_array($fileExt, $ext)) {
            $newFileName = md5($now->format('Y-m-d H:i:s')) . '.' . $fileUpload->extension();
            $fileUpload->move($savePath, $newFileName);
            array_push($listFileName, $newFileName);
        }
        else {
            $result->status = 'failed';
        }
        $result->items = $listFileName;

        return $result;
    }

}
