<?php
$menuList = \App\Services\MenuService::getMenuList();
?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
              <svg width="62" height="99" viewBox="0 0 62 99" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M5.9107 98.0909H1.34961V75.5165L28.4731 75.501V98.0909H23.8209V79.9912L5.9107 80.0557V98.0909Z"
                          fill="#3B9E9E"/>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M27.7196 70.23H23.0411V60.8012L0.596191 60.7192V37.8817L5.12426 37.861L5.2281 56.0868H23.0411L23.2104 37.8511H27.7196V70.23Z"
                          fill="#3B9E9E"/>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M34.5005 9.23706H61.6239V22.6745H48.0618V18.5369H56.9361V14.0581H39.1883V27.4955L61.6239 27.7155V32.58H34.5005V9.23706Z"
                          fill="#3B9E9E"/>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M5.13067 0.954102L0.612547 0.965565V14.6218L23.1001 14.6586L23.0535 27.8137H0.596191V32.58H27.7196L27.655 9.93897H5.1781L5.13067 0.954102Z"
                          fill="#3B9E9E"/>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M34.6023 75.5125L34.5005 98.0908H61.6239V93.6317L38.8761 93.4686L38.9205 80.0921L61.6239 80.0487V66.5066L57.0964 66.4648L57.075 75.533L34.6023 75.5125Z"
                          fill="#3B9E9E"/>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M56.8752 56.7992L39.047 56.659L39.0813 43.4576H56.8752V56.7992ZM34.5005 38.604V61.0856L61.6239 61.194V38.7116L34.5005 38.604Z"
                          fill="#FED600"/>
                    </svg>
              </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">Job Portal</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx menu-toggle-icon d-none d-xl-block fs-4 align-middle"></i>
            <i class="bx bx-x d-block d-xl-none bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-divider mt-0"></div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @foreach($menuList as $menu)
            @php
                    $activeClass = null;
                    $currentRouteName = Route::currentRouteName();

                    if ($currentRouteName === $menu['slug']) {
                        $activeClass = 'active';
                    }
                    elseif (isset($menu['submenu'])) {

                        if (gettype($menu['slug']) === 'array') {
                            foreach($menu['slug'] as $slug){
                                if (str_contains($currentRouteName,$slug) and strpos($currentRouteName,$slug) === 0) {
                                    $activeClass = 'active open';
                                }
                            }
                        }
                        else{
                            if (str_contains($currentRouteName,$menu['slug']) and strpos($currentRouteName,$menu['slug']) === 0) {
                                  $activeClass = 'active open';
                            }
                        }
                    }
            @endphp

            {{-- main menu --}}
            <li class="menu-item {{$activeClass}}">
                <a href="{{ isset($menu['url']) ? route($menu['url']) : 'javascript:void(0);' }}"
                   class="{{ isset($menu['submenu']) ? 'menu-link menu-toggle' : 'menu-link' }}"
                   @if (isset($menu['target']) and !empty($menu['target'])) @endif>
                    @isset($menu['icon'])
                        <i class="{{ $menu['icon'] }}"></i>
                    @endisset
                    <div>{{ isset($menu['name']) ? __($menu['name']) : '' }}</div>
                </a>

                {{-- submenu --}}
                @isset($menu['submenu'])
                    @include('layouts.sections.menu.submenu',['menu' => $menu['submenu']])
                @endisset
            </li>

        @endforeach

    </ul>
</aside>
