<aside class="side-menu">
    <a href="{{ route('admin.dashboard') }}" class="logo">
        <img src="{{ aurl('images/logo.png') }}">
    </a>
    <ul>
        <li class="{{ request()->is('admin') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fa fa-tachometer-alt"></i>
                Dashboard
            </a>
        </li>
        <li class="{{ request()->is('admin/social-media') || request()->is('admin/social-media/*') ? 'active' : '' }}">
            <a href="{{ route('admin.links.index') }}">
                <i class="fa fa-share-alt"></i>
                Social Media
            </a>
        </li>
        <li class="sub-menu">
            <a rel="noreferrer" href="javascript:void(0);">
                <i class="fa fa-home"></i>
                Home page
                <i class="fa fa-angle-down"></i>
            </a>
            <ul style="display : {{ request()->is('admin/home/*') ? 'block' : '' }}">
                <li
                    class="{{ request()->is('admin/home/content') || request()->is('admin/home/content/*') ? 'active' : '' }}">
                    {{-- <a href="{{ route('admin.banner.index') }}">
                        - Static data
                    </a> --}}
                </li>
                <li
                    class="{{ request()->is('admin/home/features') || request()->is('admin/home/features/*') ? 'active' : '' }}">
                    {{-- <a href="{{ route('admin.features.index') }}">
                        - Features
                    </a> --}}
                </li>
                <li
                    class="{{ request()->is('admin/home/services') || request()->is('admin/home/services/*') ? 'active' : '' }}">
                    {{-- <a href="{{ route('admin.services.index') }}">
                        - Services
                    </a> --}}
                </li>
            </ul>
        </li>
        <li class="sub-menu">
            <a rel="noreferrer" href="javascript:void(0);">
                <i class="fa fa-info"></i>
                About us page
                <i class="fa fa-angle-down"></i>
            </a>
            <ul
                style="display : {{ request()->is('admin/about-us/*') || request()->is('admin/about-us/*/edit') ? 'block' : '' }}">
                <li
                    class="{{ request()->is('admin/about-us') || request()->is('admin/about-us/*/edit') ? 'active' : '' }}">
                    {{-- <a href="{{ route('admin.about.index') }}">
                        - Content
                    </a> --}}
                </li>
                <li
                    class="{{ request()->is('admin/about-us/members') || request()->is('admin/about-us/members/*') ? 'active' : '' }}">
                    {{-- <a href="{{ route('admin.members.index') }}">
                        - Members
                    </a> --}}
                </li>
            </ul>
        </li>
        <li class="{{ request()->is('admin/portfolio/') || request()->is('admin/portfolio/*') ? 'active' : '' }}">
            {{-- <a href="{{ route('admin.projects.index') }}">
                <i class="fa fa-image"></i>
                Portfolio 
            </a>--}}
        </li>
        <li
            class="sub-menu {{ request()->is('admin/messages/*') || request()->is('admin/messages') ? 'active' : '' }}">
            <a rel="noreferrer" href="javascript:void(0);">
                <i class="fa fa-inbox"></i>
                Messages
                <i class="fa fa-angle-down"></i>
            </a>
            <ul>
                <li
                    class="{{ request()->is('admin/messages/contact-us') || request()->is('admin/messages/contact-us/*') ? 'active' : '' }}">
                    {{-- <a href="{{ route('admin.contact.index') }}">
                        - Contact Us
                    </a> --}}
                </li>
                <li
                    class="{{ request()->is('admin/messages/service-request') || request()->is('admin/messages/service-request/*') ? 'active' : '' }}">
                    {{-- <a href="{{ route('admin.service.index') }}">
                        - Service Request
                    </a> --}}
                </li>
            </ul>
        </li>
    </ul><!--End Ul-->
</aside>
