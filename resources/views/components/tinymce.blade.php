<div
    x-data="{ value: @entangle($attributes->wire('model')) }"
    x-init="
        tinymce.init({
            target: $refs.tinymce,
            themes: 'modern',
            menubar: false,
            statusbar: false,
            mobile:{
                toolbar:false
            },
            plugins: 'code lists link paste autolink media',
            toolbar: 'media| link | undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code',
            setup: function(editor) {
                editor.on('blur', function(e) {
                    value = editor.getContent()
                })

                editor.on('init', function (e) {
                    if (value != null) {
                        editor.setContent(value)
                    }
                })

                function putCursorToEnd() {
                    editor.selection.select(editor.getBody(), true);
                    editor.selection.collapse(false);
                }

                $watch('value', function (newValue) {
                    if (newValue !== editor.getContent()) {
                        editor.resetContent(newValue || '');
                        putCursorToEnd();
                    }
                });
            }
        })
    "
    wire:ignore
>
    <div>
        <input
            x-ref="tinymce"
            type="textarea"
            {{ $attributes->whereDoesntStartWith('wire:model') }}
        >
    </div>
</div>