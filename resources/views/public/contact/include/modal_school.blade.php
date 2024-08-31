<div class="modal fade" id="modalSchool" tabindex="-1" aria-labelledby="modalSchoolLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSchoolLabel">Dành cho nhà trường (For School)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <x-form id="form-contact-3" :action="route('contact.store')" :validate="true" type="post"
                    enctype="multipart/form-data">
                    <x-input type="hidden" name="form_type" value="2" />
                    <x-input type="hidden" name="school_other" value="0" />
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0 bg-light" id="name"
                                    name="name" placeholder="Họ và tên (Name)">
                                <label for="name">Họ và tên (Name)</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0 bg-light" id="phone_school"
                                    name="phone" placeholder="Số điện thoại (Phone)">
                                <label for="phone">Số điện thoại (Phone)</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0 bg-light" id="address_school"
                                    name="address" placeholder="Địa chỉ trường học">
                                <label for="address">Địa chỉ trường học</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-cyan" type="submit">Gửi
                                (Submit)</button>
                        </div>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
</div>
