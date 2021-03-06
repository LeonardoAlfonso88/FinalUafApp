@extends('web.templates.webTemplate')

@section('links')

    <link rel="stylesheet" href="{{ asset('css/web/services.css') }}">
    <link rel="stylesheet" href="{{ asset('css/web/zone.css') }}">
    <script type="text/javascript">
        var routeZones = '{{ route('optionsZones', ['name' => 'parameter']) }}';
    </script>
    <script type="text/javascript" src="{{ asset('js/web/services.js') }}"></script>
@stop

@section('viewContent')

  <img id="backImage" src="{{ asset('images/web/BackImage1.jpg') }}" alt="">

      <form class="row" action="{{ route('zone') }}" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <div class="col-xl-1"></div>
        <div class="col-xl-2">
          <div class="select-style">
            <select id="optionsDepartament" class="select" name="Departament">
                @include('web.partials.services.departamentsList')
            </select>
          </div>
        </div>


        <div class="col-xl-1"></div>
        <div class="col-xl-2">
          <div class="select-style">
            <select id="optionsZone" name="Zone" class="select" onchange="this.form.submit()">
              @include('web.partials.services.zonesList')
            </select>
          </div>
        </div>
        <div class="col-xl-6"></div>
    </div>
    </form>


@stop
