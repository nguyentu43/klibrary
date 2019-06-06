<?php

namespace App;

use League\Flysystem\FileNotFoundException;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class EbookConvert
{
    public static $supportTypes = [ 'azw', 'azw1', 'azw2', 'azw3', 'azw4', 'epub', 'mobi', 'prc', 'pdf', 'docx', 'rtf' ];

    public static function convert($id, $source, $target, $profile = 'default')
    {
        if(!in_array($source, self::$supportTypes) || !in_array($target, self::$supportTypes))
            throw new \Exception('Ext not support');

        $path = storage_path('app/ebooks');
        $source_path = $path."/$id.$source";

        if(!is_file($source_path))
            throw new FileNotFoundException($source_path);

        $target_path = $path."/$id.$target";

        $process = Process::fromShellCommandline("ebook-convert $source_path $target_path --output-profile=$profile");
        $process->setTimeout(60 * 10);
        $process->run();

        if(!$process->isSuccessful())
            throw new ProcessFailedException($process);

        return $process->getOutput();
    }

}