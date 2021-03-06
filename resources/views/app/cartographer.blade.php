@extends('app.templates.appTemplate')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/app/cartographer.css') }}">
    <script type="text/javascript">
        var routeSaveMunicipality = '{{ route('saveMunicipality', ['' => 'parameter']) }}';
        var routedeleteMunicipality = '{{ route('deleteMunicipality', ['' => 'parameter']) }}';
        var routeShowVillages = '{{ route('showVillages', ['idMunicipality' => 'parameter']) }}';
        var routeSaveVillage = '{{ route('saveVillage', ['nameMunicipality' => 'parameter']) }}';
        var routeDeleteVillage = '{{ route('deleteVillage', ['nameMunicipality' => 'parameter']) }}';
    </script>
    <script type="text/javascript" src="{{ asset('js/app/municipality.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app/cartographer.js') }}"></script>
@stop

@section('menuOptions')
    <ul class="col-xl-12">
      <li class="optionsMenu">Departamentos
        <ul id="SubMenu">
          @foreach($departaments as $departament)
            <a href="{{ route('listZones',['idDepartament' => $departament->idDepartament]) }}">
              <li class="subMenuItem">{{ $departament->departamentName }}</li>
            </a>
          @endforeach
        </ul>
      </li>
    </ul>
@stop

@section('form')
  @if($option === 'listZones')
      @include('app.partials.cartographer.listZones')
  @elseif($option === 'configZone')
      @include('app.partials.cartographer.configZone')
  @elseif($option === 'Municipalities')
      @include('app.partials.cartographer.newMunicipality')
  @else

  @endif
@stop
