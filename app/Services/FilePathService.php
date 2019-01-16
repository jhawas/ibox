<?php
namespace App\Services;
class FilePathService
{
    /**
     * set path
     *
     * @return void
     */
    static function setPath($path)
    {
        
        // explode by /
        $explode_path = explode('/', $path);
        // removed first value in array wich is the public of the path
        unset($explode_path[0]);
        // return back to his format
        $implode_path = implode('/',$explode_path);
        return $implode_path;
    }
}