<div class="nav-i d-flex shadow bg-dark">
    <nav class="stroke d-flex justify-content-between">
        <div class="logo-f align-self-center">
            <img width="160" src="{{ asset('img/logo.png') }} " alt="Play Sro">
        </div>
        <i class="menuClick fas fa-undo"></i>
        <ul class="header-f nav-m float-left">
            <li class="nav-item @if(request()->routeIs('home'))active @endif">
                <a href="{{ route('home') }}">{{ __('Home') }}</a>
            </li>
            <li class="nav-item @if(request()->routeIs('login')
            || request()->routeIs('register') || request()->routeIs('change-pass')
            || request()->routeIs('change-phone') || request()->routeIs('change-email')
            || request()->routeIs('stuck-char')
            )active @endif">
                <a href="{{ route('login') }}">{{ __('Account') }}</a>
            </li>
             <li class="nav-item @if(request()->routeIs('rank'))active @endif">
                <a href="{{ route('rank') }}">{{ __('Ranking') }}</a>
            </li>
            <li class="nav-item @if(request()->routeIs('card'))active @endif">
                <a href="{{ route('card') }}">{{ __('Card') }}</a>
            </li>
            <li class="nav-item @if(request()->routeIs('download'))active @endif">
                <a href="{{ route('download') }}">{{ __('Download') }}</a>
            </li>
            <li class="nav-item">
                <a target="_blank" href="{{ @$configs['facebook'] }}">{{ __('Facebook') }}</a>
            </li>
            <li class="nav-item toggle-t @if(request()->routeIs('sup-member'))active @endif">
                <a href="javascript:void(0);">{{ __('Support_member') }}</a>
                @if(count($getSupMem) > 0)
                    <ul class='dropdown'>
                        @foreach($getSupMem as $val)
                            <li class="@if(route('sup-member',[$val->code]) && $val->code == request()->route()->id)active @else @endif">
                                <a href='{{ route('sup-member', [$val->code]) }}'>{{ ucfirst($val->title) }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
            @if(Auth::user() && (Auth::user()->sec_primary == 1 && Auth::user()->sec_content == 1))
             <li class="nav-item">
                <a href="{{ route('admin-cp') }}">{{ __('Admin') }}</a>
            </li>
            @endif
        </ul>
        <div class="lang-f align-self-center">
            <div class="drop-down">
              <div class="selected">
                <a><span>
                    @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                    {{ 'English' }}
                    @elseif(\Illuminate\Support\Facades\App::getLocale() == 'vi')
                    {{ 'Vietname' }}
                    @endif
                </span></a>
              </div>
              <div class="options">
                <ul>
                  <li><a class="@if(\Illuminate\Support\Facades\App::getLocale() == 'en')op_active @endif" href="{{ route('getLang', ['en']) }}">English</a></li>
                  <li><a class="@if(\Illuminate\Support\Facades\App::getLocale() == 'vi')op_active @endif" href="{{ route('getLang', ['vi']) }}">Vietname</a></li>
                </ul>
              </div>
            </div>
        </div>
    </nav>
</div>