<?php

namespace App;

use League\Flysystem\FileNotFoundException;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class EbookMeta
{
    private static $ebookProps = [
        'Title' => 'title',
        'Author(s)' => 'authors',
        'Comments' => 'comments',
        'Tags' => 'tags',
        'Identifiers' => 'identifier',
        'Publisher' => 'publisher',
        'Languages' => 'languages',
        'Published' => 'pubdate'
    ];

    public static function read($path, $id)
    {
        if(!is_file($path))
            throw new FileNotFoundException($path);

        $cover = storage_path("app/public/covers/$id.jpg");
        $process = Process::fromShellCommandline("ebook-meta $path --get-cover=$cover");
        $process->run();

        if(!$process->isSuccessful())
            throw new ProcessFailedException($process);
        $output = preg_split('/\r\n|\r|\n/', $process->getOutput());

        array_pop($output);

        $ebookMeta = [];

        $ebookMeta['cover'] = strstr($process->getOutput(), 'Cover saved to') !== FALSE;

        foreach($output as $prop)
        {
            $items = explode(": ", $prop);
            $items = array_map(function($item){ return trim($item); }, $items);

            if(array_key_exists($items[0], self::$ebookProps))
                $ebookMeta[self::$ebookProps[$items[0]]] = $items[1];
            else {
                continue;
            }
        }

        return $ebookMeta;
    }

    public static function write($path, $data)
    {
        $cmd = "ebook-meta $path";

        foreach($data as $key => $value)
        {
            if(!$value) continue;
            $cmd .= " --$key=$value";
        }

        $path_cover = storage_path("app/public/{$data['id']}.jpg");
        if(is_file($path_cover))
            $cmd .= " --cover=$path_cover";

        $process = Process::fromShellCommandline($cmd);
        $process->run();

        if(!$process->isSuccessful())
            throw new ProcessFailedException($process);

        return $process->getOutput();
    }
}
