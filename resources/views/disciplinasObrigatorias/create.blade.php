@extends('adminlte::page')

@section('title', env('APP_NAME') . ' - Currículo ' . $curriculo['id'] . ' - Disciplinas Obrigatórias')

@section('content_header')
    <h1>Curriculo {{ $curriculo['id'] }} - Adicionar Disciplinas Obrigatórias</h1>
@stop

@section('content')

    @include('flash')

    <div class="box box-primary">
        <form role="form" method="POST" action="/disciplinasObrigatorias/create/{{ $curriculo['id'] }}">
                        
            {{ csrf_field() }}   

            <div class="box-body">
                <table class="table">
                    <tr>
                        <th>Curso</th>
                        <td>{{ $curriculo['codcur'] }} - {{ Uspdev\Replicado\Graduacao::nomeCurso($curriculo['codcur']) }}</td>
                    </tr>
                    <tr>
                        <th>Habilitação</td>
                        <td>{{ $curriculo['codhab'] }} - 
                            {{ Uspdev\Replicado\Graduacao::nomeHabilitacao($curriculo['codhab'], $curriculo['codcur']) }}</td>
                    </tr>
                    <tr>
                        <th>Nº de créditos exigidos em displinas optativas eletivas</td>
                        <td>{{ $curriculo['numcredisoptelt'] }}</td>
                    </tr>
                    <tr>
                        <th>Nº de créditos exigidos em displinas optativas livres</td>
                        <td>{{ $curriculo['numcredisoptliv'] }}</td>
                    </tr>                                         
                    <tr>
                        <th>Ano de ingresso</td>
                        <td>{{ Carbon\Carbon::parse($curriculo['dtainicrl'])->format('Y') }}</td>
                    </tr>  
                </table>
             
                <table class="table table-bordered table-striped table-hover datatable">
                    <thead>
                        <tr>
                            <th><label>Diciplinas Obrigatórias</label></th>
                            <th>&nbsp;</th>
                        </tr>                     
                        <tr>
                            <th>Disciplinas</th>
                            <th>Ações</th>
                        </tr>                                          
                    </thead>                            
                    <tbody>                               
                        @foreach($disciplinasObrigatorias as $disciplinasObrigatoria)
                            <tr>
                                <td>{{ $disciplinasObrigatoria['coddis'] }} - 
                                    {{ Uspdev\Replicado\Graduacao::nomeDisciplina($disciplinasObrigatoria['coddis']) }}</td>
                                <td>                           
                                    <button type="button" class="btn btn-info btn-xs" title="Disciplinas Obrigatórias Equivalentes">
                                        <span class="glyphicon glyphicon-list-alt"></span>
                                    </button>                                
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">
                                <div class="form-group">
                                    <label>Adicionar Disciplina Obrigatória</label>
                                    <select class="form-control select2" style="width: 100%;" id="coddisobr" name="coddisobr" required>
                                        <option></option>                      
                                            @foreach ($disciplinas as $disciplina)
                                                <option value="{{ $disciplina['coddis'] }}">{{ $disciplina['coddis'] }} - {{ $disciplina['nomdis'] }}</option>
                                            @endforeach
                                    </select>
                                </div>                                 
                            </th>
                        </tr>                                          
                    </tfoot>                            
                </table>               
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                <button type="button" class="btn btn-info btn-sm" 
                    onclick='location.href="/curriculos/{{ $curriculo->id }}";' title="Ver Currículo">
                    <span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;&nbsp;Ver Currículo
                </button>
                <button type="button" class="btn btn-primary btn-sm" title="Editar" 
                    onclick="location.href='/curriculos/{{ $curriculo['id'] }}/edit';">
                    <span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;&nbsp;Editar Currículo
                </button>                   
            </div>   
        </form>
    </div>

@stop

@section('js')
    
    <script type="text/javascript">
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2({
                placeholder:    "Selecione",
                allowClear:     true
            });
            
            //Datepicker
            $('.datepicker').datepicker({
                format:         "dd/mm/yyyy",
                viewMode:       "years", 
                minViewMode:    "years",
                autoclose:      true
            });

            // DataTables
            $('.datatable').DataTable({
                language    : {
                    url     : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
                },  
                paging      : true,
                lengthChange: true,
                searching   : true,
                ordering    : true,
                info        : true,
                autoWidth   : true,
                pageLength  : 100
            });
        })
    </script>

@stop