@extends('layouts.app')

@section('content')
    <div class="w-full flex justify-center items-center my-5">
        <div class="w-blogdetail flex flex-col justify-start items-start my-5 mx-2">
            <div class="blog-title">{{ $blogdetail->title }}</div>
            <div class="blog-name w-full mt-3 mb-5">{{ $blogdetail->blogName }}
            </div>

            <div class="blog-bottom w-full flex justify-between items-center">
                <div class="flex justify-center items-center">
                    <img src="{{ asset('images/James.jpg') }}" class="img-author" />
                    <div class="ms-3 text-author">{{ $blogdetail->user->firstname }} {{ $blogdetail->user->lastname }}</div>
                </div>
                <div class="blog_date">August 20, 2024</div>
            </div>
            <div class="w-full my-4">
                <img src="{{ asset('images/AI.jpg') }}" class="w-full h-[450px]" />
            </div>

            <div class="w-full content mt-4 text-justify">
                {!! $blogdetail->content !!}
            </div>
        </div>
    </div>
@endsection
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            allowedContent: true, // Cho phép HTML tùy chỉnh
            extraAllowedContent: 'p{text-align}; span{color, font-weight, font-style}; div{background-color};img[src,alt,width,height]',
            disallowedContent: 'img{style,class,on*}; table{*};', // Chặn style không mong muốn
            removePlugins: ['Styles', 'StylesCombo'], // Tắt plugin style thừa
        })
        .then(editor => {
            console.log('CKEditor đã load thành công!');
        })
        .catch(error => {
            console.error(error);
        });
</script>
