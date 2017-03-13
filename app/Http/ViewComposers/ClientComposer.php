<?php

namespace App\Http\ViewComposers;

use Auth;
use Illuminate\View\View;
use App\Repositories\ClientRepository;

class ClientComposer
{
    /**
     * client repository instance
     * @var App\Repositories\ClientRepository
     */
    private $clients;

    public function __construct(ClientRepository $clients)
    {
        $this->clients = $clients;
    }
    /**
     * Bind data to the view.
     *
     * @param  Illuminate\Support\Facades\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('countOfLockedClients', number_format($this->clients->countOfLockedClients()));
        $view->with('countOfUnockedClients', number_format($this->clients->countOfUnockedClients()));
    }
}
