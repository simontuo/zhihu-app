<?php
namespace App\Mailer;

use Mail;
use Naux\Mail\SendCloudTemplate;


class Mailer
{
    protected function sendTo($template, $email, array $data)
    {
        $content = new SendCloudTemplate($template, $data);

        Mail::raw($content, function ($message) use($email) {
            $message->from('526252066@qq.com', 'simontuo');
            $message->to($email);
        });
    }
}
