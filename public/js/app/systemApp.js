$(document).ready(function(){

    $('#optionsDepartament').change(function(){

        var parent = $(this).val();
        var newRoute = routeZonesList.replace('parameter', parent);
        console.log(newRoute);

        $.ajax({
              url: newRoute,
              headers: {'X-CSRF-TOKEN':token},
              type: 'GET',
              datatype: 'json',
              success:function(data)
              {
                  var zones = data.list;
                  var table = data.table;
                  $("#optionsZones").html(zones);
                  $("#tableListSystems").html(table);
              },
              error:function(data)
              {
                  alert('mal');
              }
          });
    });

    $('#listGroup').change(function(){

        var group = $(this).val();
        var test = group.split(" ");
        var newRoute = routeSubGroup.replace('parameter',test[0]);
        console.log(newRoute);

        $.ajax({
            url: newRoute,
            headers: {'X-CSRF-TOKEN': token},
            type: 'GET',
            datatype: 'json',
            success:function(data)
            {
                var zones = data.html;

                if(group == "Mano de Obra")
                {
                    var jornalValue = $("#jornalSystem").val();
                    $('#unitaryCost').prop("readonly", true)

                    if(jornalValue.trim().length == 0)
                    {
                        $('#unitaryCost').val("Escribir un Valor de Jornal");
                    }
                    else
                    {
                        $('#unitaryCost').val(jornalValue);
                    }
                }
                else
                {
                    $('#unitaryCost').val("")
                    $('#unitaryCost').prop("readonly", false)
                }

                $("#listSubGroup").html(zones);

            },
            error:function(data)
            {
                alert('mal');
            }
        });
    });

});

function confirmDeleteSystem(){
    var deleteSystemConfirm = confirm("Está seguro de eliminar el sistema?");
    if (deleteSystemConfirm == false)
    {
        event.preventDefault();
    }  
}

function itemSystemDelete(){
    var deleteItemSystemConfirm = confirm("Está seguro de eliminar el item?");
    if (deleteItemSystemConfirm == false)
    {
        event.preventDefault();
    }  
}

function saveCost(){
    var request = $("#newCost").serializeArray();
    var token = $("#token").val();
    var inputClose = document.getElementById("CloseCostModal");
    var inputShow = document.getElementById("ShowCostModal");

    console.log(request);

    $.ajax({
        url: routeStorageCost,
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        datatype: 'json',
        data: request,
        success:function(data)
        {   
            console.log(data.test);
            var modalCost = data.modal;
            var tableCost = data.table;
            $("#costModal").html(modalCost);
            
            if(data.validation)
            {
                inputClose.checked = false;
                inputShow.checked = true;        
            }
            else
            {
                inputClose.checked = true;
                inputShow.checked = false;
                $("#BodyCostTable").html(tableCost);
            }
              
        },
        error:function(data)
        {
            alert('mal');
        }
    });
};

function deleteCost(id){

    var newRoute = routeDeleteCost.replace('parameter',id);
    console.log(newRoute);

    $.ajax({
          url: newRoute,
          headers: {'X-CSRF-TOKEN': token},
          type: 'GET',
          datatype: 'json',
          success:function(data)
          {
                var costs = data.html;
                $("#BodyCostTable").html(costs);
          },
          error:function(data)
          {
              alert('mal');
          }
      });
};

function saveEntry(){
    var request = $("#newEntry").serializeArray();
    var token = $("#token").val();
    var inputClose = document.getElementById("CloseEntryModal");
    var inputShow = document.getElementById("ShowEntryModal");
    console.log(request);

        $.ajax({
            url: routeStorageEntry,
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            datatype: 'json',
            data: request,
            success:function(data)
            {
                console.log(data.test);
                var modalEntry = data.modal;
                var tableEntry = data.table;
                $("#entryModal").html(modalEntry);
                
                if(data.validation)
                {
                    inputClose.checked = false;
                    inputShow.checked = true;        
                }
                else
                {
                    inputClose.checked = true;
                    inputShow.checked = false;
                    $("#BodyEntryTable").html(tableEntry);
                }
            },
            error:function(data)
            {
                alert('mal');
            }
        });
};

