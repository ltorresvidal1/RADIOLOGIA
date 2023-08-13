<div>
                    
<div class="row">

    <div class="col-xl-3 mb-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <div class="flex-grow-1">
                        <h5 class="mb-1">Asignar citas</h5>
                        <div class="fs-13px">Diligenciar todos los datos</div>
                    </div>
                </div>
                <!--
                    <div class="row">
                        <div class="d-flex align-items-center">     
                            <div class="input-group input-daterange" id="datepicker">
                                <input type="text" class="form-control" name="start" placeholder="fecha inicio">
                                <span class="input-group-text">A</span>
                                <input type="text" class="form-control" name="end" placeholder="fecha fin">
                            </div>
                         </div>
                    </div>
                    <br> --->
                    <div class="row">
                        <div class="d-flex align-items-center">     
                            <div class="form-group row mb-2">
                                <label for="documento" class="col-sm-4 col-form-label">Documento</label>
                                <div class="col-sm-8">
                                <input type="documento" class="form-control" id="documento">
                                </div>
                            </div>
                         </div>
                    </div>
                    <div class="row">	
                        <div class="form-group col-12 m-0">
                            <label class="form-label" for="sede">Sedes</label>
                            <select class="form-select  @error('sede') is-invalid @enderror" id="sede" name="sede"  wire:model="sede" >
                                <option value="0">Seleccionar</option>
                                @foreach ($sedes as $sede)
                                <option value="{{$sede->id}}">{{$sede->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">	
                        <div class="form-group col-12 m-0">
                            <label class="form-label" for="sala">Salas</label>
                            <select class="form-select  @error('sala') is-invalid @enderror" id="sala" name="sala"  wire:model="sala" >
                                @if($salas->count() ==0 )
                                <option value="">selecionar una sede</option>
                                @endif
                                @foreach ($salas as $sala)
                                <option value="{{$sala->id}}">{{$sala->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
    
    <div class="col-xl-9 mb-3">
        <div class="card h-100">
            <div class="card-body" wire:ignore>
                    <div class="calendar">
                        <div class="calendar-body">
                         <div id="calendar"></div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
</div>
                                

</div>



<!-- modal -->
<div id="fsModal"
     class="modal animated bounceIn"
     tabindex="-1"
     role="dialog"
     aria-labelledby="myModalLabel"
     aria-hidden="true">

  <!-- dialog -->
  <div class="modal-dialog">

    <!-- content -->
    <div class="modal-content">

      <!-- header -->
      <div class="modal-header">
        <h1 id="myModalLabel"
            class="modal-title">
          Modal title
        </h1>
      </div>
      <!-- header -->
      
      <!-- body -->
      <div class="modal-body">
        <h2>1. Modal sub-title</h2>

        <p>Liquor ipsum dolor sit amet bearded lady, grog murphy's bourbon lancer. Kamikaze vodka gimlet; old rip van winkle, lemon drop martell salty dog tom collins smoky martini ben nevis man o'war. Strathmill grand marnier sea breeze b & b mickey slim. Cactus jack aberlour seven and seven, beefeater early times beefeater kalimotxo royal arrival jack rose. Cutty sark scots whisky b & b harper's finlandia agent orange pink lady three wise men gin fizz murphy's. Chartreuse french 75 brandy daisy widow's cork 7 crown ketel one captain morgan fleischmann's, hayride, edradour godfather. Long island iced tea choking hazard black bison, greyhound harvey wallbanger, "gibbon kir royale salty dog tonic and tequila."</p>

        <h2>2. Modal sub-title</h2>

        <p>The last word drumguish irish flag, hurricane, brandy manhattan. Lemon drop, pulteney fleischmann's seven and seven irish flag pisco sour metaxas, hayride, bellini. French 75 wolfram christian brothers, calvert painkiller, horse's neck old bushmill's gin pahit. Monte alban glendullan, edradour redline cherry herring anisette godmother, irish flag polish martini glen spey. Abhainn dearg bloody mary amaretto sour, ti punch black cossack port charlotte tequila slammer? Rum swizzle glen keith j & b sake bomb harrogate nights 7 crown! Hairy virgin tomatin lord calvert godmother wolfschmitt brass monkey aberfeldy caribou lou. Macuá, french 75 three wise men.</p>

        <h2>3. Modal sub-title</h2>

        <p>Pisco sour daiquiri lejon bruichladdich mickey slim sea breeze wolfram kensington court special: pink lady white lady or delilah. Pisco sour glen spey, courvoisier j & b metaxas glenlivet tormore chupacabra, sambuca lorraine knockdhu gin and tonic margarita schenley's." Bumbo glen ord the macallan balvenie lemon split presbyterian old rip van winkle paradise gin sling. Myers black bison metaxa caridan linkwood three wise men blue hawaii wine cooler?" Talisker moonwalk cosmopolitan wolfram zurracapote glen garioch patron saketini brandy alexander, singapore sling polmos krakow golden dream. Glenglassaugh usher's wolfram mojito ramos gin fizz; cactus jack. Mai-tai leite de onça bengal; crown royal absolut allt-á-bhainne jungle juice bacardi benrinnes, bladnoch. Cointreau four horsemen aultmore, "the amarosa cocktail vodka gimlet ardbeg southern comfort salmiakki koskenkorva."</p>

      </div>
      <!-- body -->

      <!-- footer -->
      <div class="modal-footer">
        <button class="btn btn-secondary"
                data-dismiss="modal">
          close
        </button>
        <button class="btn btn-default">
          Default
        </button>
        <button class="btn btn-primary">
          Primary
        </button>
      </div>
      <!-- footer -->

    </div>
    <!-- content -->

  </div>
  <!-- dialog -->

</div>
<!-- modal -->
<script>

window.addEventListener('buscaragenda', () => {
    var  idcliente=@this.get('idcliente');
    var  idsede=@this.get('sede');
    var  idsala=@this.get('sala');

   
    if(idcliente!==null && idsede!==null && idsala!==null){
        handleRenderFullcalendar();
    }

	//

 // @this.set('idventana',ventana);
/*
    var  matches= document.querySelectorAll('a.nav-link.active');
    let ventana=matches[0].hash;
   
*/
})


  
      
var handleRenderFullcalendar = function() {

    
    
    var d = new Date();
	var month = d.getMonth() + 1;
	month = (month < 10) ? '0' + month : month;
	var year = d.getFullYear();
	var day = d.getDate();
	var calendarElm = document.getElementById('calendar');
	var calendar = new FullCalendar.Calendar(calendarElm, {
        locale:'es',
        initialView: 'timeGridFourDay',
        slotDuration: '00:10:00',
        slotLabelInterval:   10,
        headerToolbar: {
        left: '',
        center: 'title',
        right: 'prev,next'
        //right: 'custom2,prev,next'
      },
      views: {
        
        timeGridFourDay: {
          type: 'timeGrid',
          allDaySlot:false,
          displayEventTime:false,
          duration: { days: 10 },
        }
      },
 
        slotLabelFormat:     [{
            hour: '2-digit',
            minute: '2-digit',
            }],

        themeSystem: 'bootstrap',
/*
        eventDidMount: function(info) {
    
            $(info.el).tooltip({ 
              title: info.event.extendedProps.description,
              //placement: "top",
            // trigger: "hover",
            //  container: "body"
            });
          }, 
  
*/
      eventClick: function(info) {
        var estado=   info.event.title;
     
   
    if(estado=="Turno disponible"){
    alert('Event: ' + info.event.title);
    }
   // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
   // alert('View: ' + info.view.type);
$('#fsModal').modal('show'); // abrir
  },

      loading: function(isLoading) {
                    if (!isLoading) {
                        this.getEvents().forEach(function(e){
                            if (e.source === null) {
                                e.remove();
                            }
                        });
                    }
                },
                   
                events: function(fetchInfo, successCallback, failureCallback) {
            
                    @this.getEvents().then(results => {
                        successCallback(results);
                    });
                },
            
       
    

        
	});
	
	calendar.render();
    
};

  /*   eventRender: function (event, element) {       

//if(event.rendering=='background'){
    $('.fc-day[data-date="' +'luis' + '"]').html('&nbsp;<span style="float:left">' +'hola'+ '</span>');
//}
},
       
        //navLinks: true,
        //editable: true,
        //droppable: false,
        
        //dayMaxEvents: true, 
        //dayMaxEvents: 2, */
        /*buttonText: {
            today:    'Today',
            month:    'Mes',
            week:     'Semana',
            day:      'Dia'
        },
        headerToolbar: {
        left: 'dayGridMonth,timeGridWeek,timeGridDay',
        center: 'title',
        right: 'prev,next today'
        },*/





</script>

<script>
/*
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
  
      var calendar = new FullCalendar.Calendar(calendarEl, {
        defaultView: "dayGridMonth",

     plugins: ["dayGrid"],
   
    defaultDate: "2019-06-12",

    eventRender: function(info) {
      $(info.el).tooltip({ 
        title: info.event.extendedProps.description,
        placement: "top",
        trigger: "hover",
        container: "body"
      });
    },
        events: [
          {
            title: 'All Day Event',
            description: 'description for All Day Event',
            start: '2023-07-01'
          },
          {
            title: 'Long Event',
            description: 'description for Long Event',
            start: '2023-07-07',
            end: '2023-07-10'
          },
          {
            groupId: '999',
            title: 'Repeating Event',
            description: 'description for Repeating Event',
            start: '2023-07-09T16:00:00'
          },
          {
            groupId: '999',
            title: 'Repeating Event',
            description: 'description for Repeating Event',
            start: '2023-07-16T16:00:00'
          },
          {
            title: 'Conference',
            description: 'description for Conference',
            start: '2023-07-11',
            end: '2023-07-13'
          },
          {
            title: 'Meeting',
            description: 'description for Meeting',
            start: '2023-07-12T10:30:00',
            end: '2023-07-12T12:30:00'
          },
          {
            title: 'Lunch',
            description: 'description for Lunch',
            start: '2023-07-12T12:00:00'
          },
          {
            title: 'Meeting',
            description: 'description for Meeting',
            start: '2023-07-12T14:30:00'
          },
          {
            title: 'Birthday Party',
            description: 'description for Birthday Party',
            start: '2023-07-13T07:00:00'
          },
          {
            title: 'Click for Google',
            description: 'description for Click for Google',
            url: 'https://google.com/',
            start: '2023-07-28'
          }
        ]
      });
  
      calendar.render();
    });
    */
  
  </script>