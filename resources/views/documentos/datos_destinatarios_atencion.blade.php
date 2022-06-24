                    <!--2 OOFMTSJCDMX -->    
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="atencion2" name="atencion2">
                            @else
                                {{$check=''}}
                                @foreach($destinAtt as $indice=>$destAt)
                                    @if($destinAtt_total>0 && $destAt->iid_adscripcion==2)
                                        <input type="checkbox" id="atencion2" name="atencion2" checked {{$noeditar}}>
                                        {{$check=' '}}
                                    @endif
                                @endforeach
                                @if($check=='')
                                    <input type="checkbox" id="atencion2" name="atencion2" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="atencion2">OOFMTSJCDMX</label>
                        </div>
                    <!--12 DEP -->
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="atencion12" name="atencion12">
                            @else
                                {{$check=''}}
                                @foreach($destinAtt as $indice=>$destAt)
                                    @if($destinAtt_total>0 && $destAt->iid_adscripcion==12)
                                        <input type="checkbox" id="atencion12" name="atencion12" checked {{$noeditar}}>
                                        {{$check=' '}}
                                    @endif
                                @endforeach
                                @if($check=='')
                                    <input type="checkbox" id="atencion12" name="atencion12" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="atencion12">DEP</label>
                        </div>
                    <!--14 DEGT -->
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="atencion14" name="atencion14">
                            @else
                                {{$check=''}}
                                @foreach($destinAtt as $indice=>$destAt)
                                    @if($destinAtt_total>0 && $destAt->iid_adscripcion==14)
                                        <input type="checkbox" id="atencion14" name="atencion14" checked {{$noeditar}}>
                                        {{$check=' '}}
                                    @endif
                                @endforeach
                                @if($check=='')
                                    <input type="checkbox" id="atencion14" name="atencion14" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="atencion14">DEGT</label>
                        </div>
                    <!--15 DERH -->
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="atencion15" name="atencion15">
                            @else
                                {{$check=''}}
                                @foreach($destinAtt as $indice=>$destAt)
                                    @if($destinAtt_total>0 && $destAt->iid_adscripcion==15)
                                        <input type="checkbox" id="atencion15" name="atencion15" checked {{$noeditar}}>
                                        {{$check=' '}}
                                    @endif
                                @endforeach
                                @if($check=='')
                                    <input type="checkbox" id="atencion15" name="atencion15" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="atencion15">DERH</label>
                        </div>
                    <!--16 DEOMS -->
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="atencion16" name="atencion16">
                            @else
                                {{$check=''}}
                                @foreach($destinAtt as $indice=>$destAt)
                                    @if($destinAtt_total>0 && $destAt->iid_adscripcion==16)
                                        <input type="checkbox" id="atencion16" name="atencion16" checked {{$noeditar}}>
                                        {{$check=' '}}
                                    @endif
                                @endforeach
                                @if($check=='')
                                    <input type="checkbox" id="atencion16" name="atencion16" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="atencion16">DEOMS</label>
                        </div>
                    <!--17 DERM -->
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="atencion17" name="atencion17">
                            @else
                                {{$check=''}}
                                @foreach($destinAtt as $indice=>$destAt)
                                    @if($destinAtt_total>0 && $destAt->iid_adscripcion==17)
                                        <input type="checkbox" id="atencion17" name="atencion17" checked {{$noeditar}}>
                                        {{$check=' '}}
                                    @endif
                                @endforeach
                                @if($check=='')
                                    <input type="checkbox" id="atencion17" name="atencion17" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="atencion17">DERM</label>
                        </div>
                    <!--18 DERF -->
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="atencion18" name="atencion18">
                            @else
                                {{$check=''}}
                                @foreach($destinAtt as $indice=>$destAt)
                                    @if($destinAtt_total>0 && $destAt->iid_adscripcion==18)
                                        <input type="checkbox" id="atencion18" name="atencion18" checked {{$noeditar}}>
                                        {{$check=' '}}
                                    @endif
                                @endforeach
                                @if($check=='')
                                    <input type="checkbox" id="atencion18" name="atencion18" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="atencion18">DERF</label>
                        </div>
                    <!--999 OTRO -->
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="atencion999" name="atencion999" {{$noeditar}}>
                            @else
                                {{$check=''}}
                                @foreach($destinAtt as $indice=>$destAt)
                                    @if($destinAtt_total>0 && $destAt->iid_adscripcion==999)
                                        <input type="checkbox" id="atencion999" name="atencion999" checked {{$noeditar}}>
                                        {{$check=' '}}
                                    @endif
                                @endforeach
                                @if($check=='')
                                    <input type="checkbox" id="atencion999" name="atencion999" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="atencion999">OTRO</label>
                        </div>