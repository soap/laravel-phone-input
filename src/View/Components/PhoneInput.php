<?php

namespace Soap\LaravelPhoneInput\View\Components;

use Illuminate\View\Component;

class PhoneInput extends Component
{
    public string $id;

    public ?string $error;

    public function __construct(
        public string $name = 'phone',
        public ?string $label = null,
        public ?string $value = null,  // ควรเป็น E.164
        public ?string $placeholder = 'Enter phone number',
        public bool $required = false,

        // โหมด: field | inline
        public string $mode = 'field',

        // inline options
        public bool $inlineSaveOnBlur = true,
        public bool $inlineShowActions = true, // แสดงปุ่มแก้ไข/บันทึก/ยกเลิก
        public ?string $displayFormat = 'pretty' // pretty | national | e164
    ) {
        $this->id = $this->name;
        $this->error = session('errors')?->first($this->name);
    }

    public function render()
    {
        return view('laravel-phone-input::components.phone-input');
    }
}
