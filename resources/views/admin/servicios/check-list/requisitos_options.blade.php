<div class="row">
    @foreach($requisitos_servicio as $requisito)
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group" style="border: 1px solid rgba(220, 220, 220, 0.6); padding: 4px 4px 4px 4px">
                <span class="m-b-10">
                    <div
                        @if($requisito->categoria == 'Jurídico') class="switcher switcher-success" 
                        @elseif($requisito->categoria == 'Administración') class="switcher switcher-warning" 
                        @elseif($requisito->categoria == 'Gestión') class="switcher switcher-danger" 
                        @elseif($requisito->categoria == 'Operaciones') class="switcher switcher-primary" 
                        @endif>
                        <input type="checkbox" name="option-{{ $requisito->id }}" id="option-{{ $requisito->id }}" checked value="1" onclick="HabilitarProgreso({{ $requisito->id }},{{ $requisito->id_prog }})">
                        <label for="option-{{ $requisito->id }}"></label>

                    </div>
                    <label class="btn btn-xs m-l-5" 
                        @if($requisito->categoria == 'Jurídico') style="color: #49ADAD" 
                        @elseif($requisito->categoria == 'Administración') style="color: #F49C31"@elseif($requisito->categoria == 'Gestión') style="color: #EE5755" 
                        @elseif($requisito->categoria == 'Operaciones') style="color: #348FE2" 
                        @endif>{{ $requisito->requisito }}<a class="btn btn-link" onclick="EditarOpcion({{ $requisito->id }}, '{{ $requisito->requisito }}', '{{ $requisito->categoria }}', {{ $requisito->estatus }})"><i class="fas fa-edit"></i></a></label>
                    <input type="hidden" value="1" id="option-{{ $requisito->id }}-val">
                </span>
            </div>
        </div>
    @endforeach
</div>
<div class="row">
    @foreach($requisitos as $requisito)
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group" style="border: 1px solid rgba(220, 220, 220, 0.6); padding: 4px 4px 4px 4px">
                <span class="m-b-10">
                    @if($requisito->estatus == 1)
                        <div
                            @if($requisito->categoria == 'Jurídico') class="switcher switcher-success" 
                            @elseif($requisito->categoria == 'Administración') class="switcher switcher-warning" 
                            @elseif($requisito->categoria == 'Gestión') class="switcher switcher-danger" 
                            @elseif($requisito->categoria == 'Operaciones') class="switcher switcher-primary" 
                            @endif>
                            <input type="checkbox" name="option-{{ $requisito->id }}" id="option-{{ $requisito->id }}" unchecked value="0" onclick="HabilitarProgreso({{ $requisito->id }},0)">
                            <label for="option-{{ $requisito->id }}"></label>
                            
                            
                        </div>
                        <label class="btn btn-xs m-l-5"
                            @if($requisito->categoria == 'Jurídico') style="color: #49ADAD" 
                            @elseif($requisito->categoria == 'Administración') style="color: #F49C31"@elseif($requisito->categoria == 'Gestión') style="color: #EE5755" 
                            @elseif($requisito->categoria == 'Operaciones') style="color: #348FE2" 
                            @endif>{{ $requisito->requisito }} <a class="btn btn-link" onclick="EditarOpcion({{ $requisito->id }}, '{{ $requisito->requisito }}', '{{ $requisito->categoria }}', {{ $requisito->estatus }})"><i class="fas fa-edit"></i></a></label>
                            <input type="hidden" value="0" id="option-{{ $requisito->id }}-val">
                    @elseif($requisito->estatus == 0)
                        <div class="switcher">
                            <input type="checkbox" name="option-{{ $requisito->id }}" id="option-{{ $requisito->id }}" unchecked disabled value="0">
                            <label for="option-{{ $requisito->id }}" style="color: #bfbfbf"> {{ $requisito->requisito }} <a class="btn btn-link" onclick="EditarOpcion({{ $requisito->id }}, '{{ $requisito->requisito }}', '{{ $requisito->categoria }}', {{ $requisito->estatus }})"><i class="fas fa-edit"></i></a></label>
                            <input type="hidden" value="0" id="option-{{ $requisito->id }}-val">
                        </div>
                    @endif
                </span>
                
            </div>

        </div>
    @endforeach
</div>
