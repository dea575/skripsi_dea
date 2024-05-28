@extends('admin.layouts.app')

@push('css')
    <style>
        .form-check-input{
            outline: 1px solid #0000;
            padding-right: 0px;

        }
    </style>
@endpush

@section('title')
    Artikel - Ubah
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" id="here">
                    <div class="card-body">
                        <form action="{{ route('admin.article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ $article->thumbnail }}" id="previewImage" class="img-fluid" style="max-height: 200px;" alt="">
                                </div>
                                <br>
                                <label for="thumbnail">Thumbnail</label>
                                <input type="file" name="thumbnail" id="thumbnail" class="form-control mt-2 photo @error('thumbnail') is-invalid @enderror">
                            </div>
                            <div class="form-group">
                                <label for="title">Judul</label>
                                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $article->title) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="section">Section</label>
                                <select name="section" class="form-select" id="section">
                                    <option value="all" {{ $article->section == 'all' ? 'selected' : 'selected' }}>Semua Section</option>
                                    <option value="dashboard" {{ $article->section == 'dashboard' ? 'selected' : '' }}>Beranda</option>
                                    <option value="depression" {{ $article->section == 'depression' ? 'selected' : '' }}>Depresi</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="content">Konten</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" name="content">{{ old('content', $article->content) }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-warning btn-fill pull-right">Ubah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('admin/js/tinymce/tinymce.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/assets/js/plugins/bootstrap-notify.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('html, body').animate({
            scrollTop: $('#here').offset().top
        }, 1000);

        $('#thumbnail').change(function () {
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("thumbnail").files[0]);

            oFReader.onload = function (oFREvent) {
                document.getElementById("previewImage").src = oFREvent.target.result;
            };
        })

        tinymce.init({
            selector: 'textarea',
            promotion: false,
            plugins: 'link lists',
            mobile: {
                menubar: true,
            }
        });
    })
</script>
@endpush
