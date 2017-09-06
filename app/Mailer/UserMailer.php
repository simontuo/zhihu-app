<?php
namespace App\Mailer;

use Auth;

class UserMailer extends Mailer
{
    public function followNotifyEmail($email)
    {
        $data = [
            'url'  => 'http://zhihu.dev',
            'name' => Auth::guard('api')->user()->name,
        ];

        $this->sendTo('test_template', $email, $data);
    }

    public function passwordReset($email, $token)
    {
        $data = [
            'url' => url(config('app.url').route('password.reset', $token, false)),
        ];

        $this->sendTo('test_template_active', $email, $data);
    }

    public function welcome(User $user)
    {
        $data = [
            'url' => route('email.verify', ['token' => $user->confirmation_token]),
            'name' => $user->name
        ];

        $this->sendTo('test_template', $user->email, $data);
    }
}
