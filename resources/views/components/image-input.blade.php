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
        accept=".png, .jpg, .jpge"
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
                    <svg class="image-input__delete-photo-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22" height="25" viewBox="0 0 22 25"><defs><clipPath><rect width="22" height="25" fill="#fff" stroke="#707070" stroke-width="1"/></clipPath></defs><g clip-path="url(#a)"><g transform="translate(1 1.104)"><g transform="translate(1.994 8.547)"><path d="M15.954,22.792H6.724A3.368,3.368,0,0,1,3.362,19.43V9.117a.538.538,0,0,1,.57-.57.538.538,0,0,1,.57.57V19.43a2.225,2.225,0,0,0,2.222,2.222h9.231a2.225,2.225,0,0,0,2.222-2.222V9.117a.57.57,0,0,1,1.14,0V19.43A3.405,3.405,0,0,1,15.954,22.792Z" transform="translate(-3.362 -8.547)" fill="#ff4d58" stroke="#ff4d58" stroke-width="0.6"/></g><path d="M18.974,2.792h-4.33a3.352,3.352,0,0,0-6.61,0H3.7A2.311,2.311,0,0,0,1.368,5.128,2.263,2.263,0,0,0,3.7,7.407H19.031a2.309,2.309,0,1,0-.057-4.615ZM11.339,1.14a2.142,2.142,0,0,1,2.108,1.652H9.174A2.257,2.257,0,0,1,11.339,1.14Zm7.635,5.128H3.7a1.2,1.2,0,0,1,0-2.393H19.031a1.2,1.2,0,0,1,1.2,1.2A1.253,1.253,0,0,1,18.974,6.268Z" transform="translate(-1.368)" fill="#ff4d58" stroke="#ff4d58" stroke-width="0.6"/><g transform="translate(5.413 9.345)"><path d="M7.35,20a.538.538,0,0,1-.57-.57V9.915a.57.57,0,1,1,1.14,0V19.43A.613.613,0,0,1,7.35,20Z" transform="translate(-6.781 -9.345)" fill="#ff4d58" stroke="#ff4d58" stroke-width="0.6"/></g><g transform="translate(13.39 9.345)"><path d="M15.328,20a.538.538,0,0,1-.57-.57V9.915a.57.57,0,1,1,1.14,0V19.43A.613.613,0,0,1,15.328,20Z" transform="translate(-14.758 -9.345)" fill="#ff4d58" stroke="#ff4d58" stroke-width="0.6"/></g><g transform="translate(9.402 9.345)"><path d="M11.339,20a.538.538,0,0,1-.57-.57V9.915a.57.57,0,1,1,1.14,0V19.43A.613.613,0,0,1,11.339,20Z" transform="translate(-10.769 -9.345)" fill="#ff4d58" stroke="#ff4d58" stroke-width="0.6"/></g></g></g></svg>
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
                Extensões permitidas: <span class="image-input__info-highlight">.png, .jpg, .jpge</span><br>
                Tamanho máximo: <span class="image-input__info-highlight">5 MB</span>
            </p>
        </template>

        @error("photo")
            <p class="image-input__info image-input__info--error">{{ $message }}</p>
        @enderror
    </div>
</div>

@push("additional")
    <script defer>
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
