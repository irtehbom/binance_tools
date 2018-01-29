@include('front_templates/header')


<div class="container">
    <div class="row">

        <div class="auth-spacer"></div>

        <div class="col-md-12">


            <h2 class="text-center text-uppercase text-secondary mb-0">@if(isset($result->title)){{$result->title}}@endif</h2>
            <hr class="star-dark mb-12">
            
            <div style="background:url({{ url('/') }}/{{ $result->featured_image }}" class="post-single-image-bg"></div>

             <div class="spacer"></div>

            @if(isset($result->content))
            {!!$result->content!!}
            @endif

            <div class="spacer"></div>

        </div>

        <div class="spacer"></div>
    </div>
</div>


@include('front_templates/footer')

