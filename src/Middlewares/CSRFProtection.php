<?php

namespace App\Middlewares;

use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Security\Csrf\CsrfToken;

class CSRFProtection
{
    private $csrfTokenManager;

    public function __construct()
    {
        $this->csrfTokenManager = new CsrfTokenManager();
    }

    public function getToken()
    {
        return $this->csrfTokenManager->getToken('form');
    }

    public function isValidToken(string $token)
    {
        $csrfToken = new CsrfToken('form', $token);
        if (!$this->csrfTokenManager->isTokenValid($csrfToken)) {
            return false;
        }
    }
}
