<?php
namespace App\Helpers; // Your helpers namespace 

use Illuminate\Http\UploadedFile;
use Exception;
use Illuminate\Support\Facades\URL;
use App\Models\Error;
use Illuminate\Support\Facades\Log;
class Helper
{
   public static function ImageInsert(UploadedFile $file,$path,$null=null)
   {
        try{
            if($file->getSize()!=null){
                $file_name = $null.'-'.'file-' . time() . '-' . rand(0, 99) . '.' . $file->extension();
                $file->move(public_path($path),$file_name);
                $basepath=$path.$file_name;
                return $basepath;
            }
        }
        catch(Exception $ex){
            
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }
}