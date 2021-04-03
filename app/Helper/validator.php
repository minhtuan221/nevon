<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use Illuminate\Database\Eloquent\Model;

class Validator extends Model
{
    public static function shout(string $string)
    {
        return strtoupper($string);
    }

    public static function validateName(string $name)
    {
        if (strlen($name)<=6) {
            return response()->json(['error'=>'name missing or too short (<6 char)']);
        } elseif (strlen($name)>128) {
            return response()->json(['error'=>'name is too long (>128 char)']);
        }
        return $name;
    }
    
}

?>