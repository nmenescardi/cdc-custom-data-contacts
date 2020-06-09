<?php

namespace App\Feedback;

interface FeedbackInterface
{

    public function success(string $message);

    public function error(string $message);

    public function info(string $message);

    public function warning(string $message);
}
