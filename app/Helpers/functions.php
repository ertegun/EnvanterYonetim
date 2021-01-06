<?php
    function bgColors($index){
        $bg_colors = [
            'bg-danger text-white',
            'bg-info text-white',
            'bg-warning text-white',
            'bg-secondary',
            'bg-purple text-white',
            'bg-success text-white',
            'bg-light',
            'bg-primary',
            'bg-dark text-white'
        ];
        return $bg_colors[$index];
    }
    function getCurrentMonth($date){
        $MonthsTr = [
            1 => "Ocak",
            2 => "Şubat",
            3 => "Mart",
            4 => "Nisan",
            5 => "Mayıs",
            6 => "Haziran",
            7 => "Temmuz",
            8 => "Ağustos",
            9 => "Eylül",
            10 => "Ekim",
            11 => "Kasım",
            12 => "Aralık"
        ];
        $currentMonth = date("m",$date);
        $currentMonth = intval($currentMonth);
        $currentMonth = $MonthsTr[$currentMonth];
        return $currentMonth;
    }
    function createTurkishDate($date){
        $date                   =   strtotime($date);
        $get_day                =   date('d',$date);
        $get_year               =   date('Y',$date);
        $get_month              =   getCurrentMonth($date);
        $full_date              =   $get_day.' '.$get_month.' '.$get_year;
        return $full_date;
    }

