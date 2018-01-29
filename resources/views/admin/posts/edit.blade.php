@extends('layouts.app')
@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />

<div class="add_button-container">
    <section class="content-header">
        <h1>
            Edit Post {{ $object->title }}
        </h1>

        @if (Session::has('message'))

        <div class="spacer"></div>
        {!! session('message') !!}

        @endif

    </section>

</div>

<form method="POST" id="form-validate" name="form-validate" action="{{ url('admin/posts/edit') }}/{{ $object->id }}">

    <div class="box box-primary">
        <div class="box-body">

            {{ csrf_field() }}

            <div class="input-group">
                <div class="input-group-addon">
                    {{ url('/') }}/<span id="slug_append"></span>
                </div>
                <input class="form-control inline" name="slug" id="slug" placeholder="SEO Url" type="text" value="{{$object->slug}}"/>
            </div>
            <div class="spacer"></div>
            


            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#content">Content</a></li>
                <li><a data-toggle="tab" href="#seo">SEO Properties</a></li>
                <li><a data-toggle="tab" href="#images">Featured Image</a></li>
            </ul>

            <div class="tab-content">
                <div id="content" class="tab-pane fade in active">

                    <h4 class="spacer title-spacer">Content</h4>

                    <div class="spacer"></div>
                    <div class="input-group">
                        <div class="input-group-addon">
                            Post Title
                        </div>
                        <input class="form-control inline" name="title" id="title" placeholder="Post Title" type="text" value="{{$object->title}}"/>
                    </div>


                    <div class="spacer"></div>
                    <textarea type="text" class="form-control spacer" name="content" id="content" placeholder="Product Content" value="">{{$object->content}}</textarea>
                    <div class="spacer"></div>

                </div>

                <div id="seo" class="tab-pane fade in">

                    <h4 class="spacer title-spacer">SEO Properties</h4>

                    <div class="spacer"></div>

                    <div class="input-group">
                        <div class="input-group-addon">
                            Meta Title
                        </div>
                        <input class="form-control inline" name="meta_title" id="meta_title" placeholder="Meta Title" type="text" value="{{$object->title}}"/>
                    </div>

                    <div class="spacer"></div>

                    <div class="input-group">
                        <div class="input-group-addon">
                            Meta Description
                        </div>
                        <input class="form-control inline" name="meta_description" id="meta_description" placeholder="Meta Description" type="text" value="{{$object->title}}"/>
                    </div>

                    <div class="spacer"></div>
                </div>
                
                <div id="images" class="tab-pane fade in active">
                    
                    <h4 class="spacer title-spacer">Featured Image</h4>
                    <div class="spacer"></div>
                    
                     <div class="input-group">
                        <div class="input-group-addon">
                            Featured Image
                        </div>
                        <div class="input-group image-preview">

                            @if( isset($object->featured_image))

                            <input type="text" class="form-control" name="featured_image" value="{{$object->featured_image}}">

                            @else

                            <input type="text" class="form-control" name="featured_image" value="">

                            @endif

                            <span class="input-group-btn">
                                <div class="btn btn-default image-preview-input" data-target="#my_modal" data-toggle="modal">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <span class="image-preview-input-title media_upload">Browse</span>
                                </div>
                            </span>
                        </div>
                    </div>
                    
                    <div class="spacer"></div>
                    
                </div>
                
            </div>

            <button type="submit" class="btn btn-success btn-lg btn-block">Save all Tabs</button>
            <div class="spacer"></div>
        </div>


    </div>
</form>

<div id="modal-large">
    <div class="modal fade" id="my_modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
        <div class="modal-dialog" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">File Details</h4>
                </div>
                <div class="modal-body">
                    @include('admin/partials/file_manager')
                </div>
                <div class="modal-footer" style="clear:both;">

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1//js/froala_editor.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>

$(function () {
    $('textarea').froalaEditor({
        paragraphFormat: {
            N: 'Normal',
            H1: 'Heading 1',
            H2: 'Heading 2'
        }
    });
});

$(document).ready(function () {

    $("form[name='form-validate']").validate({
        errorElement: 'div',
        // Specify validation rules
        rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            slug: "required",
            title: "required"
        },
        // Specify validation error messages
        messages: {
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function (form) {
            form.submit();

        }
    });

});

</script>



@endsection
