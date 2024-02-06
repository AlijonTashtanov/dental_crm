<?php

namespace App\Services;

use App\Models\TelegramUser;

class TelegramUserService extends AbstractService
{
    public function __construct(TelegramUser $telegramuser)
    {
        $this->model = $telegramuser;
    }
}
