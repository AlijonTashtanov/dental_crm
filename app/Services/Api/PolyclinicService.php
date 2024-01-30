<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\UserResource;
use App\Models\Polyclinic;
use App\Models\TempUser;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PolyclinicService extends AbstractService
{
    protected $model = Polyclinic::class;

    /**
     * Test rejimda ishlayabdimi yo'qmi shuni belgilaydi
     * @var bool
     */
    private bool $is_test = true;

    /**
     * Tasdiqlash kodining amal muddati (sekund)
     */
    const VERIFICATION_DURATION = 120;

    /**
     * Tasdiqlash kodini qayta jo'natish vaqti (sekund)
     */
    const RESEND_CODE_AFTER = 60;

    //<editor-fold desc="step1">

    /**
     * @param array $data
     * @return JsonResponse|mixed
     */
    public function register(array $data)
    {
        $fields = $this->getFields();

        $rules = [];

        foreach ($fields as $field) {

            $rules[$field->getName()] = $field->getRules();
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {

            $errors = [];

            foreach ($validator->errors()->getMessages() as $key => $value) {

                $errors[$key] = $value[0];
            }

            return [
                'status' => false,
                'message' => 'Validation error',
                'statusCode' => 403,
                'data' => $errors
            ];
        }

        $data = $validator->validated();
        $checkPhone = $this->checkPhoneAndUsername($data);
        if ($checkPhone) {
            return $checkPhone;
        }
        DB::beginTransaction();
        try {
            $code = $this->generateCode();
            $tempUser = new TempUser();
            $tempUser->username = $data['username'];
            $tempUser->phone = clearPhone($data['phone']);
            $tempUser->name = $data['name'];
            $tempUser->full_name = $data['full_name'];
            $tempUser->address = $data['address'];
            $tempUser->region_id = $data['region_id'];
            $tempUser->password_hash = bcrypt($data['password']);
            $tempUser->code = $code;
            $tempUser->expired_at = time() + self::VERIFICATION_DURATION;

            if ($tempUser->save() && $this->sendCodeViaSms($code)) {
                DB::commit();
            } else {
                DB::rollback();
                return [
                    'status' => false,
                    'message' => 'Sms service or temp user error',
                    'statusCode' => 500,
                    'data' => null
                ];
            }

        } catch (\Exception $ex) {
            DB::rollback();
            return [
                'status' => false,
                'message' => 'Server error',
                'statusCode' => 500,
                'data' => $ex->getMessage()
            ];
        }


        return [
            'status' => true,
            'message' => 'success',
            'statusCode' => 200,
            'data' => null
        ];
    }

    /**
     * Kodni sms orqali jo'natish
     */
    public function sendCodeViaSms($code)
    {

        $domain = 'dentalpro.uz';

        $message = $domain . ' tizimidagi tasdiqlash kodi: ' . $code;

        if ($this->is_test) {
            return true;
        }

//        return Yii::$app->smsgo->send($this->getClearPhone(), $message);
    }

    /**
     * @return int
     */
    public function generateCode()
    {
        if ($this->is_test) {
            return 7777;
        }
        return mt_rand(1000, 9999);
    }

    /**
     * @param array $data
     * @return array|false
     */
    public function checkPhoneAndUsername(array $data)
    {
        $phone = clearPhone($data['phone']);

        if (empty($phone)) {
            return [
                'status' => false,
                'message' => "Phone number empty",
                'statusCode' => 403,
                'data' => null
            ];
        }

        if (!(strlen(clearPhone($phone)) <= 13) && !(strlen(clearPhone($phone)) >= 13)) {
            return [
                'status' => false,
                'message' => 'Incorrect phone number',
                'statusCode' => 403,
                'data' => null
            ];
        }

        $polyclinic = Polyclinic::where(['phone' => $phone])->first();

        if ($polyclinic) {
            return [
                'status' => false,
                'message' => 'Bu telefon raqam bilan allaqachon klinika ochilgan!',
                'statusCode' => 403,
                'data' => null
            ];
        }

        if ($polyclinic && $polyclinic->status == Polyclinic::$status_inactive) {
            return [
                'status' => false,
                'message' => "Sizning klinikangiz admin tomonidan nofaol qilingan",
                'statusCode' => 403,
                'data' => null
            ];
        }

        $user = User::where(['username' => $data['username']])
            ->first();

        if ($user) {
            return [
                'status' => false,
                'message' => "This username  has already been taken",
                'statusCode' => 403,
                'data' => null
            ];
        }
    }


    /**
     * @return array|bool
     */
    public function checkCode(array $data)
    {
        $tempUser = TempUser::where('phone', clearPhone($data['phone']))
            ->where('code', $data['code'])
            ->where('is_verified', false)
            ->where('is_registered', false)
            ->orderBy('id', 'desc')
            ->first();

        if (!$tempUser) {

            return [
                'status' => false,
                'message' => 'Invalid verification code',
                'statusCode' => 403,
                'data' => null
            ];
        }

        if ($tempUser->getIsExpired()) {

            return [
                'status' => false,
                'message' => 'Verification code has been expired',
                'statusCode' => 403,
                'data' => null
            ];
        }

        $tempUser->is_verified = true;
        $tempUser->save();
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return [
            TextField::make('name')->setRules('required|min:3|max:255'),
            TextField::make('phone')->setRules('required|min:3|max:15'),
            TextField::make('address')->setRules('required|min:5|max:1024'),
            TextField::make('region_id')->setRules('required|integer'),
            TextField::make('full_name')->setRules('required|min:5|max:1024'),
            TextField::make('username')->setRules('required|min:5|max:1024'),
            TextField::make('password')->setRules('required|min:5|max:1024'),
            TextField::make('repeat_password')->setRules('required|same:password'),
        ];
    }
    //</editor-fold>


    //<editor-fold desc="step2">

    /**
     * @param array $data
     * @return array|bool|void
     */
    public function verify(array $data)
    {
        $fields = $this->getVerifyFields();

        $rules = [];

        foreach ($fields as $field) {

            $rules[$field->getName()] = $field->getRules();
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {

            $errors = [];

            foreach ($validator->errors()->getMessages() as $key => $value) {

                $errors[$key] = $value[0];
            }

            return [
                'status' => false,
                'message' => 'Validation error',
                'statusCode' => 403,
                'data' => $errors
            ];
        }

        $checkCode = $this->checkCode($data);
        if ($checkCode) {
            return $checkCode;
        }
        $saveData = $this->saveRegitsered($data);
        if ($saveData) {
            return $saveData;
        }
    }

    /**
     * @return array|bool
     */
    public function saveRegitsered(array $data)
    {
        $model = TempUser::where('is_verified', true)
            ->where('code', $data['code'])
            ->where('phone', clearPhone($data['phone']))
            ->orderBy('id', 'desc')
            ->first();

        $model->is_registered = true;
        $model->save();
        DB::beginTransaction();

        try {
            $polyclinicModel = Polyclinic::create([
                'name' => $model->name,
                'phone' => $model->phone,
                'address' => $model->address,
                'region_id' => $model->region_id,
                'status' => Polyclinic::$status_active,
            ]);

            $user = User::create([
                'name' => $model->full_name,
                'password' => $model->password_hash,
                'polyclinic_id' => $polyclinicModel->id,
                'phone' => $model->phone,
                'username' => $model->username,
                'role' => User::$role_admin,
                'position' => "Admin",
                'status' => User::$status_active
            ]);

            $token = $user->createToken('API Token')->accessToken;
            DB::commit();
        } catch
        (\Exception $ex) {
            DB::rollback();
            return [
                'status' => false,
                'message' => 'Server error',
                'statusCode' => 500,
                'data' => $ex->getMessage()
            ];
        }

        return [
            'status' => true,
            'message' => 'success',
            'statusCode' => 200,
            'data' => [
                'user' => UserResource::make($user),
                'token' => $token
            ]
        ];
    }


    /**
     * @return array
     */
    public function getVerifyFields()
    {
        return [
            TextField::make('phone')->setRules('required|min:3|max:15'),
            TextField::make('code')->setRules('required|min:4|max:4'),
        ];
    }
    //</editor-fold>

    //<editor-fold desc="Login">
    /**
     * @param array $data
     * @return array
     */
    public function login(array $data)
    {
        $fields = $this->getLoginFields();

        $rules = [];

        foreach ($fields as $field) {

            $rules[$field->getName()] = $field->getRules();
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {

            $errors = [];

            foreach ($validator->errors()->getMessages() as $key => $value) {

                $errors[$key] = $value[0];
            }

            return [
                'status' => false,
                'message' => 'Validation error',
                'statusCode' => 403,
                'data' => $errors
            ];
        }

        $data = [
            'username' => $data['username'],
            'password' => $data['password']
        ];

        if (Auth::attempt($data)) {
            $user = UserResource::make(auth()->user());
            $token = $user->createToken('LaravelAuthApp')->accessToken;

            return [
                'status' => true,
                'message' => 'success',
                'statusCode' => 200,
                'data' => [
                    'user' => $user,
                    'token' => $token
                ]
            ];
        }
        return [
            'status' => false,
            'message' => 'Username or Password is incorrect',
            'statusCode' => 401,
            'data' => null
        ];
    }

    /**
     * @return array
     */
    public function getLoginFields()
    {
        return [
            TextField::make('username')->setRules('required|min:5|max:1024'),
            TextField::make('password')->setRules('required|min:5|max:1024'),
        ];
    }
    //</editor-fold>
}
