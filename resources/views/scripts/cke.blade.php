<script src="{{ asset('ckeditor5/ckeditor.js') }}"></script>
<script>
    window.addEventListener('load', function () {
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: "{{ route('user.uploadFile').'?_token='.csrf_token() }}",
                }
            })
            .then(editor => {

                console.log(editor);

            })
            .catch(error => {
                console.error(error);
            });
    });

</script>
