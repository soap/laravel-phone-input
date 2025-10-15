@props([
    // intl-tel-input
    'initialCountry' => config('phone-input.initial_country'),
    'preferredCountries' => config('phone-input.preferred_countries'),
    'separateDialCode' => config('phone-input.separate_dial_code'),
    'nationalMode' => config('phone-input.national_mode'),

    // classes
    'wrapperClass' => config('phone-input.classes.wrapper'),
    'labelClass'   => config('phone-input.classes.label'),
    'inputClass'   => config('phone-input.classes.input'),
    'helpClass'    => config('phone-input.classes.help'),
    'errorClass'   => config('phone-input.classes.error'),

    // extras
    'help' => null,
])

@php
    $inputId  = $id . '_vis';
    $hiddenId = $id . '_hid';
    $textId   = $id . '_text';
    $helpId   = $id . '_help';
    $errId    = $id . '_err';
@endphp

<div
    {{ $attributes->merge(['class' => $wrapperClass]) }}
    x-data="xPhoneField({
        mode: @js($mode), // 'field' | 'inline'
        hiddenId: '{{ $hiddenId }}',
        visibleId: '{{ $inputId }}',
        textId: '{{ $textId }}',
        name: '{{ $name }}',
        initialCountry: @js($initialCountry),
        preferredCountries: @js($preferredCountries),
        separateDialCode: @js($separateDialCode),
        nationalMode: @js($nationalMode),
        initialValue: @js($value),
        displayFormat: @js($displayFormat), // pretty|national|e164
        inlineSaveOnBlur: @js($inlineSaveOnBlur),
    })"
    x-init="init()"
>
    {{-- FIELD MODE: label/help/error --}}
    @if($mode === 'field' && $label)
        <label for="{{ $inputId }}" class="{{ $labelClass }}">
            {{ $label }} @if($required)<span class="text-red-600">*</span>@endif
        </label>
    @endif

    {{-- WRAPPER --}}
    <div class="relative">
        {{-- INLINE MODE: display text + actions --}}
        <template x-if="isInline && !editing">
            <div class="flex items-center gap-2">
                <span :id="'{{ $textId }}'" class="min-h-[2.25rem] py-1">
                    <span x-text="displayText || '—'"></span>
                </span>
                @if($inlineShowActions)
                <button type="button" class="text-sm underline" @click="startEdit()">
                    แก้ไข
                </button>
                @endif
                {{-- custom slot inline-actions --}}
                {{ $inlineActions ?? '' }}
            </div>
        </template>

        {{-- INPUT (ใช้ทั้ง field mode และ inline editing) --}}
        <template x-if="!isInline || editing">
            <div class="relative">
                <input
                    id="{{ $inputId }}"
                    type="tel"
                    inputmode="tel"
                    placeholder="{{ $placeholder }}"
                    x-ref="visible"
                    class="{{ $inputClass }} @if($error) border-red-500 @endif pr-24"
                    @input="onInput()"
                    @blur="onBlur()"
                    :aria-invalid="hasError ? 'true' : 'false'"
                    aria-describedby="{{ $help ? $helpId : '' }} {{ $error ? $errId : '' }}"
                />
                <input id="{{ $hiddenId }}" type="hidden" name="{{ $name }}" value="{{ $value ?? '' }}" />

                {{-- inline actions (save/cancel) --}}
                <template x-if="isInline">
                    <div class="absolute inset-y-0 right-2 flex items-center gap-1">
                        <button type="button" class="text-sm px-2 py-1 rounded border" @click="saveInline()">
                            บันทึก
                        </button>
                        <button type="button" class="text-sm px-2 py-1 rounded border" @click="cancelInline()">
                            ยกเลิก
                        </button>
                    </div>
                </template>
            </div>
        </template>
    </div>

    {{-- FIELD MODE: help/error --}}
    @if($mode === 'field')
        @if($help)
            <p id="{{ $helpId }}" class="{{ $helpClass }}">{{ $help }}</p>
        @endif
        @if($error)
            <p id="{{ $errId }}" class="{{ $errorClass }}">{{ $error }}</p>
        @endif
    @endif
