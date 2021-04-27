function ellipsis(item) {
    var html = '';
    if(item){
        if(item.length >20){
            html+='<span class="d-inline-block" tabindex="-1" data-toggle="tooltip" data-html="true" data-placement="bottom" title="'
            +item+'">'+item.slice(0,18)+'<i class="fas fa-ellipsis-h" style="vertical-align: bottom;"></i></span>';

        }
        else{
            html += item;
        }
    }
    else{
        html +="Belirtilmemiş";
    }
    return html;
}
