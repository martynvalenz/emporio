
<div class="row">
    <div class="col-md-12">
        <!-- The time line -->
        <ul class="timeline">
            <!-- timeline time label -->
            @foreach($comentarios as $comentario)
                <li class="time-label">
                    <span class="bg-gray" title="{{ Carbon\Carbon::parse($comentario->created_at)->format('d-m-Y') }}" data-tooltip="tooltip">
                        {{ Carbon\Carbon::parse($comentario->created_at)->diffForHumans() }}
                    </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                    <div class="timeline-item">
                        <span class="time"></span>
                        <h3 class="timeline-header"><img src="{{ asset('images/users/'.$comentario->imagen) }}" alt="{{ $comentario->nombre }} {{ $comentario->apellido }}" title="{{ $comentario->iniciales }} - {{ $comentario->nombre }} {{ $comentario->apellido }}" data-tooltip="tooltip" style="border-radius: 50%;width: 35px; height: 35px;"> {{ $comentario->iniciales }} - {{ $comentario->nombre }} {{ $comentario->apellido }}</h3>
                        <div class="timeline-body">
                            @if($comentario->id_admin == Auth::user()->id)
                                <div id="parrafo-comentarios-{{ $comentario->id }}">
                                    <p id="parrafo-comentarios-{{ $comentario->id }}-parrafo">{{ $comentario->comentario }}</p>
                                </div>
                                <div id="textarea-comentarios-{{ $comentario->id }}" hidden>
                                    <textarea id="textarea-comentario-{{ $comentario->id }}" rows="2" class="form-control">{{ $comentario->comentario }}</textarea>
                                </div>
                            @else
                                <p>{{ $comentario->comentario }}</p>
                            @endif
                        </div>
                        <div class="timeline-footer">
                            @if($comentario->id_admin == Auth::user()->id)
                                <div id="edicion-comentarios-{{ $comentario->id }}">
                                    <a class="btn btn-warning btn-xs btn-flat" onclick="EditarComentario({{ $comentario->id }})">Editar</a>
                                    <a class="btn btn-danger btn-xs btn-flat" onclick="EliminarComentario({{ $comentario->id }})">Eliminar</a>
                                </div>
                                <div id="actualizar-comentarios-{{ $comentario->id }}" hidden>
                                    <a class="btn btn-success btn-xs btn-flat" onclick="ActualizarComentario({{ $comentario->id }})">Guardar</a>
                                    <a class="btn btn-default btn-xs btn-flat" onclick="CancelarAcutalizarComentario({{ $comentario->id }})">Cancelar</a>
                                </div>
                            @else
                                
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <!-- /.col -->
</div>