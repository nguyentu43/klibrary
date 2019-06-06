<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Book;
use App\EbookConvert;
use Imtigger\LaravelJobStatus\Trackable;
use Illuminate\Support\Facades\Auth;

class ConvertFormat implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Trackable;

    public $timeout = 600;

    protected $book;
    protected $format;
    protected $profile;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Book $book, $format, $profile)
    {
        $this->prepareStatus();
        $this->book = $book;
        $this->profile = $profile;
        $this->format = $format;
        $this->setInput([__('app.job.convert', ['format' => $format, 'title' => $book->title]), Auth::user()->id]);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $book = $this->book;
        EbookConvert::convert($book->id, $book->formats[0], $this->format, $this->profile);
        $formats = $book->formats;
        array_push($formats, $this->format);
        $book->formats = $formats;
        $book->save();
    }
}
