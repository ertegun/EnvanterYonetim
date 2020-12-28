<div class="row">
    <div class="col-12 col-sm-10 col-md-8 col-log-5 col-xl-5 my-3 mx-auto">
        <div class="accordion" id="departments">
            <div class="card text-white bg-warning">
                <div class="card-header" id="total_department">
                    <div class="text-center mt-2 top-write">Toplam Donanım</div>
                    <div class="text-center mt-5 mb-4">
                        <a type="button" data-toggle="collapse" href="#department_count" aria-expanded="false" aria-controls="department_count" style="text-decoration: none;">
                            <div class="mid-write">{{count($hardware)}}</div>
                        </a>
                    </div>
                </div>
                <div id="department_count" class="collapse" aria-labelledby="total_department" data-parent="#departments">
                    <div class="card-body">
                        <div class="scrollable">
                            @foreach ($types as $write)
                                <div class="row my-3 mx-1">
                                    <div class="col-8 text-left bot-write1">{{$write->name}}</div>
                                    <div class="col-4 text-right bot-write1">{{$write->count}}</div>
                                </div>
                                <div class="row my-3 wire-warning"></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-10 col-md-8 col-log-5 col-xl-5 my-3 mx-auto">
        <div class="accordion" id="users">
            <div class="card text-white bg-success">
                <div class="card-header" id="total_user">
                    <div class="text-center mt-2 top-write">Toplam Yazılım</div>
                    <div class="text-center mt-5 mb-4">
                        <a type="button" data-toggle="collapse" href="#user_count" aria-expanded="false" aria-controls="user_count" style="text-decoration: none;">
                            <div class="mid-write">{{count($software)}}</div>
                        </a>
                    </div>
                </div>
                <div id="user_count" class="collapse" aria-labelledby="total_user" data-parent="#users">
                    <div class="card-body">
                        <div class="scrollable">
                                <div class="row my-3">
                                    <div class="col-8 text-left bot-write2">Süresiz</div>
                                    <div class="col-4 text-right bot-write3">{{$software->perma_count}}</div>
                                </div>
                                <div class="row my-3 wire-success"></div>
                                <div class="row my-3">
                                    <div class="col-8 text-left bot-write2">Süreli</div>
                                    <div class="col-4 text-right bot-write3">{{$software->normal_count}}</div>
                                </div>
                                <div class="row my-3 wire-success"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-10 col-md-8 col-log-5 col-xl-5 my-3 mx-auto">
        <div class="accordion" id="items">
            <div class="card text-white bg-warning">
                <div class="card-header" id="total_items">
                    <div class="text-center mt-2 top-write">Kullanılabilir Donanım</div>
                    <div class="text-center mt-5 mb-4">
                        <a type="button" data-toggle="collapse" href="#item_count" aria-expanded="false" aria-controls="item_count" style="text-decoration: none;">
                            <div class="mid-write">{{$useable_hard}}</div>
                        </a>
                    </div>
                </div>
                <div id="item_count" class="collapse" aria-labelledby="total_items" data-parent="#items">
                    <div class="card-body">
                        <div class="scrollable">
                            @foreach ($types as $write)
                                @if($write->useable_count!=0)
                                    <div class="row my-3 mx-1">
                                        <div class="col-8 text-left bot-write1">{{$write->name}}</div>
                                        <div class="col-4 text-right bot-write1">{{$write->useable_count}}</div>
                                    </div>
                                    <div class="row my-3 wire-warning"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-10 col-md-8 col-log-5 col-xl-5 my-3 mx-auto">
        <div class="accordion" id="useable_items">
            <div class="card text-white bg-success">
                <div class="card-header" id="total_useable">
                    <div class="text-center mt-2 top-write1">Kullanılabilir Yazılım</div>
                    <div class="text-center mt-5 mb-4">
                        <a type="button" data-toggle="collapse" href="#useable_count" aria-expanded="false" aria-controls="useable_count" style="text-decoration: none;">
                            <div class="mid-write">{{count($useable_soft)}}</div>
                        </a>
                    </div>
                </div>
                <div id="useable_count" class="collapse" aria-labelledby="total_useable" data-parent="#useable_items">
                    <div class="card-body">
                        <div class="scrollable">
                            <div class="row my-3">
                                <div class="col-8 text-left bot-write2">Süresiz</div>
                                <div class="col-4 text-right bot-write3">{{$useable_soft->perma}}</div>
                            </div>
                            <div class="row my-3 wire-success"></div>
                            <div class="row my-3">
                                <div class="col-8 text-left bot-write2">Süreli</div>
                                <div class="col-4 text-right bot-write3">{{$useable_soft->normal}}</div>
                            </div>
                            <div class="row my-3 wire-success"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
