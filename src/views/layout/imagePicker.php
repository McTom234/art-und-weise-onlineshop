<div class="image-picker-wrapper">
    <label for="image-picker">
        <img id="image-preview" alt="Bildvorschau" src="<?php if(isset($src)) echo $src ?>"/>
    </label>

    <input id="image-picker" type="file" name="image" accept="image/*"/>
</div>

<script>
    $("#image-picker").change(() => {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                $('#image-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
