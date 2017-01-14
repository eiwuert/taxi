<?php

namespace App\Repositories;

use App\Client;

class ClientRepository
{
    /**
     * Count of unlocked clients.
     * @return numeric
     */
    public function countOfUnockedClients()
    {
        return Client::unlocked()->count();
    }

    /**
     * Count of locked clients.
     * @return numeric
     */
    public function countOfLockedClients()
    {
        Client::locked()->count();
    }
}
