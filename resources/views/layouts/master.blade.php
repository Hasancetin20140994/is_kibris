@include('layouts.header')



<div id="pagebody">
    @if(View::hasSection('content'))
    <div id="pagecontent">
        @yield('content')
    </div>
    @endif
</div>

@include('layouts.footer')
