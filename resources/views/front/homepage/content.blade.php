<div class="row" ng-controller="WidgetController">
    <div class="col-12 col-md-6 col-log-4 col-xl-4 my-3" ng-show="widget_ok" ng-cloak>
        <div class="card bg-danger">
            <div ng-mouseenter="WidgetMouseEnter(0)" ng-mouseleave="WidgetMouseLeave(0)" class="card-header info-widget">
                <i ng-style="widget_icon[0]" class="fas fa-hdd widget-icon"></i>
                <span class="widget-info">Donanım</span>
                <span class="widget-text">
                    <a class="widget-href" href="{{route('hardware')}}">
                        @{{result.hardware_use}}/@{{result.hardware_all}}
                    </a>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-log-4 col-xl-4 my-3" ng-show="widget_wait">
        <div class="card bg-danger">
            <div class="card-header info-widget">
                <i class="fas fa-spinner fa-spin widget-loading"></i>
                <span class="widget-info"><br><br>Yükleniyor</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-log-4 col-xl-4 my-3" ng-show="widget_ok" ng-cloak>
        <div class="card bg-info">
            <div ng-mouseenter="WidgetMouseEnter(1)" ng-mouseleave="WidgetMouseLeave(1)" class="card-header info-widget">
                <i ng-style="widget_icon[1]" class="fas fa-compact-disc widget-icon"></i>
                <span class="widget-info">Yazılım</span>
                <span class="widget-text">
                    <a class="widget-href" href="{{route('software')}}">
                        @{{result.software_use}}/@{{result.software_all}}
                    </a>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-log-4 col-xl-4 my-3" ng-show="widget_wait">
        <div class="card bg-info">
            <div class="card-header info-widget">
                <i class="fas fa-spinner fa-spin widget-loading"></i>
                <span class="widget-info"><br><br>Yükleniyor</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-log-4 col-xl-4 my-3" ng-show="widget_ok" ng-cloak>
        <div class="card bg-success">
            <div ng-mouseenter="WidgetMouseEnter(2)" ng-mouseleave="WidgetMouseLeave(2)" class="card-header info-widget">
                <i ng-style="widget_icon[2]" class="fas fa-users widget-icon"></i>
                <span class="widget-info">Kullanıcı</span>
                <span class="widget-text">
                    <a class="widget-href ml-5 pl-5" href="{{route('user')}}">
                        @{{result.user}}
                    </a>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-log-4 col-xl-4 my-3" ng-show="widget_wait">
        <div class="card bg-success">
            <div class="card-header info-widget">
                <i class="fas fa-spinner fa-spin widget-loading"></i>
                <span class="widget-info"><br><br>Yükleniyor</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-log-4 col-xl-4 my-3" ng-show="widget_ok" ng-cloak>
        <div class="card bg-dark">
            <div ng-mouseenter="WidgetMouseEnter(3)" ng-mouseleave="WidgetMouseLeave(3)" class="card-header info-widget">
                <i ng-style="widget_icon[3]" class="fas fa-tools widget-icon"></i>
                <span class="widget-info">Malzeme</span>
                <span class="widget-text">
                    <a class="widget-href ml-5 pl-5" href="{{route('material')}}">
                        @{{result.material_all}}
                    </a>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-log-4 col-xl-4 my-3" ng-show="widget_wait">
        <div class="card bg-dark">
            <div class="card-header info-widget">
                <i class="fas fa-spinner fa-spin widget-loading"></i>
                <span class="widget-info"><br><br>Yükleniyor</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-log-4 col-xl-4 my-3" ng-show="widget_ok" ng-cloak>
        <div class="card bg-purple">
            <div ng-mouseenter="WidgetMouseEnter(4)" ng-mouseleave="WidgetMouseLeave(4)" class="card-header info-widget">
                <i ng-style="widget_icon[4]" class="fas fa-handshake widget-icon"></i>
                <span class="widget-info">Ortak Kullanım</span>
                <span class="widget-text">
                    <a class="widget-href" href="{{route('common_item')}}">
                        @{{result.common_use}}/@{{result.common_all}}
                    </a>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-log-4 col-xl-4 my-3" ng-show="widget_wait">
        <div class="card bg-purple">
            <div class="card-header info-widget">
                <i class="fas fa-spinner fa-spin widget-loading"></i>
                <span class="widget-info"><br><br>Yükleniyor</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-log-4 col-xl-4 my-3" ng-show="widget_ok" ng-cloak>
        <div class="card bg-warning">
            <div ng-mouseenter="WidgetMouseEnter(5)" ng-mouseleave="WidgetMouseLeave(5)" class="card-header info-widget">
                <i ng-style="widget_icon[5]" class="fas fa-briefcase widget-icon"></i>
                <span class="widget-info">Departman</span>
                <span class="widget-text">
                    <a class="widget-href ml-5 pl-5" href="{{route('department')}}">
                        @{{result.department}}
                    </a>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-log-4 col-xl-4 my-3" ng-show="widget_wait">
        <div class="card bg-warning">
            <div class="card-header info-widget">
                <i class="fas fa-spinner fa-spin widget-loading"></i>
                <span class="widget-info"><br><br>Yükleniyor</span>
            </div>
        </div>
    </div>
</div>
<div class="row" ng-controller="HomepageTables">
    <div class="col-6 my-3">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadrumb-item text-primary"><b id="currentMonth">&nbsp;Ayı İşlem Grafiği</b></li>
                </ol>
            </nav>
            <canvas id="currentMonthTransactionChart"></canvas>
        </div>
    </div>
    <div class="col-6 my-3">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadrumb-item text-primary"><b>Son 5 Ayda Kullanılan Malzemeler</b></li>
                </ol>
            </nav>
            <canvas id="FiveMonthMaterialChart"></canvas>
        </div>
    </div>
    <div class="col-6 my-3">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadrumb-item text-primary"><b>Son Eklenen 5 Kullanıcı</b></li>
                </ol>
            </nav>
            <div class="col-12">
                <table id="lastFiveUser" class="table table-sm small table-striped table-bordered" style="width: 100%">
                <thead>
                    <th>Ad Soyad</th>
                    <th>Departman</th>
                </thead>
                <tbody ng-show="lastFiveUserInfo">
                    <tr ng-repeat="user in lastFiveUser">
                        <td>@{{user.name}}</td>
                        <td>@{{user.department}}</td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-6 my-3">
        <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadrumb-item text-primary"><b>Son 5 İşlem</b></li>
                </ol>
            </nav>
            <div class="col-12">
                <table id="lastFiveTransaction" class="table table-sm small table-striped table-bordered" style="width: 100%">
                <thead>
                    <th>Ad Soyad</th>
                    <th>Hakkında</th>
                    <th>İşlem</th>
                </thead>
                <tbody ng-show="lastFiveTransactionInfo">
                    <tr ng-repeat="trans in lastFiveTransaction" ng-class="trans.type_id%2==0 ? 'table-danger' : 'table-success'">
                        <td>@{{trans.user_name}}</td>
                        <td>@{{trans.trans_info}}
                            <span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-placement="top" title="@{{trans.trans_details}}" onmouseenter="$(this).tooltip('show')">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                </svg>
                            </span>
                        </td>
                        <td>@{{trans.type}}</td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
