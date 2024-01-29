<?php

namespace App\Traits;

use Illuminate\Support\Arr;

trait Status
{
    /**
     * Holati faol
     * @var int
     */
    public static int $status_active = 1;

    /**
     * Holati nofaol hiosblanadi
     * @var int
     */
    public static int $status_inactive = 0;

    /**
     * Holati kutish hiosblanadi
     * @var int
     */
    public static int $status_waiting = 2;


    /**
     * @return string[]
     */
    public static function statuses()
    {
        return [
            self::$status_active => 'Faol',
            self::$status_inactive => 'Nofaol',
            self::$status_waiting => "Kutish holatida"
        ];
    }

    /**
     * @return array|\ArrayAccess|mixed|string
     */
    public function getStatusName()
    {
        return Arr::get(self::statuses(), $this->status);
    }

    /**
     * @return string
     */
    public function getStatusBadgeName()
    {
        if ($this->status == self::$status_inactive) {

            return "<span class='badge badge-danger'>{$this->getStatusName()}</span>";
        }

        if ($this->status == self::$status_waiting) {

            return "<span class='badge badge-warning'>{$this->getStatusName()}</span>";
        }

        return "<span class='badge badge-success'>{$this->getStatusName()}</span>";
    }

    /**
     * @return bool
     */
    public function isChecked()
    {
        return $this->status == self::$status_active ? 'checked' : '';
    }
}
