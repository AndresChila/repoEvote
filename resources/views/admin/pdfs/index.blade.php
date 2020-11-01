
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header" style="background-color: #007B3E" >
                        <a style="color: #ffffff">
                            Resultados para la votacion {{$candidatos1[0]->nombrevotacion}} 
                           
                            </a>
                        </div>
                        <div class="card-header" style="background-color: #007B3E" >
                            <a style="color: #ffffff">
                                
                                Realizada el dia {{$candidatos1[0]->fechainicio}} a las {{$candidatos1[0]->horainicio}}
                                </a>
                            </div>
                        <div class="card-header" style="background-color: #ffd700" >
                                <a style="color: #000000">
                                    El candidato ganador fue: {{ $ganador }}
                                </a>
                        </div>
                            <main class="py-4" style=".flex-center">
                                
                                @foreach($candidatos1 as $item)
                                ................................................................................................................................................................................                                
                                ________________________________________________________________________________________
                                    <div class="table-responsive">
                                        <table class="table">                                            
                                            <tbody>
                                                <tr>
                                                    <th>Nombre candidato</th>
                                                    <td>{{ $item->nombrecandidato }} {{ $item->apellidocandidato }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Votos totales</th>
                                                    <td>{{ $item->votocand }}</td>
                                                </tr>
                                                @foreach($sedes as $segitem)
                                                    @if($item->nombrecandidato == $segitem->nombrecandidato && $item->apellidocandidato == $segitem->apellidocandidato)
                                                    <tr>
                                                        <th>_______________________________________</th>
                                                        <td>_______________________________________</td>
                                                    </tr>
                                                        <tr>
                                                            <th>Sede</th>
                                                            <td>{{$segitem->nomlugar}}</td>
                                                            <th>Votos</th>
                                                            <td>{{$segitem->votlugar}}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach    
                                                @foreach ($carreras as $teritem)
                                                    @if($item->nombrecandidato == $teritem->nombrecandidato && $item->apellidocandidato == $teritem->apellidocandidato)
                                                        <tr>
                                                            <th>_______________________________________</th>
                                                            <td>_______________________________________</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Carrera</th>
                                                            <td>{{$teritem->nomcarrera}}</td>
                                                            <th>Votos</th>
                                                            <td>{{$teritem->votcarrera}}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>                                
                                    </div>
                                    @endforeach
                                    ________________________________________________________________________________________

                            </main>
                        </div>
                    </div>
                </div>
            </div>
        </div>
