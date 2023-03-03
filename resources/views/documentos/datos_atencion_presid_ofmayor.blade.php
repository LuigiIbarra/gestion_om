                    <div class="col-4" id="divAtencionPresidente">
                        @if($nuevo_registro==1)
                            <input type="checkbox" id="atencion_presidente" name="atencion_presidente" {{$noeditar}}>
                        @else
                            {{$check=''}}
                            @if($destinAtt_total>0)
                                @foreach($destinAtt as $indice=>$destAt)
                                    @if($destAt->iid_adscripcion==1031)
                                        <input type="checkbox" id="atencion_presidente" name="atencion_presidente" checked {{$noeditar}}>
                                        {{$check=' '}}
                                    @endif
                                @endforeach
                            @endif
                            @if($check=='')
                                <input type="checkbox" id="atencion_presidente" name="atencion_presidente" {{$noeditar}}>
                            @endif
                        @endif
                        <label for="atencion_presidente" class="col-form-label text-md-right">PRESIDENTE</label>
                    </div>
                    <div class="col-4" id="divAtencionOficialMayor">
                        @if($nuevo_registro==1)
                            <input type="checkbox" id="atencion_oficialmayor" name="atencion_oficialmayor" {{$noeditar}}>
                        @else
                            {{$check=''}}
                            @if($destinAtt_total>0)
                                @foreach($destinAtt as $indice=>$destAt)
                                    @if($destAt->iid_adscripcion==1027)
                                        <input type="checkbox" id="atencion_oficialmayor" name="atencion_oficialmayor" checked {{$noeditar}}>
                                        {{$check=' '}}
                                    @endif
                                @endforeach
                            @endif
                            @if($check=='')
                                <input type="checkbox" id="atencion_oficialmayor" name="atencion_oficialmayor" {{$noeditar}}>
                            @endif
                        @endif
                        <label for="atencion_oficialmayor" class="col-form-label text-md-right">OFICIAL MAYOR</label>
                    </div>