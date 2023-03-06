                    <div class="row">
                        <div class="col-3" id="divbuscarnombrecc">
                            <label for="destinatario_cc" class="col-form-label text-md-right">Buscar Nombre:</label>
                            <input type="text" onkeypress="return textonly(event);" id="destinatario_cc" name="destinatario_cc" class="form-control" value="" maxlength="50" required {{ $noeditar }}/>
                        </div>
                        <div class="col-3" id="divnombre">
                            <label for="nombre_destinatariocc" class="col-form-label text-md-right">Nombre:</label>
                            <select class="form-control m-bot15" id="nombre_destinatariocc" name="nombre_destinatariocc" required {{ $noeditar }}>
                                <option value="0">Escriba un Nombre de Destinatario...</option>
                            </select>
                        </div>
                        <div class="col-3" id="divpuesto">
                            <label for="puesto_conocimiento" class="col-form-label text-md-right">Puesto:</label>
                            <select class="form-control m-bot15" id="puesto_conocimiento" name="puesto_conocimiento" {{ $noeditar }}>
                                <option value="">Escriba un Nombre de Destinatario...</option>
                            </select>
                        </div>
                        <div class="col-3" id="divarea">
                            <label for="area_conocimiento" class="col-form-label text-md-right">Adscripción:</label>
                            <select class="form-control m-bot15" id="area_conocimiento" name="area_conocimiento" {{ $noeditar }}>
                                <option value="">Escriba un Nombre de Destinatario...</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <center><div id="validaPersonalDest"></div></center>
                    <br>