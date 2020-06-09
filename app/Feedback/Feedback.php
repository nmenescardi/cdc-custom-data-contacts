<?php

namespace App\Feedback;

class Feedback implements FeedbackInterface
{
    public function success($message)
    {
        toastr()->info($message);
    }

    public function error($message)
    {
        toastr()->error($message);
    }

    public function info($message)
    {
        toastr()->info($message);
    }

    public function warning($message)
    {
        toastr()->warning($message);
    }
}
