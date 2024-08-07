<div class="modal fade" id="modalParent" tabindex="-1" aria-labelledby="modalParentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalParentLabel">Dành cho phụ huynh (For Parents)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <x-form id="form-contact-2" action="{{ route('contact.store') }}" :validate="true" type="POST"
                    enctype="multipart/form-data">
                    <x-input type="hidden" name="form_type" value="1" />
                    <x-input type="hidden" name="school_other" value="0" />
                    <div class="row g-3">
                        <div class="col-md-6 col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0 bg-light" id="name"
                                    placeholder="Họ và tên (Name)" name="name">
                                <label for="name">Họ và tên (Name)</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0 bg-light" id="phone"
                                    placeholder="Số điện thoại (Phone)" name="phone">
                                <label for="phone">Số điện thoại (Phone)</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0 bg-light" id="schools"
                                    placeholder="Tên trường (Schools)" name="school_name">
                                <label for="schools">Tên trường (School)</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0 bg-light" id="school_address"
                                    placeholder="Địa chỉ trườnh học (Schools Address)" name="school_address">
                                <label for="school_address">Địa chỉ trường học (Schools
                                    Address)</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0 bg-light" id="address" name="address"
                                    placeholder="Địa chỉ nơi ở hiện tại (Address)">
                                <label for="address">Địa chỉ nơi ở hiện tại (Address)</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-cyan float-end" type="submit">Gửi (Submit)</button>
                        </div>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
</div>
