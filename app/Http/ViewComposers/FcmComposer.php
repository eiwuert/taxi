<?php

namespace App\Http\ViewComposers;

use Auth;
use App\Status;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Repositories\FcmRepository;

class FcmComposer
{
    /**
     * FCM repository instance
     * @var App\Repositories\FcmRepository
     */
    private $fcm;

    public function __construct(FcmRepository $fcm)
    {
        $this->fcm = $fcm;
    }

    /**
     * Bind data to the view.
     *
     * @param  Illuminate\Support\Facades\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('dailySuccessfulMessagesOnMonth', js_json($this->fcm->dailyMessagesOnMonth(1)));
        $view->with('dailyFailedMessagesOnMonth', js_json($this->fcm->dailyMessagesOnMonth(0)));
    }
}