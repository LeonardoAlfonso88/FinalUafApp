<div class="col-xl-12">
  <div class="col-xl-6">
      <div class="col-xl-12">

        <div class="col-xl-1"></div>
        <div class="col-xl-7">
            <h2>ZRH - {{ $currentDepartament->departamentName }}</h2>
        </div>
        <div class="col-xl-4"></div>

      </div>
  </div>
  <div class="col-xl-6">
    <div class="col-xl-12">
        <div class="col-xl-8"></div>
        <div class="col-xl-3">
          <div id="options">
            <a href="{{ route('getZone', ['idZone' => '', 'idDepartament' =>  $currentDepartament->idDepartament, 'validations' => '']) }}">
                <label id="newZone" class="standardButton">Nueva Zona</label>
            </a>
          </div>
        </div>
        <div class="col-xl-1"></div>
    </div>
  </div>
</div>

  <hr/>

  @include('app.partials.cartographer.cartographerMessages')

  <div class="col-xl-12">
    <div class="col-xl-6"></div>
    <div class="col-xl-6">
      <div class="col-xl-12">
          <div class="col-xl-6"></div>
          <div class="col-xl-5">
            <div id="map">
                <label id="addMap" class="standardButton">Añadir Mapa Departamento</label>
            </div>
          </div>
          <div class="col-xl-1"></div>
      </div>
    </div>
  </div>

  <div class="col-xl-12">
    <div class="col-xl-12">
      <table class="tableStyle">
        <thead>
          <tr>
            <th>Nombre Zona</th>
            <th>Autor</th>
            <th>Publicación</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
           @foreach($currentDepartament->zones as $zone)
            <tr>
              <td>{{ $zone->nameZone }}</td>
              <td>{{ $zone->autor }}</td>
              <td>{{ $zone->created_at }}</td>
              <td><a href="{{ route('getZone', ['idZone' => $zone->idZone, 'idDepartament' =>  $currentDepartament->idDepartament ]) }}"><img src="{{ asset('images/app/editIcon.png') }}"></a></td>
              <td><a href="{{ route('zoneDelete', ['idZone' => $zone->idZone, 'idDepartament' =>  $currentDepartament->idDepartament]) }}"><img onclick="deleteZoneConfirm()" src="{{ asset('images/app/deleteIcon.png') }}"></a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
