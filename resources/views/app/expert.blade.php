@extends('app.templates.appTemplate')

@section('links')
  <link rel="stylesheet" href="{{ asset('css/app/expert.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app/modals.css') }}">
  <script type="text/javascript">
      var routeZonesList = '{{ route('zonesList', ['nameDepartament' => 'parameter']) }}';
      var routeStorageCost = '{{ route('storageCost') }}';
      var routeDeleteCost = '{{ route('costDelete', ['idCost' => 'parameter'])  }}';
      var routeSubGroup = '{{ route('getSubGroup', ['group' => 'parameter'])  }}';
      var routeStorageEntry = '{{ route('storageEntry') }}';
      var routeDeleteEntry = '{{ route('entryDelete', ['idEntry' => 'parameter'])  }}';
      var routeCalculateIndicators = '{{ route('calculateIndicators') }}';
      var routeDeleteSystem = '{{ route('systemDelete', ['idSystem' => 'parameter'])  }}';
      var routeValidateIfIndicators = '{{ route('validateIfIndicators') }}';
      var routevalidateCalculate = '{{ route('validateCalculate') }}';
      var routeCostEdit = '{{ route('costEdit', ['idCost' => 'parameter'])  }}';
      var routeEntryEdit = '{{ route('editEntry', ['idEntry' => 'parameter'])  }}';
  </script>
  <script type="text/javascript" src="{{ asset('js/app/systemApp.js') }}"></script>
@stop

  @section('menuOptions')
      <ul class="col-xl-12">
        <a href="{{ route('expert') }}"><li id="systems" class="optionsMenu">Sistemas Productivos</li></a>

        <li id="reports" class="optionsMenu">Reportes</li>
      </ul>
@stop

@section('form')
  @if($option === 'List')
    @include('app.partials.expert.listSystems')
  @elseif($option === 'configSystem')
    @include('app.partials.expert.newSystem')
  @else
    @include('app.partials.expert.listSystems')
  @endif

@stop
