                    <!--1027 OOFMTSJCDMX -->    
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="atencion2" name="atencion2">
                            @else
                                {{$check=''}}
                                @if($destinAtt_total>0)
                                    @foreach($destinAtt as $indice=>$destAt)
                                        @if($destAt->iid_adscripcion==1027)
                                            <input type="checkbox" id="atencion2" name="atencion2" checked {{$noeditar}}>
                                            {{$check=' '}}
                                        @endif
                                    @endforeach
                                @endif
                                @if($check=='')
                                    <input type="checkbox" id="atencion2" name="atencion2" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="atencion2">OOFMTSJCDMX</label>
                        </div>
                    <!--229 DEP -->
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="atencion12" name="atencion12">
                            @else
                                {{$check=''}}
                                @if($destinAtt_total>0)
                                    @foreach($destinAtt as $indice=>$destAt)
                                        @if($destAt->iid_adscripcion==229)
                                            <input type="checkbox" id="atencion12" name="atencion12" checked {{$noeditar}}>
                                            {{$check=' '}}
                                        @endif
                                    @endforeach
                                @endif
                                @if($check=='')
                                    <input type="checkbox" id="atencion12" name="atencion12" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="atencion12">DEP</label>
                        </div>
                    <!--227 DEGT -->
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="atencion14" name="atencion14">
                            @else
                                {{$check=''}}
                                @if($destinAtt_total>0)
                                    @foreach($destinAtt as $indice=>$destAt)
                                        @if($destAt->iid_adscripcion==227)
                                            <input type="checkbox" id="atencion14" name="atencion14" checked {{$noeditar}}>
                                            {{$check=' '}}
                                        @endif
                                    @endforeach
                                @endif
                                @if($check=='')
                                    <input type="checkbox" id="atencion14" name="atencion14" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="atencion14">DEGT</label>
                        </div>
                    <!--231 DERH -->
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="atencion15" name="atencion15">
                            @else
                                {{$check=''}}
                                @if($destinAtt_total>0)
                                    @foreach($destinAtt as $indice=>$destAt)
                                        @if($destAt->iid_adscripcion==231)
                                            <input type="checkbox" id="atencion15" name="atencion15" checked {{$noeditar}}>
                                            {{$check=' '}}
                                        @endif
                                    @endforeach
                                @endif
                                @if($check=='')
                                    <input type="checkbox" id="atencion15" name="atencion15" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="atencion15">DERH</label>
                        </div>
                    <!--228 DEOMS -->
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="atencion16" name="atencion16">
                            @else
                                {{$check=''}}
                                @if($destinAtt_total>0)
                                    @foreach($destinAtt as $indice=>$destAt)
                                        @if($destAt->iid_adscripcion==228)
                                            <input type="checkbox" id="atencion16" name="atencion16" checked {{$noeditar}}>
                                            {{$check=' '}}
                                        @endif
                                    @endforeach
                                @endif
                                @if($check=='')
                                    <input type="checkbox" id="atencion16" name="atencion16" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="atencion16">DEOMS</label>
                        </div>
                    <!--232 DERM -->
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="atencion17" name="atencion17">
                            @else
                                {{$check=''}}
                                @if($destinAtt_total>0)
                                    @foreach($destinAtt as $indice=>$destAt)
                                        @if($destAt->iid_adscripcion==232)
                                            <input type="checkbox" id="atencion17" name="atencion17" checked {{$noeditar}}>
                                            {{$check=' '}}
                                        @endif
                                    @endforeach
                                @endif
                                @if($check=='')
                                    <input type="checkbox" id="atencion17" name="atencion17" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="atencion17">DERM</label>
                        </div>
                    <!--230 DERF -->
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="atencion18" name="atencion18">
                            @else
                                {{$check=''}}
                                @if($destinAtt_total>0)
                                    @foreach($destinAtt as $indice=>$destAt)
                                        @if($destAt->iid_adscripcion==230)
                                            <input type="checkbox" id="atencion18" name="atencion18" checked {{$noeditar}}>
                                            {{$check=' '}}
                                        @endif
                                    @endforeach
                                @endif
                                @if($check=='')
                                    <input type="checkbox" id="atencion18" name="atencion18" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="atencion18">DERF</label>
                        </div>
                    <!--1233 OTRO -->
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="atencion999" name="atencion999" {{$noeditar}}>
                            @else
                                {{$check=''}}
                                @if($destinAtt_total>0)
                                    @foreach($destinAtt as $indice=>$destAt)
                                        @if($destAt->iid_adscripcion==1233)
                                            <input type="checkbox" id="atencion999" name="atencion999" checked {{$noeditar}}>
                                            {{$check=' '}}
                                        @endif
                                    @endforeach
                                @endif
                                @if($check=='')
                                    <input type="checkbox" id="atencion999" name="atencion999" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="atencion999">OTRO</label>
                        </div>