<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="side-header">
        <a class="header-brand1" href="{{ route('adminHome') }}">
            <img src="{{ $setting->logo ?? asset('assets/uploads/empty.png') }}" class="header-brand-img light-logo1"
                alt="logo">
        </a>
        <!-- LOGO -->
    </div>
    <ul class="side-menu">
        <li>
            <h3>العناصر</h3>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('adminHome') }}">
                <i class="icon icon-home side-menu__icon"></i>
                <span class="side-menu__label">الرئيسية</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('admins.index') }}">
                <i class="fe fe-users side-menu__icon"></i>
                <span class="side-menu__label">المشرفين</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('users.index') }}">
                <i class="fe fe-user-minus side-menu__icon"></i>
                <span class="side-menu__label">المستخدمين</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('invitees.index') }}">
                <i class="fe fe-user-minus side-menu__icon"></i>
                <span class="side-menu__label">جميع المدعوين</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('contact_us.index') }}">
                <i class="fe fe-message-circle side-menu__icon"></i>
                <span class="side-menu__label">تواصل معنا</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('settings.index') }}">
                <i class="fe fe-settings side-menu__icon"></i>
                <span class="side-menu__label">الاعدادات</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('admin.logout') }}">
                <i class="icon icon-lock side-menu__icon"></i>
                <span class="side-menu__label">تسجيل الخروج</span>
            </a>
        </li>

    </ul>
</aside>
