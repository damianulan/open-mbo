<?php

namespace App\Exceptions\Core;

use Symfony\Component\HttpKernel\Exception\HttpException;

class UnauthorizedAccess extends HttpException
{
    protected $message;

    protected $code = 403;

    public function __construct(string $message = '', ?string $permission = null)
    {
        $this->message = empty($message) ? $message : '<div>' . $message . '</div>';
        if ($permission) {
            $this->message .= '<div>' . __('gates.permissions.' . $permission) . '</div>';
        }

        parent::__construct($this->code, $this->message, null, [], $this->code);
    }
}
