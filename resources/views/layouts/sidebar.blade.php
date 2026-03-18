@php
    $isDashboard = request()->routeIs('admin.dashboard');
    $isBanners = request()->routeIs('admin.banners.*');
    $isSections = request()->routeIs('admin.sections.*');
    $isSocial = request()->routeIs('admin.links.*');

    $isServices = request()->routeIs('admin.services.*');
    $isFaq = request()->routeIs('admin.faqs.*');
    $isProjects = request()->routeIs('admin.projects.*');

    $isSmartFeatures = request()->routeIs('admin.smart.features.*');
    $isSmartBenefits = request()->routeIs('admin.smart.benefits.*');
    $isSmart = $isSmartFeatures || $isSmartBenefits || request()->routeIs('smart.index');

    $isSettingsGeneral = request()->routeIs('admin.settings.*');
    $isSettingsLocations = request()->routeIs('admin.locations.*');
    $isSettingsWorkHours = request()->routeIs('admin.work-hours.*');
    $isSettings = $isSettingsGeneral || $isSettingsLocations || $isSettingsWorkHours;

    // $isAboutUs = request()->is('admin/about-us/*') || request()->is('admin/about-us');
@endphp

<aside class="side-menu">
    <a href="{{ route('admin.dashboard') }}" class="logo">
        <img src="{{ aurl('images/logo.png') }}">
    </a>
    <ul>
        <li class="{{ $isDashboard ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fa fa-tachometer-alt"></i>
                Dashboard
            </a>
        </li>

        <li class="{{ $isBanners ? 'active' : '' }}">
            <a href="{{ route('admin.banners.index') }}">
                <i class="fa fa-image"></i>
                Banners
            </a>
        </li>

        <li class="{{ $isSections ? 'active' : '' }}">
            <a href="{{ route('admin.sections.index') }}">
                <i class="fa fa-list"></i>
                Sections
            </a>
        </li>

        <li class="{{ $isSocial ? 'active' : '' }}">
            <a href="{{ route('admin.links.index') }}">
                <i class="fa fa-share-alt"></i>
                Social Media
            </a>
        </li>

        {{-- Pages Section --}}
        <li class="sub-menu {{ $isServices || $isProjects || $isSmart ? 'active' : '' }}">
            <a href="javascript:void(0);">
                <i class="fa fa-file"></i>
                Pages
                <i class="fa fa-angle-down"></i>
            </a>
            {{-- force display block for all Pages --}}
            <ul style="display: {{ $isServices || $isProjects || $isSmart ? 'block' : '' }}">
                <li class="{{ $isServices ? 'active' : '' }}">
                    <a href="{{ route('admin.services.index') }}">- Services</a>
                </li>
                <li class="{{ $isProjects ? 'active' : '' }}">
                    <a href="{{ route('admin.projects.index') }}">- Projects</a>
                </li>
            </ul>
        </li>

        {{-- Settings Section --}}
        <li class="sub-menu {{ $isSettings? 'active' : '' }}">
            <a href="javascript:void(0);">
                <i class="fa fa-cog"></i>
                Settings
                <i class="fa fa-angle-down"></i>
            </a>
            <ul style="display: {{ $isSettings? 'block' : '' }}">
                <li class="{{ $isSettingsGeneral ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.edit', ['setting' => 1]) }}">- General</a>
                </li>
                <li class="{{ $isSettingsLocations ? 'active' : '' }}">
                    <a href="{{ route('admin.locations.index') }}">- Locations</a>
                </li>
                <li class="{{ $isSettingsWorkHours ? 'active' : '' }}">
                    <a href="{{ route('admin.work-hours.index') }}">- Work Hours</a>
                </li>
                {{-- <li class="{{ $isAboutUs ? 'active' : '' }}">
                    <a href="{{ route('admin.about.index') }}">- About Us</a>
                </li> --}}
            </ul>
        </li>

        {{-- Optional FAQ --}}
        <li class="{{ $isFaq ? 'active' : '' }}">
            <a href="{{ route('admin.faqs.index') }}">
                <i class="fa fa-question-circle"></i>
                FAQ
            </a>
        </li>

    </ul>
</aside>