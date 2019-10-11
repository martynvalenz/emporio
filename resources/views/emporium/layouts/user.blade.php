<!-- User Info -->
<div class="user-info" style="background-color: #093697;">
    <div class="image">
        <img src="{{ asset('images/users/'.Auth::user()->imagen) }}" width="55" height="55" alt="User" />
    </div>
    <div class="info-container">
        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->iniciales }} - {{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</div>
        <div class="email">{{ Auth::user()->puestos->puesto }}</div>
        <div class="btn-group user-helper-dropdown">
            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
            <ul class="dropdown-menu pull-right">
                <li><a href="javascript:void(0);"><i class="material-icons">person</i>Perfil</a></li>
                <li role="seperator" class="divider"></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); 
                    document.getElementById('logout-form').submit();"
                    title="Cerrar sesión"><i class="material-icons col-pink">input</i>Cerrar sesión</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- #User Info -->