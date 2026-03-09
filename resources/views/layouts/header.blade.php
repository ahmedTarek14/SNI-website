<div class="top-header">
    <div class="toggle-icon" data-toggle="tooltip" data-placement="right" title="Toggle Menu">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <ul class="top-header-links">
        <li>
            <button type="button" class="dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true"
                aria-expanded="false">
                <img src="{{ aurl('images/user-1.png') }}">
                <span>{{ auth()->user()->name }}</span>
            </button>
            <div class="dropdown-menu">
                <ul>
                    <li>
                        <a href="{{ route('admin.settings.index') }}">
                            <i class="fa fa-cog"></i>
                            setting
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" onclick="$('#logout-form').submit()">
                            <i class="fa fa-power-off"></i>
                            logout
                        </a>
                    </li>
                </ul>
            </div><!--End Dropdown Menu-->
        </li><!--End Li-->
    </ul>
</div><!--End Top Header-->
<form method="post" action="{{ route('admin.logout') }}" id="logout-form">
    @csrf
</form>
