@props(["filename" => "", "inputName" => "", "inputPlaceholder" => ""])

<div
    class="input-file"
    x-data="{ filename: '{{ $filename }}' }"
>
    <input {{ $attributes->merge(["class" => "input-file__input"]) }}
        id="{{ $inputName }}"
        name="{{ $inputName }}"
        type="file"
        x-on:change="setFilename"
    >

    <label
        class="input-file__label"
        for="{{ $inputName }}"
    >
        <template x-if="filename">
            <span class="input-file__filename ellipsis" x-text="filename"></span>
        </template>

        <template x-if="! filename">
            <span class="input-file__placeholder ellipsis">{{ $inputPlaceholder }}</span>
        </template>
    </label>
</div>

@push("additional")
    <script defer>
        function setFilename() {
            const inputFile = document.querySelector("#{{ $inputName }}");

            if (inputFile.files[0]) {
                this.filename = inputFile.files[0].name;
            }
        }
    </script>
@endpush
