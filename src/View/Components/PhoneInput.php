<?php

namespace Soap\LaravelPhoneInput\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PhoneInput extends Component
{
    public string $id;

    public ?string $error;

    /**
     * Create a new component instance.
     *
     * @param  string  $name  The input field name
     * @param  string|null  $label  The field label (field mode only)
     * @param  string|null  $value  Initial value in E.164 format
     * @param  string|null  $placeholder  Input placeholder text
     * @param  bool  $required  Whether field is required
     * @param  string  $mode  Component mode: 'field' or 'inline'
     * @param  bool  $inlineSaveOnBlur  Auto-save on blur in inline mode
     * @param  bool  $inlineShowActions  Show edit/save/cancel buttons
     * @param  string|null  $displayFormat  Display format: 'pretty', 'national', or 'e164'
     */
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

    /**
     * Render the component.
     */
    public function render(): View
    {
        // @phpstan-ignore-next-line
        return view('laravel-phone-input::components.phone-input');
    }
}
