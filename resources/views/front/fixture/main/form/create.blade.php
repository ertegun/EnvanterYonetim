<form id="create" action="{{ route('fixture_create') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        {{-- Departman --}}
            <div id="c_department" class="input-group mb-3">
                <div class="input-group-prepend w-100px">
                    <span class="input-group-text w-100px justify-content-center">Departman <b class="req-star">*</b></span>
                </div>
                <select id="c_department_select" name="department_id" required>
                    <option></option>
                    <option ng-repeat="department in departments" value="@{{department.id}}" data-prefix="@{{department.prefix}}">@{{department.name}}</option>
                </select>
            </div>
        {{-- Departman --}}

        {{-- Bölüm --}}
            <div id="c_section" class="input-group mb-3 d-none">
                <div class="input-group-prepend w-100px">
                    <span class="input-group-text w-100px justify-content-center">Bölüm <b class="req-star">*</b></span>
                </div>
                <select name="section_id" id="c_section_select" required>
                    <option></option>
                </select>
            </div>
        {{-- Bölüm --}}

        {{-- Demirbaş Tipleri --}}
            <div id="c_type" class="input-group mb-3 d-none">
                <div class="input-group-prepend w-100px">
                    <button onclick="cShowType()" class="btn btn-outline-secondary w-100px" type="button">Tür <b class="req-star">*</b></button>
                </div>
                <select id="c_type_select" name="type_id" required>
                    <option></option>
                    <option ng-repeat="type in types" data-prefix="@{{type.prefix}}" value="@{{type.id}}">@{{type.name}}</option>
                </select>
                <input id="c_new_type" type="text"  placeholder="Yeni Tür" name="new_type" class="form-control" disabled style="display: none">
                <input id="c_new_type_prefix" type="text"  placeholder="Yeni Tür Ön Eki" name="new_type_prefix" class="form-control" disabled style="display: none">
                <div class="input-group-append">
                    <button onclick="cNewType()" class="btn btn-outline-secondary" type="button">Yeni</button>
                </div>
            </div>
        {{-- Demirbaş Tipleri --}}

        {{-- Markalar --}}
            <div id="c_brand" class="input-group mb-3 d-none">
                <div class="input-group-prepend w-100px">
                    <button onclick="cShowBrand()" class="btn btn-outline-secondary w-100px" type="button">Marka <b class="req-star">*</b></button>
                </div>
                <select id="c_brand_select" class="c_brand_select"  name="brand_id" required>
                    <option></option>
                    <option ng-repeat="brand in brands" value="@{{brand.id}}">@{{brand.name}}</option>
                </select>
                <input id="c_new_brand" type="text"  placeholder="Yeni Marka" name="new_brand" class="form-control" disabled style="display: none">
                <div class="input-group-append">
                    <button onclick="cNewBrand()" class="btn btn-outline-secondary" type="button">Yeni</button>
                </div>
            </div>
        {{-- Markalar --}}

        {{-- Tedarikçi --}}
            <div id="c_supplier" class="input-group mb-3 d-none">
                <div class="input-group-prepend w-100px">
                    <button onclick="cShowSupplier()" class="btn btn-outline-secondary w-100px" type="button">Tedarikçi <b class="req-star">*</b></button>
                </div>
                <select id="c_supplier_select" class="c_supplier_select"  name="supplier_id" required>
                    <option></option>
                    <option ng-repeat="supplier in suppliers" value="@{{supplier.id}}">@{{supplier.name}}</option>
                </select>
                <div class="input-group-append">
                    <button onclick="cNewSupplier()" class="btn btn-outline-secondary" type="button">Yeni</button>
                </div>
            </div>
        {{-- Tedarikçi --}}

        {{-- Yeni Tedarikçi --}}
            <div id="c_new_supplier" class="d-none">
                <div class="input-group mb-3">
                    <div class="input-group-prepend w-160px">
                        <span class="input-group-text w-160px justify-content-center">Tedarikçi Adı <b class="req-star">*</b></span>
                    </div>
                    <input id="c_new_supplier_name" type="text"  placeholder="Tedarikçi Adı" name="new_supplier_name" class="form-control" disabled>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend w-160px">
                        <span class="input-group-text w-160px justify-content-center">Tedarikçi Telefonu</span>
                    </div>
                    <input class="maskField form-control" name="new_supplier_telephone" id="c_new_supplier_telephone" placeholder="Tedarikçi Telefon(Varsa)" disabled>
                </div>
            </div>
        {{-- Yeni Tedarikçi --}}

        {{-- Statü --}}
            <div id="c_status" class="input-group mb-3 d-none">
                <div class="input-group-prepend w-100px">
                    <span class="input-group-text w-100px justify-content-center">Statü <b class="req-star">*</b></span>
                </div>
                <select id="c_status_select" class="c_status_select"  name="status_id" required>
                    <option></option>
                    <option ng-repeat="status in statuses" value="@{{status.id}}">@{{status.name}}</option>
                </select>
            </div>
        {{-- Statü --}}

        {{-- Detaylar --}}
            <div id="c_other" class="d-none">

                {{-- Ürün Adı --}}
                    <div class="input-group mb-3">
                        <div class="input-group-prepend w-100px">
                            <span class="input-group-text w-100px justify-content-center">Ürün Adı <b class="req-star">*</b></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Ürün Adı Giriniz"  name="name" required>
                    </div>
                {{-- Ürün Adı --}}

                {{-- Tutar/Adet --}}
                    <div class="row p-0">
                        <div class="input-group mb-3 col-12 col-md-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Adet <b class="req-star">*</b></span>
                            </div>
                            <input type="number" class="form-control" value="1" min="1" max="99" name="count" required>
                        </div>
                        <div class="input-group mb-3 col-12 col-md-8">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Tutar <b class="req-star">*</b></span>
                            </div>
                            <input type="number" class="form-control" value="0" min="0"  name="price" required>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-lira-sign"></i></span>
                                <button onclick="cExchangeToggle()" class="btn btn-outline-secondary" type="button">Döviz</button>
                            </div>
                        </div>
                    </div>
                {{-- Tutar/Adet --}}

                {{-- Döviz --}}
                    <div id="c_exchange" class="row p-0 d-none">
                        <div class="input-group mb-3 col-12 col-md-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Döviz Tipi <b class="req-star">*</b></span>
                            </div>
                            <select id="c_exhange_select" name="exchange_id" disabled>
                                <option></option>
                                <option ng-repeat="exchange in exchanges" value="@{{exchange.id}}" data-icon="@{{exchange.icon}}">@{{exchange.name}}</option>
                            </select>
                        </div>
                        <div class="input-group mb-3 col-12 col-md-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Döviz Tutarı <b class="req-star">*</b></span>
                            </div>
                            <input type="number" class="form-control" min="1" id="c_exchange_rate" name="exchange_rate" disabled>
                            <div class="input-group-append">
                                <span class="input-group-text"><i id="c_exchange_icon"></i></span>
                            </div>
                        </div>
                    </div>
                {{-- Döviz --}}

                {{-- Barkod No --}}
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Barkod No <b class="req-star">*</b></span>
                            <span id="c_barcode_number_prepend" class="input-group-text"></span>
                        </div>
                        <input id="c_barcode_number_append" class="form-control" placeholder="Barkod No Giriniz" oninput="cBarcodeCheck()"  name="barcode_number" required>
                    </div>
                {{-- Barkod No --}}

                {{-- Seri No --}}
                    <div class="input-group mb-3">
                        <div class="input-group-prepend w-100px">
                            <span class="input-group-text w-100px justify-content-center">Seri No</span>
                        </div>
                        <input class="form-control"  name="serial_number" placeholder="Örn: SN:012345 (Varsa)">
                    </div>
                {{-- Seri No --}}

                {{-- Ömür/Garanti --}}
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend w-100px">
                                    <span class="input-group-text w-100px justify-content-center">Garanti(Yıl) <b class="req-star">*</b></span>
                                </div>
                                <input type="number" value="2" min="1" max="10" class="form-control"  name="warranty" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend w-100px">
                                    <span class="input-group-text w-100px justify-content-center">Ömür(Yıl) <b class="req-star">*</b></span>
                                </div>
                                <input type="number" value="2" min="1" max="10" class="form-control" name="duration" required>
                            </div>
                        </div>
                    </div>
                {{-- Ömür/Garanti --}}

                {{-- Resim --}}
                    <label for="c_image_input">Resim</label>
                    <div class="form-group mb-3">
                        <input type="file" id="c_image_input" name="image" accept="image/*">
                    </div>
                {{-- Resim --}}

                {{-- Açıklama --}}
                    <label for="c_explanation">Açıklama</label>
                    <div class="input-group mb-3">
                        <textarea rows="5" maxlength="255" placeholder="Max 255 Karakter" class="form-control" id="c_explanation" name="explanation" style="resize: none;"></textarea>
                    </div>
                {{-- Açıklama --}}

                {{-- Detay --}}
                    <label for="c_detail">Detay</label>
                    <div class="input-group mb-3">
                        <textarea rows="5" maxlength="255" placeholder="Max 255 Karakter" class="form-control" id="c_detail" name="detail" style="resize: none;"></textarea>
                    </div>
                {{-- Detay --}}

                {{-- Fatura --}}
                    <div id="c_bill" class="input-group mb-3">
                        <div class="input-group-prepend w-100px">
                            <button onclick="cShowBill()" class="btn btn-outline-secondary w-100px" type="button">Fatura</button>
                        </div>
                        <select id="c_bill_select" class="c_bill_select"  name="bill_id" required>
                            <option></option>
                            <option ng-repeat="bill in bills" value="@{{bill.id}}">No: @{{bill.no}}</option>
                        </select>
                        <div class="input-group-append">
                            <button onclick="cNewBill()" class="btn btn-outline-secondary" type="button">Yeni</button>
                        </div>
                    </div>
                    <div id="c_new_bill" class="d-none">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend w-100px">
                                <span class="input-group-text w-100px justify-content-center">Fatura No <b class="req-star">*</b></span>
                            </div>
                            <input class="form-control" id="c_bill_no"  name="bill_no" placeholder="Fatura No Giriniz" disabled>
                        </div>
                        <label for="c_bill_image">Fatura Ek</label>
                        <div class="form-group mb-3">
                            <input type="file" id="c_bill_image" name="bill_image" accept="image/*,.pdf">
                        </div>
                    </div>
                {{-- Fatura --}}

            </div>
        {{-- Detaylar --}}

        <div id="c_errors" class="row d-none">
            <div class="col-11 col-md-9 col-lg-7 mx-auto">
                <div class="card bg-danger text-white">
                    <div class="card-header">
                        <i class="fas fa-exclamation-triangle"></i> Hatalar
                    </div>
                    <div class="card-body">
                        <div class="c_type_name_message d-none"><small><i class="fas fa-exclamation"></i> Tür Adı Kullanılıyor!</small></div>
                        <div class="c_type_prefix_message d-none"><small><i class="fas fa-exclamation"></i> Tür Ön Eki Kullanılıyor!</small></div>
                        <div class="c_brand_message d-none"><small><i class="fas fa-exclamation"></i> Marka Adı Kullanılıyor!</small></div>
                        <div class="c_supplier_name_message d-none"><small><i class="fas fa-exclamation"></i> Tedarikçi Adı Kullanılıyor!</small></div>
                        <div class="c_supplier_telephone_message d-none"><small><i class="fas fa-exclamation"></i> Tedarikçi Telefonu Kullanılıyor!</small></div>
                        <div class="c_barcode_message d-none"><small><i class="fas fa-exclamation"></i> Barkod No Kullanılıyor!</small></div>
                        <div class="c_bill_message d-none"><small><i class="fas fa-exclamation"></i> Fatura No Kullanılıyor!</small></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button id="c_submit_button" class="btn btn-success" type="submit" disable>Ekle</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Geri Dön</button>
    </div>
</form>
