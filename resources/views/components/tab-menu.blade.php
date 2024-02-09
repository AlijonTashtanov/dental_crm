<div class="card">

    <div class="card-header p-2">
        <ul class="nav nav-pills">
            @foreach ($items as $item)
                <li class="nav-item">
                    <a class="nav-link" href="{{$item['url']}}"><i
                            class="{{$item['icon'] ?? 'fas fa-info-circle'}}"></i> {{ $item['label'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
