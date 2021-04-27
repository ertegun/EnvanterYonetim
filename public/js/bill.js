function NewBillToggle(bill,new_div,new_no,new_image,state) {
    if(state){
        openElement(new_no);
        new_div.removeClass('d-none');
    }
    else{
        new_div.addClass('d-none');
        closeElement(new_no);
    }
    bill.val('').trigger('change');//Değeri sıfırlayıp değişimi tetikleyince Placeholder gözüküyor
    bill.prop('disabled',state);
    new_image.prop('disabled',!state);
    new_image.val('');
}
