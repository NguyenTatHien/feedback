<?php namespace Nguyenhien\Feedback\Components;

use Cms\Classes\ComponentBase;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Winter\Storm\Support\Facades\Flash;
use Winter\Storm\Support\Facades\Mail;

class Mails extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'Feedback',
            'description' => 'Liên hệ',
        ];
    }

    public function defineProperties()
    {
        return [
            'to' => [
                'title' => 'Mail To',
                'type' => 'string',
                'required' => true,
                'validationPattern' => '^[A-Za-z0-9]+[A-Za-z0-9]*@[A-Za-z0-9]+(\\.[A-Za-z0-9]+)$',
                'validationMessage' => 'Please enter a valid email',
            ],
            'cc' => [
                'title' => 'Mail Cc',
                'type' => 'string',
                'validationPattern' => '^([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,},?\s*)+$',
                'validationMessage' => 'Please enter a valid email',
            ],
        ];
    }

    public function onRun()
    {
        $this->page['currentLocale'] = $this->getCurrentLocale();
    }

    protected function getCurrentLocale() {
        return App::getLocale();
    }

    public function onSendMailFromCustomer()
    {
        $fullName = post('name');
        $email = post('email');
        $title = post('title');
        $content = post('content');
        $toEmail = $this->property('to');
        $ccEmails = $this->property('cc');
        $ccEmailsArray = array_map('trim', explode(',', $ccEmails));
        $vars = ['name' => $fullName, 'email' => $email, 'title' => $title, 'content' => $content];
        
        if (empty($fullName) || empty($email) || empty($title) || empty($content)) {
            Flash::error('Fill in all the required fields!!!');
            return;
        }
        try {
            Mail::sendTo($email, 'alila.user::mail.success', $vars);
            if (!empty($ccEmails)) {
                Mail::send('user.feedback', $vars, function($message) use ($toEmail, $ccEmailsArray) {
                    $message->to($toEmail);
                    $message->cc($ccEmailsArray);
                });
                return Redirect::to('/demo/plugins/mailsuccess');
            } else {
                Mail::send('user.feedback', $vars, function($message) use ($toEmail) {
                    $message->to($toEmail);
                });
                return Redirect::to('/demo/plugins/mailsuccess');
            }
        } catch (Exception $e) {
            Flash::error('Sending Failed!!!');
        }  
    }
}