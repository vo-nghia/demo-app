<?php

namespace App\Services;

use Illuminate\Support\Facades\Session as FacadesSession;
use Shopify\Auth\Session;
use Shopify\Auth\SessionStorage;

class SessionService implements SessionStorage
{
    private const SESSION_NAME = 'shopify_session';

    public function loadSession(string $sessionId): ?Session
    {
        return json_decode(session(self::SESSION_NAME));
    }

    public function storeSession(Session $session): bool
    {
        return session(self::SESSION_NAME, json_encode($session));
    }

    public function deleteSession(string $sessionId): bool
    {
        FacadesSession::forget(self::SESSION_NAME);

        return true;
    }
}
