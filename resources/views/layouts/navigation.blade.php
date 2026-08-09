<nav x-data="{ open: false }" class="admin-nav">
    <div class="admin-shell admin-nav__inner">
        <a class="admin-brand" href="{{ url('/') }}"><img src="{{ asset('storage/seedup-logo.png') }}" alt="SeedUP"><span>SeedUP<small>керування</small></span></a>
        <div class="admin-nav__links" :class="{ 'is-open': open }">
            <a class="{{ request()->routeIs('dashboard') ? 'is-active' : '' }}" href="{{ route('dashboard') }}"><i class="fa-solid fa-chart-pie"></i>Панель</a>
            <a class="{{ request()->routeIs('categories.*') ? 'is-active' : '' }}" href="{{ route('categories.index') }}"><i class="fa-solid fa-layer-group"></i>Категорії</a>
            <a class="{{ request()->routeIs('products.*') ? 'is-active' : '' }}" href="{{ route('products.index') }}"><i class="fa-solid fa-box-open"></i>Продукти</a>
            <a class="{{ request()->routeIs('partners.*') ? 'is-active' : '' }}" href="{{ route('partners.index') }}"><i class="fa-solid fa-handshake"></i>Партнери</a>
            <a href="{{ url('/') }}"><i class="fa-solid fa-arrow-up-right-from-square"></i>На сайт</a>
            <div class="admin-nav__mobile-account">
                @auth
                    <a href="{{ route('profile.edit') }}"><i class="fa-solid fa-user-gear"></i>Профіль</a>
                    <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit"><i class="fa-solid fa-arrow-right-from-bracket"></i>Вийти</button></form>
                @else
                    <a href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket"></i>Увійти</a>
                @endauth
            </div>
        </div>
        <div class="admin-account">
            @auth
                <a href="{{ route('profile.edit') }}"><span>{{ strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}</span><div>{{ Auth::user()->name }}<small>{{ Auth::user()->email }}</small></div></a>
            @else
                <a href="{{ route('login') }}"><span><i class="fa-solid fa-user"></i></span><div>Гість<small>Увійти</small></div></a>
            @endauth
        </div>
        <button class="admin-menu-toggle" type="button" @click="open = !open" :aria-expanded="open.toString()" aria-label="Відкрити меню"><i class="fa-solid" :class="open ? 'fa-xmark' : 'fa-bars'"></i></button>
    </div>
</nav>
