@foreach($comentarios as $comentario)
    <li>

        <div class="timeline-body">
            <div class="timeline-header">
                <span class="userimage"><img src="{{ asset('images/users/'.$comentario->imagen) }}" alt="" /></span>
                <span class="username">{{ $comentario->iniciales }} - {{ $comentario->nombre }} {{ $comentario->apellido }}</span>
                <span class="pull-right" title="{{ Carbon\Carbon::parse($comentario->created_at)->format('d-m-Y') }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($comentario->created_at)->diffForHumans() }}</span>
            </div>
            <div class="timeline-content">
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
                @if($comentario->id_admin == Auth::user()->id)
                    
                    <div id="edicion-comentarios-{{ $comentario->id }}">
                        <a class="btn btn-warning btn-xs btn-flat" onclick="EditarComentario({{ $comentario->id }})">Editar</a>
                        <a class="btn btn-danger btn-xs btn-flat" onclick="EliminarComentario({{ $comentario->id }})">Eliminar</a>
                    </div>
                    <div id="actualizar-comentarios-{{ $comentario->id }}" hidden>
                        <hr>
                        <a class="btn btn-success btn-xs btn-flat" onclick="ActualizarComentario({{ $comentario->id }})">Guardar</a>
                        <a class="btn btn-default btn-xs btn-flat" onclick="CancelarAcutalizarComentario({{ $comentario->id }})">Cancelar</a>
                    </div>
                    
                @else
                    
                @endif
            </div>
            
            
                
        </div>
    </li>
    <br>
@endforeach