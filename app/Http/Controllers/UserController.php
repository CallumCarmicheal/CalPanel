<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return redirect('/home');
    }

    public function getUserMessages($id) {
        $User = [
            'Me'    => [
                'Image' => Auth::user()->getGravatar(),
                'Name'  => Auth::user()->getName()
            ],

            'Him'   => [
                'Image'  => \App\User::getGravatarDefault(),
                'Name'   => 'John Doe'
            ]
        ];

        $MT_HIM  = 0;
        $MT_ME   = 1;

        // Some static messages
        $Messages = [[
            'Type'    => $MT_HIM,
            'Message' => 'Hello!'
        ], [
            'Type'    => $MT_ME,
            'Message' => 'Hi!'
        ], [
            'Type'    => $MT_ME,
            'Message' => 'Credibly innovate granular internal or "organic"'.
                         ' sources whereas high standards in web-readiness. '. 
                         'Energistically scale future-proof core competencies '. 
                         'vis-a-vis impactful experiences.'
        ], [
            'Type'    => $MT_HIM,
            'Message' => 'Dramatically synthesize integrated schemas with optimal networks.'
        ], [
            'Type'    => $MT_ME,
            'Message' => 'Interactively procrastinate high-payoff content'
        ], [
            'Type'    => $MT_HIM,
            'Message' => 'Globally incubate standards compliant channels before scalable '.
                         'benefits. Quickly disseminate superior deliverables whereas '.
                         'web-enabled applications. Quickly drive clicks-and-mortar catalysts'.
                         ' for change before vertical architectures.'
        ], [
            'Type'    => $MT_HIM,
            'Message' => 'Credibly reintermediate backend ideas for cross-platform models. '.
                         'Continually reintermediate integrated processes through technically '.
                         'sound intellectual capital. Holistically foster superior methodologies '.
                         'without market-driven best practices.'
        ], [
            'Type'    => $MT_ME,
            'Message' => 'Distinctively exploit optimal alignments for intuitive bandwidth'
        ], [
            'Type'    => $MT_HIM,
            'Message' => 'Quickly coordinate e-business applications through.'
        ]];

        return view(
            'layouts.dashboard.user.chat', 
            ['User' => $User, 'Messages' => $Messages]);
    }
}
