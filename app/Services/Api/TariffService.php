<?php

namespace App\Services\Api;

use App\Http\Resources\TariffResource;
use App\Models\Tariff;
use Illuminate\Support\Facades\DB;

class TariffService extends AbstractService
{
    protected $model = Tariff::class;

    /**
     * @return array|mixed
     */
    public function index()
    {
        $tariffGroups = DB::table('tariffs')
            ->select(['duration_text', DB::raw('count(*) as total')])
            ->groupBy('duration_text')
            ->get();
        $array = [];

        foreach ($tariffGroups as $group) {

            $tariffs = $this->model::where('status', Tariff::$status_active)
                ->where('duration_text', $group->duration_text)->get();

            if ($tariffs) {
                $array[] = [
                    'groupName' => $group->duration_text,
                    'tariffs' => TariffResource::collection($tariffs),
                ];
            }

        }

        return $this->sendResponse(true, 'Get all tariffs', 200, $array);
    }
}
