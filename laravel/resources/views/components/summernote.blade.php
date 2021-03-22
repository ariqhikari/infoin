<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script>
    $('#content').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'help']],
            ],
            height: 200,
            callbacks: {
            onImageUpload: function(files) {
                for(let i=0; i < files.length; i++) {
                    $.upload(files[i]);
                }
                console.log('file loading');
            },
            onMediaDelete : function(target) {
                deleteFile(target[0].src);
            }
        },
    });

    $.upload = function (file) {
        let out = new FormData();
        out.append('file', file, file.name);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'POST',
            url: '{{route("articles.upload.image")}}',
            contentType: false,
            cache: false,
            processData: false,
            data: out,
            success: function (img) {
                alert('Upload Data Successfull!');
                $('#content').summernote('insertImage', img);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Yang anda masukkan bukan gambar / gambar harus berektensi jpg,jpeg,svg!')
                console.error(textStatus + " " + errorThrown);
            }
        });
    };

    function deleteFile(src) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            data: {src : src},
            type: "POST",
            url: "{{route('articles.delete.image')}}",
            cache: false,
            success: function(resp) {
                alert(resp);
            }
        });
    }

    $('.btn-fullscreen').on('click', function(){
        $('.main-sidebar').toggleClass('z-index');
    });
</script>