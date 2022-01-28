@props(["imageUrl" => null])

<div
    class="image-input"
    x-data="{ imageUrl: {{ $imageUrl ? "'$imageUrl'" : 'null' }}, deletedImage: false }"
>
    <input
        class="image-input__input-file"
        id="input-file"
        name="photo"
        type="file"
        accept=".png, .jpg, .jpeg"
        x-on:change="loadImage"
    >
    <input
        type="hidden"
        name="deleted_image"
        :value="deletedImage"
    >

    <div class="image-input__container">
        <template x-if="imageUrl">
            <div class="image-input__picker">
                <div class="image-input__photo-container">
                    <img
                        class="image-input__photo"
                        :src="imageUrl"
                        alt="Foto do usuário"
                    >
                </div>

                <button
                    type="button"
                    class="image-input__delete-photo-btn"
                    @click="deleteImage"
                >
                    @php echo file_get_contents(public_path('img/icons/trash-icon.svg')) @endphp
                </button>
            </div>
        </template>

        <template x-if="! imageUrl">
            <div class="image-input__picker">
                <label
                    for="input-file"
                    class="image-input__photo-container"
                >
                    <img
                        class="image-input__photo"
                        src="{{ asset('img/icons/image-picker-icon.svg') }}"
                        alt="Selecione uma foto"
                    >
                </label>
            </div>
        </template>

        <label class="image-input__label">Foto</label>

        <template x-if="! imageUrl">
            <p class="image-input__info">
                Extensões permitidas: <span class="image-input__info-highlight">.png, .jpg, .jpeg</span><br>
                Tamanho máximo: <span class="image-input__info-highlight">5 MB</span>
            </p>
        </template>

        @error("photo")
            <p class="image-input__info image-input__info--error">{{ $message }}</p>
        @enderror
    </div>
</div>

@once
    @push("additional")
        <script>
            function loadImage() {
                const inputFile = document.querySelector("#input-file");

                if (inputFile.files[0]) {
                    const reader = new FileReader();

                    reader.onload = e => {
                        this.imageUrl = e.target.result;
                    }

                    reader.readAsDataURL(inputFile.files[0]);
                }
            }

            function deleteImage() {
                const inputFile = document.querySelector("#input-file");
                inputFile.value = "";

                this.imageUrl = null;
                this.deletedImage = true;
            }
        </script>
    @endpush
@endonce
