@extends('front.layouts.master')
@section('title',"Ana Sayfa")
@section('content')
    @include('front.homepage.content')
@endsection
@section('script')
<script>
    NgApp.controller("WidgetController",function($scope,$http){
        $scope.widget_ok = false;
        $scope.widget_wait = true;
        $http.post("{{route('homepage_widgets')}}").then(function (response) {
            $scope.result = response.data;
            $scope.widget_wait = false;
            $scope.widget_ok = true;
        });
        $scope.widget_icon = {};
        $scope.WidgetMouseEnter=function(i){
            this.widget_icon[i] = {"font-size": '160px'};
        }
        $scope.WidgetMouseLeave=function(i){
            this.widget_icon[i] = {"font-size": '110px'};
        }
    });
    NgApp.controller("HomepageTables",function($scope,$http){
        $scope.lastFiveUserInfo = false;
        $scope.lastFiveTransactionInfo = false;
        $http.post("{{route('homepage_lastFiveUser')}}").then(function(response){
            $scope.lastFiveUser =   response.data;
            $scope.lastFiveUserInfo = true;
        });
        $http.post("{{route('homepage_lastFiveTransaction')}}").then(function(response){
            $scope.lastFiveTransaction =   response.data;
            $scope.lastFiveTransactionInfo = true;
        });
    });
    $(document).ready(function(){
        $.ajax({
            type: 'POST',
            url: '{{route("homepage_currentMonthTransaction")}}',
            success: function(response){
                var currentMonth = response.currentMonth;
                var currentMonthTransaction = response.currentMonthTransaction;
                var currentMonthTransactionChart = $("#currentMonthTransactionChart")[0].getContext('2d');
                $('#currentMonth').text(currentMonth+" Ayı İşlem Grafiği");
                var Chart1 = new Chart(currentMonthTransactionChart, {
                    type: 'doughnut',
                    data: {
                    labels: ["Donanım", "Yazılım", "Malzeme", "Ortak Kullanım"],
                    datasets: [{
                        data: currentMonthTransaction,
                        backgroundColor: ["#dc3545", "#17a2b8", "#343a40", "#6c5ce7"],
                        hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#57606f", "#A8B3C5"]
                    }]
                    },
                    options: {
                    responsive: true
                    }
                });
            }
        });
        $.ajax({
            type: 'POST',
            url: '{{route("homepage_FiveMonthMaterial")}}',
            success: function(response){
                var FiveMonth = response.FiveMonth;
                var FiveMonthMaterial = response.FiveMonthMaterial;
                var FiveMonthMaterialChart = $("#FiveMonthMaterialChart")[0].getContext('2d');
                var Chart2 = new Chart(FiveMonthMaterialChart, {
                    type: 'bar',
                    data: {
                        labels: FiveMonth,
                        datasets: [{
                            label: 'İşlem Sayısı',
                            data: FiveMonthMaterial,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.3)',
                                'rgba(54, 162, 235, 0.3)',
                                'rgba(255, 206, 86, 0.3)',
                                'rgba(75, 192, 192, 0.3)',
                                'rgba(153, 102, 255, 0.3)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
        });
    })
</script>
@endsection
