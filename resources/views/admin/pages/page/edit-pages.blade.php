@extends('admin.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | Edit-Pages</title>
@endsection
@section('content')

<div class="container-fluid">
    <h4 class="mb-4">Edit Page</h4>
    <form id="edit_page" enctype="multipart/form-dlta">
        <input type="hidden" id="edit_id" name="edit_id" value="{{$data[0]->id}}">
        <div class="form-group row">
            <div class="col-md-6 col-lg-6 ">
                <label for="title">Page Title</label>
                <input type="text" class="form-control" name="edit_page_title" id="edit_page_title" placeholder="Enter Page Title" value="{{$data[0]->page_title}}">
            </div>

            <div class="col-md-6 col-lg-6 ">
            <label for="title">Permalink</label>
                <input type="text" class="form-control" name="edit_permalink" id="edit_permalink" placeholder="Enter Permalink" value="{{$data[0]->permalink}}" readonly="">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6 col-lg-6">
                <label for="title">Meta Title</label>
                <textarea class="form-control" name="edit_meta_title" id="edit_meta_title" rows="5" placeholder="Enter Meta Title" value="">{{$data[0]->meta_title}}</textarea>
            </div>
            <div class="col-md-6 col-lg-6">
                <label for="title">Meta Description</label>
                <textarea class="form-control" name="edit_meta_description" id="edit_meta_description" rows="5" placeholder="Enter Meta Description" value="">{{$data[0]->meta_description}}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6 col-lg-6">
                <label class="" for="inputGroupFile">Upload</label>
                <div class="input-group mb-3">
                    <input type="file" class="custom-file-input form-control" id="edit_feature_image" value="{{$data[0]->feature_image}}" name="edit_feature_image"/>
                    <label class="custom-file-label" id="picture_name" for="customFile">Choose Feature Image</label>
                    <small id="small"></small>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <label for="title">Order No</label>
                <input type="number" class="form-control" name="edit_order_no" id="edit_order_no" placeholder="Enter Order Number" value="{{$data[0]->order_no}}">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6 col-lg-6 d-flex">
                <input class="" type="checkbox" value="{{$data[0]->show_in_footer}}" id="edit_show_in_footer" name="edit_show_in_footer" @if($data[0]->show_in_footer) checked @endif>
                <label class="form-check-label pl-2" for="edit_show_in_footer">
                    Show Footer
                </label>
            </div>
            <div class="col-md-6 col-lg-6 d-flex">
                <input class="" type="checkbox" value="{{$data[0]->show_in_header}}" id="edit_show_in_header" name="edit_show_in_header"  @if($data[0]->show_in_header) checked @endif>
                <label class="form-check-label pl-2" for="edit_show_in_header">
                    Show header
                </label>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <label for="title">Page Description</label>
                <textarea class="ckeditor form-control" id="edit_page_description" value="" name="edit_page_description" rows="8" placeholder="Enter Page Description">{{$data[0]->page_description}}</textarea>
            </div>
        </div>
            <button type="submit" class="btn btn-primary float-right" id="add_event_btn">Submit</button>
    </form>
</div>
@endsection
@section('scripts')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script>
    
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        if(fileName.length > 22) {
            fileName = fileName.substring(0, 22) + '...';
        }
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    }); 
    //////////////////////////////////////////////////////////////////*VALIDATION*////////////////////////////////////////////////////////////////////////////
      function fieldValidation(){
        var valid = true;
        $(".error").remove();
        if ($('#edit_page_title').val() == "") {
            $("#edit_page_title").after(
                '<span class="error">Page title field is required</span>'
            );
            valid = false;
        }
        if(CKEDITOR.instances.edit_page_description.getData() == ''){
            $("#edit_page_description").after(
                '<span class="error">Page description field is required</span>'
            );
            valid = false;
        }
        if ($('#edit_meta_title').val() == "") {
            $("#edit_meta_title").after(
                '<span class="error">Meta title field is required</span>'
            );
            valid = false;
        }
        if ($('#edit_meta_description').val() == "") {
            $("#edit_meta_description").after(
                '<span class="error">Meta description field is required</span>'
            );
            valid = false;
        }
        if ($('#edit_feature_image').val() != "") {
            for (var i = 0; i < $("#feature_image").get(0).files.length; ++i) {

                var img = $("#feature_image").get(0).files[i].name;

                var img_ext = img.split('.').pop().toLowerCase();
                if ($.inArray(img_ext, ['jpg', 'jpeg', 'png']) === -1) {
                    $('#small').after("<span class='error'>File (" + img + ") type not allowed.</span>");
                    valid = false;
                }
            }
        }
        return valid;
    }
    //////////////////////////////////////////////////////////////////*EDIT PAGE*/////////////////////////////////////////////////////////////////////////////   
    $("#edit_page").submit(function(event){
        $("#add_event_btn").prop("disabled", true);
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        var ckedit = CKEDITOR.instances.edit_page_description.getData();
        formData.append('page_description', ckedit);
        if (fieldValidation()) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : "{{ url('admin/edit_page') }}",
                type : "POST",
                data : formData,
                processData: false,
                contentType: false,
                success : function(response){
                    console.log(response);
                    if (response['status'] == 1) {
                        $(".selected").html("Choose file");
                        // $('#editPageModal').modal('hide');
                        
                        $("#status").html(
                            '<div class="alert alert-success"><strong>Success!</strong>Page Edit Successfully.</div>'
                        );
                        setTimeout(function() {
                            $(".alert").css("display", "none");
                            window.location.href = "{{route('pages')}}";
                        }, 3000);
                    } else {
                        $("#status").html(
                            '<div class="alert alert-danger"><strong>Fail!</strong> Something is wrong.</div>'
                        );
                        setTimeout(function() {
                            $(".alert").css("display", "none");
                        }, 3000);
                    }

                }

            })
        }

    });
    //////////////////////////////////////////////////////////////////*PERMALINK AUTO ADD*////////////////////////////////////////////////////////////////////
    $("#edit_page_title").on( "keyup", function(e) {
        e.preventDefault();
        var edit_page_title = $('#edit_page_title').val();
        var editresult = edit_page_title.replace(/ /g, "-");
        // alert(editresult);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "{{ url('admin/edit_permalink') }}",
            type : "POST",
            data : {'edit_permalink':editresult },
            success : function(response){
                if (response['status'] == 1) {
                    $('#edit_permalink').val(response.permalink);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed', status, error);
            }
        })
    });
</script>
@endsection