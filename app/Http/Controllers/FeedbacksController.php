<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Helpers\FirebaseHelper;
use App\Helpers\GeneralHelpers;
use Illuminate\Http\Request;

use App\Repositories\FeedbacksRepository;
use App\Libraries\FeedbacksLibrary;
use App\Libraries\UsersLibrary;
use Datatables;
use Validator;

class FeedbacksController extends Controller
{
    public function __construct()
    {
        // if (Session::get('user')['isAdmin'] == false && Session::get('user')['isHotel'] == false && !empty(Session::get('user'))) {
        //     return abort(404);
        // } elseif (empty(Session::get('user'))) {
        //     return Redirect::to('login')->send();
        // }
    }

    public function allFeedbacks()
    {
        return view('feedbacks.feedbacks_rates');
    }

    public function datatable(Request $request)
    {
        $path = GeneralHelpers::endsWith($request->path(), 'customers') ||
            GeneralHelpers::endsWith($request->path(), 'customers/')? 'feedback/customers': 'feedback/drivers';
        
        $feedbacks = FeedbacksRepository::getFeedbacks($path);
        $feedbacks = is_null($feedbacks)? []: $feedbacks;
        $objFeedbacks = [];
        foreach ($feedbacks as $key => $feedback) {
            if (is_array($feedback)) {
                $feedback['id'] = $key;
                $objFeedbacks [] = (object)$feedback;
            }
        }

        return Datatables::of($objFeedbacks)
            ->addColumn('subject', function ($feedback) {
                $subject = !isset($feedback->subject) ? 'unspecified' : $feedback->subject;
                return $subject;
            })
            ->addColumn('body', function ($feedback) {
                $body = !isset($feedback->body) ? 'unspecified' : $feedback->body;
                return $body;
            })
            ->addColumn('username', function ($feedback) {
                $username = !isset($feedback->username) ? 'unspecified' : $feedback->username;
                return $username;
            })
            ->addColumn('email', function ($feedback) {
                $email = !isset($feedback->email) ? 'unspecified' : $feedback->email;
                return $email;
            })
            ->make(true);
    }
}
