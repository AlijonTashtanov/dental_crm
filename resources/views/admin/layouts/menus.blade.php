<li class="nav-item">
    <a href="{{route('admin.index')}}" class="nav-link @if (request()->is('admin')) active @endif">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Bosh sahifa
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('admin.tariffs.index')}}" class="nav-link @if (request()->is('admin/tariffs')) active @endif">
        <i class="nav-icon fas fa-circle"></i>
        <p>
            Obunalar
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('admin.regions.index')}}" class="nav-link @if (request()->is('admin/regions')) active @endif">
        <i class="nav-icon fas fa-globe-asia"></i>
        <p>
            Viloyatlar
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('admin.clinics.index')}}" class="nav-link @if (request()->is('admin/clinics')) active @endif">
        <i class="nav-icon fas fa-hospital"></i>
        <p>
            Klinikalar
        </p>
    </a>
</li>
{{-- <li class="nav-item menu-open">
    <a href="#" class="nav-link active">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Dashboard
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="./index.html" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard v1</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="./index2.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard v2</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="./index3.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard v3</p>
            </a>
        </li>
    </ul>
</li> --}}