</div>

@once
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('xPhoneField', (opts) => ({
                iti: null,
                touched: false,
                valid: false,
                hasError: false,
                isInline: opts.mode === 'inline',
                editing: opts.mode === 'field' ? true : false,
                displayText: '',     // สิ่งที่ใช้โชว์ใน inline (pretty/national/e164)
                originalE164: opts.initialValue || '',

                init() {
                    const input = this.$refs.visible ?? document.getElementById(opts.visibleId);
                    if (!input) return;

                    this.iti = window.intlTelInput(input, {
                        utilsScript: window.__INTL_TEL_INPUT_UTILS__,
                        initialCountry: opts.initialCountry,
                        preferredCountries: opts.preferredCountries || [],
                        separateDialCode: !!opts.separateDialCode,
                        nationalMode: !!opts.nationalMode,
                        formatOnDisplay: true,
                        autoPlaceholder: 'polite',
                    });

                    // preload
                    if (opts.initialValue) {
                        try {
                            this.iti.setNumber(opts.initialValue);
                            this.syncHidden();
                            this.updateDisplayText();
                        } catch(_) {}
                    } else {
                        this.updateDisplayText();
                    }

                    input.addEventListener('countrychange', () => {
                        this.onInput(true);
                    });
                },

                getE164() {
                    return (this.iti && this.iti.isValidNumber())
                        ? this.iti.getNumber()
                        : '';
                },

                // สร้างข้อความโชว์ inline ตาม displayFormat
                updateDisplayText() {
                    const e164 = document.getElementById(opts.hiddenId)?.value || '';
                    if (!e164) { this.displayText = ''; return; }

                    // ใช้ ITI ช่วย format หากมีค่า
                    try {
                        if (opts.displayFormat === 'e164') {
                            this.displayText = e164;
                        } else if (opts.displayFormat === 'national') {
                            this.displayText = this.iti.getNumber(intlTelInputUtils.numberFormat.NATIONAL);
                        } else { // pretty (international)
                            this.displayText = this.iti.getNumber(intlTelInputUtils.numberFormat.INTERNATIONAL);
                        }
                    } catch(_) {
                        this.displayText = e164;
                    }
                },

                onInput() {
                    this.valid = !!this.iti && this.iti.isValidNumber();
                    this.hasError = this.touched && !this.valid && (this.$refs.visible?.value.trim() !== '');
                    this.syncHidden();
                },

                onBlur() {
                    this.touched = true;
                    this.onInput();
                    if (this.isInline && opts.inlineSaveOnBlur) {
                        this.saveInline();
                    }
                },

                syncHidden() {
                    const hid = document.getElementById(opts.hiddenId);
                    if (!hid) return;
                    hid.value = this.getE164();
                },

                startEdit() {
                    this.editing = true;
                    this.$nextTick(() => this.$refs.visible?.focus());
                },

                saveInline() {
                    // บังคับ validation
                    const e164 = this.getE164();
                    document.getElementById(opts.hiddenId).value = e164;
                    this.updateDisplayText();

                    // ยิง custom event สำหรับ Livewire/Alpine listener ภายนอก
                    this.$dispatch('phone-saved', { name: opts.name, value: e164, valid: this.valid });

                    // ถ้าอยาก auto-close เฉพาะเมื่อ valid
                    if (this.valid) {
                        this.originalE164 = e164;
                        this.editing = false;
                    }
                },

                cancelInline() {
                    // revert กลับค่าเดิม
                    if (this.originalE164) {
                        try { this.iti.setNumber(this.originalE164); } catch(_) {}
                        document.getElementById(opts.hiddenId).value = this.originalE164;
                    } else {
                        this.$refs.visible.value = '';
                        document.getElementById(opts.hiddenId).value = '';
                    }
                    this.updateDisplayText();
                    this.editing = false;
                },
            }))
        })
    </script>
@endonce
