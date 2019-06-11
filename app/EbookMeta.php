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
        'Languages' => 'language',
        'Published' => 'date'
    ];

    public function read($path, $id)
    {
        if(!is_file($path))
            throw new FileNotFoundException($path);

        if(env('APP_ENV') === 'testing')
            $cover = storage_path("app/public/covers/$id.jpg");
        else
            $cover = storage_path("app/public/covers/testing/$id.jpg");
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
            $items = [];
            $items[] = substr($prop, 0, 20);
            $items[] = substr($prop, 21);
            $items = array_map(function($item){ return trim($item); }, $items);
            if(array_key_exists($items[0], self::$ebookProps))
                $ebookMeta[self::$ebookProps[$items[0]]] = $items[1];
            else {
                continue;
            }
        }
        return $ebookMeta;
    }

    public function write($path, $data)
    {
        $cmd = "ebook-meta $path";

        foreach($data as $key => $value)
        {
            if(!in_array($key, array_values(self::$ebookProps))) continue;
            if(!is_string($value))
                $value = '';
            $cmd .= ' --'.$key.'="'.$value.'"';
        }

        $path_cover = storage_path("app/public/{$data['id']}.jpg");
        if(is_file($path_cover))
            $cmd .= " --cover='$path_cover'";

        $process = Process::fromShellCommandline($cmd);
        $process->run();

        if(!$process->isSuccessful())
            throw new ProcessFailedException($process);

        return $process->getOutput();
    }
}
