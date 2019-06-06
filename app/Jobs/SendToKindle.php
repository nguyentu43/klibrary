<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Book;
use Illuminate\Support\Facades\{Mail, Auth};
use Imtigger\LaravelJobStatus\Trackable;

class SendToKindle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Trackable;

    protected $book;
    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Book $book, $data)
    {
        $this->prepareStatus();
        $this->book = $book;
        $this->data = $data;
        $this->setInput([__('app.job.send_to_kindle', ['format' => $data['format'], 'title' => $book->title, 'email' => $data['email_to']]), Auth::user()->id ]);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $book = $this->book;
        $data = $this->data;
        Mail::raw('Send to kindle', function ($message) use($data, $book) {
            $message->from($data['email_from']);
            $message->to($data['email_to']);
            $path = storage_path('app/ebooks')."/$book->id.{$data['format']}";
            $filename = "$book->title.{$data['format']}";
            $message->attach($path, [ 'as' => $filename ]);
        });
    }
}
