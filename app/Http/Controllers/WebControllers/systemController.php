<?php

namespace App\Http\Controllers\WebControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Zone;
use App\Models\System;
use App\Models\Entry;
use App\Models\Cost;

class systemController extends Controller
{
      public function getListSystem($idZone)
      {
          $zone = Zone::find($idZone);

          $systems = $zone->Systems()->get();
          $first = $zone->Systems()->first();

          $departament = $zone->Departament()->first();

          $requestCrumb = Request::create(
                  '', 'GET', array(
                      'Departament' => $departament->departamentName,
                      'Zone' => $zone->nameZone,
                      'ListSystem' => $zone->idZone
                  ));

          $elements = $this->showCrumb($requestCrumb);

          return view('web.listProductiveSystems')
                      ->with('elements',$elements)
                      ->with('first',$first)
                      ->with('systems',$systems)
                      ->with('nameZone', $zone->nameZone);
      }

      public function changeSystem(Request $request, $idSystem)
      {
          $first = System::find($idSystem);

          if($request->ajax())
          {
              $view = view('web.partials.listSystems.graphicSystem')
                          ->with('first',$first);
              $newView = $view->render();
              return response()->json(['html'=>$newView]);
          }
      }

      public function getSystem($idSystem)
      {
          if(is_numeric($idSystem))
          {
              $system = System::find($idSystem);
              $products = Entry::with('Characteristics')->where('idSystem',$idSystem)->get();
          }
          else
          {
              $system = System::where('nameSystem',$idSystem)->first();
              $products = Entry::with('Characteristics')->where('idSystem',$system->idSystem)->get();
          }

          $zone = $system->Zone()->first();
          $departament = $zone->Departament()->first();

          $requestCrumb = Request::create(
                  '', 'GET', array(
                      'Departament' => $departament->departamentName,
                      'Zone' => $zone->nameZone,
                      'ListSystem' => $zone->idZone,
                      'System' => $system->nameSystem,
                  ));

          $elements = $this->showCrumb($requestCrumb);

          return view ('web.system')
                      ->with('elements',$elements)
                      ->with('system',$system)
                      ->with('products',$products)
                      ->with('idZone',$zone->idZone);
      }

      public function getCharacteristicsEntry(Request $request, $idSystem)
      {
            $entries = Entry::where([
                          ['idSystem','=',$idSystem],
                          ['period','=','1'],
              ])->get();

            if($request->ajax())
            {
                $view = view('web.partials.system.charactetisticsList')
                            ->with('entries',$entries);
                $newView = $view->render();
                return response()->json(['html'=>$newView]);
                // return response()->json(["mensaje"=>"Hola"]);
            }
      }

      public function getCosts(Request $request, $idSystem)
      {
            $costs = Cost::where([
                          ['idSystem','=',$idSystem],
                          ['period','=','0'],
              ])->get();
            // $costs = Cost::where('idSystem',$idSystem)->get();
            $totalCost = $costs->sum('total');

            if($request->ajax())
            {
                $view = view('web.partials.system.initialCosts')
                            ->with('costs',$costs)
                            ->with('totalCost',$totalCost);
                $newView = $view->render();
                return response()->json(['html'=>$newView]);
                // return response()->json(["mensaje"=>"Hola"]);
            }

      }

      public function getIndicators(Request $request, $idSystem)
      {
            $system = System::with('Indicators')->where('idSystem',$idSystem)->first();

            if($request->ajax())
            {
                $view = view('web.partials.system.indicatorsUAF')
                            ->with('system',$system);
                $newView = $view->render();
                return response()->json(['html'=>$newView]);
                // return response()->json(["mensaje"=>"Hola"]);
            }

      }


}
