<?php

namespace App\Jobs;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\Facades\Image;
use Storage;

class CropImages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $images;
    private string $taskId;
    protected const DESKTOP_WIDTH = 1024;
    protected const DESKTOP_HEIGHT = 720;
    protected const MOBILE_WIDTH = 517;
    protected const MOBILE_HEIGHT = 360;


    /**
     * Create a new job instance.
     *
     * @param array $images
     * @param string $taskId
     */
    public function __construct(array $images, string $taskId)
    {
        //
        $this->images = $images;
        $this->taskId = $taskId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $images = [];
        foreach ($this->images as $image) {
            $filename = time() . "." . $image->getClientOriginalExtension();
            $image = Image::make($image->getRealPath());
            $desktop = $image->crop(self::DESKTOP_WIDTH, self::DESKTOP_HEIGHT);
            $mobile = $image->crop(self::MOBILE_WIDTH, self::MOBILE_HEIGHT);

            $image->stream();
            $desktop->stream();
            $mobile->stream();

            Storage::disk("local")->put("public/task_images/original/$filename", $image, "public");
            Storage::disk("local")->put("public/task_images/mob/$filename", $desktop, "public");
            Storage::disk("local")->put("public/task_images/desktop/$filename", $mobile, "public");
            $images[] = $filename;
        }

        \DB::collection('tasks')
            ->where('_id', $this->taskId)
            ->push('images', $images);
    }
}
