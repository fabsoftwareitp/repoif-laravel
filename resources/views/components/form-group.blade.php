@props(["label", "inputName", "inputType" => "text", "inputValue", "inputPlaceholder" => ""])

<div {{ $attributes->merge(["class" => "form-group"]) }}>
    <label class="form-group__input-label" for="{{ $inputName }}">{{ $label }}</label>

    <div class="form-group__input-group">
        <x-input
            id="{{ $inputName }}"
            type="{{ $inputType }}"
            name="{{ $inputName }}"
            value="{{ $inputValue ?? old($inputName) }}"
            placeholder="{{ $inputPlaceholder }}"
        ></x-input>
        <x-input-validation-error inputName="{{ $inputName }}"></x-input-validation-error>
    </div>
</div>
