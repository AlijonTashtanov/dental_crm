<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempUser extends Model
{
    protected $fillable = ['phone', 'username', 'region_id', 'name', 'full_name', 'address', 'password_hash', 'code', 'expired_at', 'is_verified', 'is_registered'];

    public static function search($search)
    {
        return empty($search)
            ? static::query()
            : static::query()->where('name', 'like', '%' . $search . '%');
    }

    /**
     * @return bool
     */
    public function getIsExpired(): bool
    {
        return time() > $this->expired_at;
    }

    /**
     * @return bool
     */
    public function verify(): bool
    {
        $this->is_verified = true;
        return $this->save(false);
    }

    /**
     * Register yoki Resetda tel. raqamni kiritib, sms junatilganidan keyin
     * agar user qayta sms jo'natishni bossa, qayta sms jo'natishga ehtiyoj bormi?
     * Masalan, user 1 daqiqa (60 sekund) dan keyingina sms jo'natishi mn.
     * @param int $verificationDuration sekund - kodni yaroqlilik muddati
     * @param int $resendCodeAfter sekund - qayta smsni necha sekunndan keyin jo'natishi mn.
     * @return bool
     */
    public function needResendCode(int $verificationDuration, int $resendCodeAfter)
    {
        if ($this->is_registered || $this->is_verified) {
            return true;
        }

        if ($this->getIsExpired()) {
            return true;
        }

        /** @var int kodni generatsiya qilingan vaqti */
        $generatedTime = $this->expired_at - $verificationDuration;

        /** @var int kodni qayta jo'natish mn bo'lgan vaqt */
        $resendTime = $generatedTime + $resendCodeAfter;

        // agar hozirgi vaqt kodni qayta jo'natish mn bo'lgan vaqtdan katta bo'lsa, demak
        // kodni qayta jonatish mn
        return time() > $resendTime;
    }
}
