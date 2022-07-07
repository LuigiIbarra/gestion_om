                    <!--2 OOFMTSJCDMX -->    
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="conoc2" name="conoc2">
                            @else
                                {{$check=''}}
                                @if($destinCon_total>0)
                                    @foreach($destinCon as $indice=>$destCn)
                                        @if($destCn->iid_adscripcion==2)
                                            <input type="checkbox" id="conoc2" name="conoc2" checked {{$noeditar}}>
                                            {{$check=' '}}
                                        @endif
                                    @endforeach
                                @endif
                                @if($check=='')
                                    <input type="checkbox" id="conoc2" name="conoc2" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="conoc2">OOFMTSJCDMX</label>
                        </div>
                    <!--12 DEP -->
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="conoc12" name="conoc12">
                            @else
                                {{$check=''}}
                                @if($destinCon_total>0)
                                    @foreach($destinCon as $indice=>$destCn)
                                        @if($destCn->iid_adscripcion==12)
                                            <input type="checkbox" id="conoc12" name="conoc12" checked {{$noeditar}}>
                                            {{$check=' '}}
                                        @endif
                                    @endforeach
                                @endif
                                @if($check=='')
                                    <input type="checkbox" id="conoc12" name="conoc12" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="conoc12">DEP</label>
                        </div>
                    <!--14 DEGT -->
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="conoc14" name="conoc14">
                            @else
                                {{$check=''}}
                                @if($destinCon_total>0)
                                    @foreach($destinCon as $indice=>$destCn)
                                        @if($destCn->iid_adscripcion==14)
                                            <input type="checkbox" id="conoc14" name="conoc14" checked {{$noeditar}}>
                                            {{$check=' '}}
                                        @endif
                                    @endforeach
                                @endif
                                @if($check=='')
                                    <input type="checkbox" id="conoc14" name="conoc14" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="conoc14">DEGT</label>
                        </div>
                    <!--15 DERH -->
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="conoc15" name="conoc15">
                            @else
                                {{$check=''}}
                                @if($destinCon_total>0)
                                    @foreach($destinCon as $indice=>$destCn)
                                        @if($destCn->iid_adscripcion==15)
                                            <input type="checkbox" id="conoc15" name="conoc15" checked {{$noeditar}}>
                                            {{$check=' '}}
                                        @endif
                                    @endforeach
                                @endif
                                @if($check=='')
                                    <input type="checkbox" id="conoc15" name="conoc15" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="conoc15">DERH</label>
                        </div>
                    <!--16 DEOMS -->
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="conoc16" name="conoc16">
                            @else
                                {{$check=''}}
                                @if($destinCon_total>0)
                                    @foreach($destinCon as $indice=>$destCn)
                                        @if($destCn->iid_adscripcion==16)
                                            <input type="checkbox" id="conoc16" name="conoc16" checked {{$noeditar}}>
                                            {{$check=' '}}
                                        @endif
                                    @endforeach
                                @endif
                                @if($check=='')
                                    <input type="checkbox" id="conoc16" name="conoc16" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="conoc16">DEOMS</label>
                        </div>
                    <!--17 DERM -->
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="conoc17" name="conoc17">
                            @else
                                {{$check=''}}
                                @if($destinCon_total>0)
                                    @foreach($destinCon as $indice=>$destCn)
                                        @if($destCn->iid_adscripcion==17)
                                            <input type="checkbox" id="conoc17" name="conoc17" checked {{$noeditar}}>
                                            {{$check=' '}}
                                        @endif
                                    @endforeach
                                @endif
                                @if($check=='')
                                    <input type="checkbox" id="conoc17" name="conoc17" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="conoc17">DERM</label>
                        </div>
                    <!--18 DERF -->
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="conoc18" name="conoc18">
                            @else
                                {{$check=''}}
                                @if($destinCon_total>0)
                                    @foreach($destinCon as $indice=>$destCn)
                                        @if($destCn->iid_adscripcion==18)
                                            <input type="checkbox" id="conoc18" name="conoc18" checked {{$noeditar}}>
                                            {{$check=' '}}
                                        @endif
                                    @endforeach
                                @endif
                                @if($check=='')
                                    <input type="checkbox" id="conoc18" name="conoc18" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="conoc18">DERF</label>
                        </div>
                    <!--999 OTRO -->
                        <div class="col">
                            @if($nuevo_registro==1)
                                <input type="checkbox" id="conoc999" name="conoc999" {{$noeditar}}>
                            @else
                                {{$check=''}}
                                @if($destinCon_total>0)
                                    @foreach($destinCon as $indice=>$destCn)
                                        @if($destCn->iid_adscripcion==999)
                                            <input type="checkbox" id="conoc999" name="conoc999" checked {{$noeditar}}>
                                            {{$check=' '}}
                                        @endif
                                    @endforeach
                                @endif
                                @if($check=='')
                                    <input type="checkbox" id="conoc999" name="conoc999" {{$noeditar}}>
                                @endif
                            @endif
                            <label for="conoc999">OTRO</label>
                        </div>