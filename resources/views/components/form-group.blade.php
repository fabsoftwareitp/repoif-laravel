@props([
    "component" => "input",
    "label" => "",
    "inputName",
    "inputType" => "text",
    "inputValue" => "",
    "inputPlaceholder" => "",
    "height" => "",
    "maxlength" => "",
    "options" => [],
    "onSelectChange" => "",
    "accept" => "",
    "filename" => ""
])

<div {{ $attributes->merge(["class" => "form-group"]) }}>
    @if ($label)
        <label class="form-group__input-label" for="{{ $inputName }}">{!! $label !!}</label>
    @endif

    <div class="form-group__input-group">
        @if ($component === "input")
            <x-input
                id="{{ $inputName }}"
                type="{{ $inputType }}"
                name="{{ $inputName }}"
                value="{{ $inputValue ?: old($inputName) }}"
                placeholder="{{ $inputPlaceholder }}"
            ></x-input>
        @elseif ($component === "text-area")
            <x-text-area
                id="{{ $inputName }}"
                name="{{ $inputName }}"
                value="{{ $inputValue ?: old($inputName) }}"
                placeholder="{{ $inputPlaceholder }}"
                height="{{ $height }}"
                maxlength="{{ $maxlength }}"
            ></x-text-area>
        @elseif ($component === "select")
            <x-select
                id="{{ $inputName }}"
                name="{{ $inputName }}"
                :options="$options"
                value="{{ $inputValue ?: old($inputName) }}"
                onSelectChange="{{ $onSelectChange }}"
            ></x-select>
        @elseif ($component === "input-file")
            <x-input-file
                filename="{{ $filename }}"
                inputName="{{ $inputName }}"
                inputPlaceholder="{{ $inputPlaceholder }}"
                accept="{{ $accept }}"
            ></x-input-file>
        @endif
        <x-input-validation-error inputName="{{ $inputName }}"></x-input-validation-error>
    </div>
</div>
