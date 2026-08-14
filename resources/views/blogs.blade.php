@extends('layouts.app')

@section('content')
    <div class="w-full flex flex-col justify-center">

        <div class="w-full ">
            <img src="{{ asset('images/AI.jpg') }}" class="w-full h-[450px]" />
        </div>

        <div class="top-new shadow-md flex flex-col p-10">
            <div class="blog-title">Technology</div>
            <div class="blog-name mt-3 mb-5">AI and Automotive Technology: Exploring the integration of AI in electric
                vehicles
            </div>
            <div class="blog-bottom w-full flex justify-between items-center">
                <div class="flex justify-center items-center">
                    <img src="{{ asset('images/James.jpg') }}" class="img-author" />
                    <div class="ms-3 text-author">James Thomson</div>
                </div>
                <div class="blog_date">August 20, 2024</div>
            </div>
        </div>


    </div>
    <div class="w-full mt-10">
        <div class="w-full flex justify-center">
            <div class="w-blog mt-10 flex flex-wrap justify-between items-center ">


                <div class="blog-item flex flex-col justify-start items-center p-5">
                    <img src="{{ asset('images/5G.jpg') }}" class="img-blog" />
                    <div class="small-title-blog w-full flex justify-start py-2">Technology</div>
                    <div class="small-name-blog w-full flex justify-start">The Impact of 5G Technology</div>
                    <div class="w-full flex justify-start items-center">
                        <img src="{{ asset('images/James.jpg') }}" class="img-author1" />
                        <div class="ms-3 text-author1 py-3">James Thomson</div>
                    </div>
                    <div class="w-full blog_date1 pt-2">August 20, 2024</div>
                </div>
                <div class="blog-item flex flex-col justify-start items-center p-5">
                    <img src="{{ asset('images/5G.jpg') }}" class="img-blog" />
                    <div class="small-title-blog w-full flex justify-start py-2">Technology</div>
                    <div class="small-name-blog w-full flex justify-start">The Impact of 5G Technology</div>
                    <div class="w-full flex justify-start items-center">
                        <img src="{{ asset('images/James.jpg') }}" class="img-author1" />
                        <div class="ms-3 text-author1 py-3">James Thomson</div>
                    </div>
                    <div class="w-full blog_date1 pt-2">August 20, 2024</div>
                </div>
                <div class="blog-item flex flex-col justify-start items-center p-5">
                    <img src="{{ asset('images/5G.jpg') }}" class="img-blog" />
                    <div class="small-title-blog w-full flex justify-start py-2">Technology</div>
                    <div class="small-name-blog w-full flex justify-start">The Impact of 5G Technology</div>
                    <div class="w-full flex justify-start items-center">
                        <img src="{{ asset('images/James.jpg') }}" class="img-author1" />
                        <div class="ms-3 text-author1 py-3">James Thomson</div>
                    </div>
                    <div class="w-full blog_date1 pt-2">August 20, 2024</div>
                </div>
                <div class="blog-item flex flex-col justify-start items-center p-5">
                    <img src="{{ asset('images/5G.jpg') }}" class="img-blog" />
                    <div class="small-title-blog w-full flex justify-start py-2">Technology</div>
                    <div class="small-name-blog w-full flex justify-start">The Impact of 5G Technology</div>
                    <div class="w-full flex justify-start items-center">
                        <img src="{{ asset('images/James.jpg') }}" class="img-author1" />
                        <div class="ms-3 text-author1 py-3">James Thomson</div>
                    </div>
                    <div class="w-full blog_date1 pt-2">August 20, 2024</div>
                </div>
                @foreach ($blog as $b)
                    <a href="{{ route('blog.details', ['id' => $b->id]) }}"
                        class="blog-item flex flex-col justify-start items-center p-5">
                        <img src="{{ asset('images/5G.jpg') }}" class="img-blog" />
                        <div class="small-title-blog w-full flex justify-start py-2">{{ $b->title }}</div>
                        <div class="small-name-blog w-full flex justify-start">{{ $b->blogName }}</div>
                        <div class="w-full flex justify-start items-center">
                            <img src="{{ asset('images/James.jpg') }}" class="img-author1" />
                            <div class="ms-3 text-author1 py-3">{{ $b->user->firstname }} {{ $b->user->lastname }}
                            </div>
                        </div>
                        <div class="w-full blog_date1 pt-2">August 20, 2024</div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
