<div
	x-data="{ value: @entangle($attributes->wire('model')) }"
	x-init="
		tinymce.init({
			target: $refs.tinymce,
			themes: 'modern',
			relative_urls: false,
			menubar: false,
			statusbar: false,
			mobile:{
				toolbar:false
			},
			plugins: 'autoresize code lists link paste autolink media',
			toolbar: 'media| link | undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code',
			media_dimensions: false,
			paste_preprocess: function(plugin, args) {
				var youTubeUrl=args.content;
				var youTubeId;
				    var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
				    var match = youTubeUrl.match(regExp);
				    if (match && match[2].length == 11) {
				       youTubeId = match[2];
				       args.content='\n' +`<iframe src='https://www.youtube.com/embed/${youTubeId}?feature=oembed' allowfullscreen></iframe>`;
				    }
			},
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
	@once
		@push('scripts')
			<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
			 <script>
			 </script>
		@endpush
	@endonce
</div>