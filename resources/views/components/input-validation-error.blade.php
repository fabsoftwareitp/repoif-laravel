@props(["inputName"])

@error($inputName)
    <p class="input-validation-error">{{ $message }}</p>
@enderror
