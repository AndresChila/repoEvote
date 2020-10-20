
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header" style="background-color: #007B3E" >
                        <a style="color: #ffffff">
                            Resultados para la votacion {{$candidatos1[1]->nombrevotacion}} 
                            
                            </a>
                        </div>
                        <div class="card-header" style="background-color: #007B3E" >
                            <a style="color: #ffffff">
                                
                                Realizada el dia {{$candidatos1[1]->fechainicio}} a las {{$candidatos1[1]->horainicio}}
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
                                            <thead>
                                                <tr>
                                                    <th>Nombre candidato</th>
                                                    <th> <a style="color: #ffffff">
                                                       ----------------------------------------
                                                    </a>< </th>
                                                    <th>votos</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $item->nombrecandidato }} {{ $item->apellidocandidato }}</td>
                                                    <td> <a style="color: #ffffff">
                                                        ----------------------------------------
                                                     </a> </td>
                                                    <td>{{ $item->votocand }}</td>
                                                </tr>
                                            </tbody>
                                            ________________________________________________________________________________________
                                            <div class="table-responsive">
                                                <table class="table">                                            
                                                    <thead>
                                                        <tr>
                                                            <th>Nombre sede</th>
                                                            <th><a style="color: #ffffff">
                                                                --------------------------------------------
                                                             </a> </th>
                                                            <th>votos</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $item->nomlugar }}</td>
                                                            <td> <a style="color: #ffffff">
                                                                ---------------------------------------------
                                                             </a></td>
                                                            <td>{{ $item->votlugar }}</td>
                                                        </tr>
                                                    </tbody>
                                                    ________________________________________________________________________________________
                                                    <div class="table-responsive">
                                                        <table class="table">                                            
                                                            <thead>
                                                                <tr>
                                                                    <th>Nombre Carrera</th>
                                                                    <th><a style="color: #ffffff">
                                                                        ----------------------------------------
                                                                     </a>
                                                                    </th>
                                                                    <th>votos</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>{{ $item->nomcarrera }}</td>
                                                                    <td><a style="color: #ffffff">
                                                                        ----------------------------------------
                                                                     </a>
                                                                    </td>
                                                                    <td>{{ $item->votcarrera }}</td>
                                                                </tr>
                                                            </tbody>
                                                            
                                                        </table>                                
                                                    </div>
                                                ________________________________________________________________________________________
                                                </table>                                
                                            </div>
                                        ________________________________________________________________________________________
                                        </table>                                
                                    </div>
                                ________________________________________________________________________________________
                                ................................................................................................................................................................................
                                
                                @endforeach

                            </main>
                        </div>
                    </div>
                </div>
            </div>
        </div>
