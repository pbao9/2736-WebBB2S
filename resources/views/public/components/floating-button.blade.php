<div id="button-contact-vr">

    <div id="gom-all-in-one">
        <!-- Phone -->
        <div id="phone-vr" class="button-contact d-md-block d-none">
            <div class="phone-vr">
                <div class="phone-vr-circle-fill"></div>
                <div class="phone-vr-img-circle">
                    <x-link :href="route('form.findcar')" class="text-decoration-none">
                        <img alt="Findcar" src="{{ asset('public/assets/images/car-svgrepo-com.svg') }}">
                    </x-link>
                </div>
            </div>
        </div>
        <div class="phone-bar phone-bar phone-bar-n d-md-block d-none">
            <x-link :href="route('form.findcar')" class="text-decoration-none">
                <span class="text-phone">Tìm xe</span>
            </x-link>
        </div>
        <!-- end phone 2 -->
        <!-- Phone -->
        <div id="phone-vr2" class="button-contact">
            <div class="phone-vr">
                <div class="phone-vr-circle-fill"></div>
                <div class="phone-vr-img-circle">
                    <a href="tel:{{ $settings['hotline'] }}">
                        <img alt="Phone" src="{{ asset('public/assets/images/phone.png') }}">
                    </a>
                </div>
            </div>
            <div class="phone-bar phone-bar2 phone-bar-n">
                <a href="tel:{{ $settings['hotline'] }}" class="text-decoration-none">
                    <span class="text-phone">{{ $settings['hotline'] }}</span>
                </a>
            </div>
        </div>
       
        <!-- end phone -->

        <!-- Phone -->
        <div id="phone-vr2" class="button-contact">
            <div class="phone-vr">
                <div class="phone-vr-circle-fill"></div>
                <div class="phone-vr-img-circle">
                    <a href="tel:{{ $settings['hotline-1'] }}">
                        <img alt="Phone" src="{{ asset('public/assets/images/phone.png') }}">
                    </a>
                </div>
            </div>
            <div class="phone-bar phone-bar2 phone-bar-n">
                <a href="tel:{{ $settings['hotline-1'] }}" class="text-decoration-none">
                    <span class="text-phone">{{ $settings['hotline-1'] }}</span>
                </a>
            </div>
        </div>
        <!-- end phone 2 -->
    </div>
</div>
