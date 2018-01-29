@include('front_templates/header')


<div class="container">
    <div class="row">

        <div class="auth-spacer"></div>

        <div class="col-md-12">


            <h2 class="text-center text-uppercase text-secondary mb-0">@if(isset($result->title)){{$result->title}}@endif</h2>
            <hr class="star-dark mb-5">


            @if(isset($result->content))
            {!!$result->content!!}
            @endif

            <div class="row">

                @foreach($posts as $post)

                <div class="col-sm-4">

                    <div class="blog-single-container">

                        <h3 style="text-align:center">{{$post->title}}</h3>
                        <div class="spacer"></div>

                        <div style="background:url({{ url('/') }}/{{ $post->featured_image }}" alt="{{$post->title}})" class="image">
                            <div class="overlay">

                                <a class="btn btn-xl btn-outline-light blog-read-more"  href="{{ url('/') }}/blog/{{$post->slug}}">
                                    <i class="fa fa-download mr-2"></i>
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach

            </div>

            <div class="spacer"></div>
            <div class="spacer"></div>

        </div>

        <div class="spacer"></div>
    </div>
</div>


@include('front_templates/footer')

