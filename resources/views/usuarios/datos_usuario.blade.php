                <div class="row">
                    <div class="col-5" id="divnombreusuario">
                        <label for="nombre_usuario" class="col-form-label text-md-right">Nombre:</label>
                        <input type="text" onkeypress="return textonly(event);" id="nombre_usuario" name="nombre_usuario" class="form-control" data-target="#nombre_usuario" value="{{ $usuario->name }}" maxlength="255" required {{ $noeditar }}/>
                    </div>
                    <div class="col-5" id="divcorreoelectronico">
                        <label for="correo_electronico" class="col-form-label text-md-right">Correo electrónico:</label>
                        <input id="correo_electronico" type="email" class="form-control @error('correo_electronico') is-invalid @enderror" name="correo_electronico" value="{{ $usuario->email }}" required autocomplete="email" autofocus {{ $noeditar }}/>
                        @error('correo_electronico')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-2" id="divrol">
                        <label for="rol" class="col-form-label text-md-right">Rol:</label>
                        <select class="form-control m-bot15" id="rol" name="rol" required {{ $noeditar }}>
                            <option value="">Elija un Rol...</option>
                            @foreach($listRoles as $indice=>$crol)
                                @if($crol->iid_rol==$usuario->iid_rol)
                                    <option value="{{$crol->iid_rol}}" selected>{{$crol->cnombre_rol}}</option>
                                @else
                                    <option value="{{$crol->iid_rol}}">{{$crol->cnombre_rol}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>