function deleteEntry(id){

    var newRoute = routeDeleteEntry.replace('parameter',id);
    console.log(newRoute);

    $.ajax({
          url: newRoute,
          headers: {'X-CSRF-TOKEN': token},
          type: 'GET',
          datatype: 'json',
          success:function(data)
          {
                var entries = data.html;
                $("#BodyEntryTable").html(entries);
          },
          error:function(data)
          {
              alert('mal');
          }
      });
};

function detectZone(idzone){

    if(idzone == null){
        alert("Elija una zona para crear un sistema");
        event.preventDefault();
    }
}

function calculateIndicators(){

    console.log(routevalidateCalculate);
    
    $.ajax({
        url: routevalidateCalculate,
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        datatype: 'json',
        async: false,
        success:function(data)
        {
            console.log(data);
            var validation = data.validation;
            if(!validation)
            {
                alert('Agregar al menos un Ingreso y un Costo');
            }
            else
            {
                sendCalculations();
            }
        },
        error:function(data)
        {
            alert('mal');
        }
    });
};

function sendCalculations()
{
    console.log(routeCalculateIndicators);

    $.ajax({
        url: routeCalculateIndicators,
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        datatype: 'json',
        success:function(data)
        {
              console.log(data);
              var indicators = data.html;
            //   var recomendations = data.recomendations;
              $("#systemIndicators").html(indicators);
            //   $('#recomendationCard').html(recomendations);
        },
        error:function(data)
        {
            alert('mal');
        }
    });
}

$('#formNewSystem').submit(function(e){
    e.preventDefault();
});

function saveSystem() {

    var nameSystem = $('#nameSystem').val();
    var authorSystem = $('#authorSystem').val();
    var jornalSystem = $('#jornalSystem').val();
    var data = {"nameSystem":nameSystem, "authorSystem":authorSystem, "jornalSystem":jornalSystem};

    $.ajax({
        url: routeValidateIfIndicators,
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        datatype: 'json',
        data: data,
        success:function(data)
        {
            console.log(data);

            var view = data.view;
            if(data.formValidation)
            {
                $('#SystemMainData').html(view);
            }
            // else if (data.errors)
            // {
            //     alert('Corregir Errores antes de salvar el sistema');
            //     $('#SystemMainData').html(view);
            // }
            else if(!data.calculateValidation)
            {
                alert('Por favor Calcular Indicadores antes de Guardar');
                $('#SystemMainData').html(view);
            }
            else
            {
                $('#formNewSystem').submit();
                console.log(data);
            }
        },
        error:function(data)
        {
            alert('mal');
        }
    });
};

function editCost(id){

    var newRoute = routeCostEdit.replace('parameter',id);
    var inputClose = document.getElementById("CloseCostModal");
    var inputShow = document.getElementById("ShowCostModal");
    console.log(newRoute);

    $.ajax({
          url: newRoute,
          headers: {'X-CSRF-TOKEN': token},
          type: 'GET',
          datatype: 'json',
          success:function(data)
          {
                console.log(data);
                var modalCost = data.modal;
                $("#costModal").html(modalCost);
                inputClose.checked = false;
                inputShow.checked = true; 
          },
          error:function(data)
          {
              alert('mal');
          }
      });
};

function editEntry(id){

    var newRoute = routeEntryEdit.replace('parameter',id);
    var inputClose = document.getElementById("CloseEntryModal");
    var inputShow = document.getElementById("ShowEntryModal");
    console.log(newRoute);

    $.ajax({
          url: newRoute,
          headers: {'X-CSRF-TOKEN': token},
          type: 'GET',
          datatype: 'json',
          success:function(data)
          {
                console.log(data);
                var modalEntry = data.modal;
                $("#entryModal").html(modalEntry);
                inputClose.checked = false;
                inputShow.checked = true; 
          },
          error:function(data)
          {
              alert('mal');
          }
      });
};
