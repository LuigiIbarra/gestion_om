                    <div class="col-4" id="divAtencionDA">
                        @if($nuevo_registro==1)
                            <input type="checkbox" id="atencion_da" name="atencion_da" {{$noeditar}}>
                        @else
                            {{$check=''}}
                            @if($destinAtt_total>0)
                                @foreach($destinAtt as $indice=>$destAt)
                                    @if($destAt->iid_adscripcion==1354)
                                        <input type="checkbox" id="atencion_da" name="atencion_da" checked {{$noeditar}}>
                                        {{$check=' '}}
                                    @endif
                                @endforeach
                            @endif
                            @if($check=='')
                                <input type="checkbox" id="atencion_da" name="atencion_da" {{$noeditar}}>
                            @endif
                        @endif
                        <label for="atencion_da" class="col-form-label text-md-right">DIRECTOR ADMINISTRATIVO</label>
                    </div>
                    <div class="col-4" id="divAtencionDERH">
                        @if($nuevo_registro==1)
                            <input type="checkbox" id="atencion_derh" name="atencion_derh" {{$noeditar}}>
                        @else
                            {{$check=''}}
                            @if($destinAtt_total>0)
                                @foreach($destinAtt as $indice=>$destAt)
                                    @if($destAt->iid_adscripcion==231)
                                        <input type="checkbox" id="atencion_derh" name="atencion_derh" checked {{$noeditar}}>
                                        {{$check=' '}}
                                    @endif
                                @endforeach
                            @endif
                            @if($check=='')
                                <input type="checkbox" id="atencion_derh" name="atencion_derh" {{$noeditar}}>
                            @endif
                        @endif
                        <label for="atencion_derh" class="col-form-label text-md-right">DIRECTOR EJECUTIVO DE RECURSOS HUMANOS</label>
                    </div>