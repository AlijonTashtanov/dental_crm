@php
    $listItems = [
        [
            "label" => "Asosiy ma'lumotlar",
            "url" => route('admin.polyclinics.show',$response->id),
            "icon" => "fas fa-info-circle",
            'urlName' => 'admin.polyclinics.show'
        ],
        [
            "label" => "To'lovlar",
            "url" => route('admin.one-polyclinic-payment.index',$response->id),
            "icon" => "fas fa-coins",
            'urlName' => 'admin.one-polyclinic-payment.index'
        ],
        [
            "label" => "Obunalari",
            "url" => route('admin.one-polyclinic-tariff.index',$response->id),
            "icon" => "fas fa-circle",
            'urlName' => 'admin.one-polyclinic-tariff.index'
        ],
    ];
@endphp

<x-tab-menu-component :items="$listItems"/>


