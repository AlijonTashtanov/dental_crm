@php
    $listItems = [
        [
            "label" => "Asosiy ma'lumotlar",
            "url" => route('admin.polyclinics.show',$response->id),
            "icon" => "fas fa-info-circle",
        ],
        [
            "label" => "To'lovlar",
            "url" => route('admin.one-polyclinic-payments.index',$response->id),
            "icon" => "fas fa-coins",
        ],
    ];
@endphp
<x-tab-menu :items="$listItems"/>
