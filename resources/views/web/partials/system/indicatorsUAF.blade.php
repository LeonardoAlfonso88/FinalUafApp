  <div class="col-xl-12">
    <h4><b>Indicadores UAF</b></h4>
  </div>

  <div class="col-xl-8">
    <table class="tableStyle">
      <thead>
        <tr>
          <th>Indicador</th>
          <th>Valor</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @if($system->Indicators->count() > 0)
          @foreach($system->Indicators as $Indicator)
            <tr>
              <td>{{ $Indicator->nameIndicator }}</td>
              <td>{{ $Indicator->valueIndicator }}</td>
            </tr>
          @endforeach
        @endif
      </tbody>
    </table>
  </div>

  <div class="col-xl-4">

    <div class="col-xl-1"></div>
    <div class="col-xl-11">
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
  </div>