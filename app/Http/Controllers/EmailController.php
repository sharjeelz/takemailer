<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Http\Requests\EmailRequest;
use App\Mailer\MailjetSender;
use App\Mailer\MailSender;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Queue;

class EmailController extends Controller
{

  
  public function index(Email $email)
  {
   return $email->getJobs();
  }

  /**
   * @param EmailRequest $request
   * @return JsonResponse
   */
  public function save(EmailRequest $request): JsonResponse
  {
    $data = $request->validated();
    $email = new Email();
    $email->to = $data['to'];
    $email->subject = $data['subject'];
    $email->message = $data['message'];
    $email->save();

    dispatch(new \App\Jobs\SendEmail($email));
    return response()
      ->json(['message' => 'Email Sent'])
      ->setStatusCode(201);
  }
}
