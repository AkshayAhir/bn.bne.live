@extends('admin.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | Add-Pages</title>
@endsection
@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Add Page</h4>
    <form id="add_page" enctype="multipart/form-dlta" class="form-field">
        <div class="form-group row">
            <div class="col-md-6 col-lg-6 ">
                <label for="title">Page Title</label>
                <input type="text" class="form-control" name="page_title" id="page_title" placeholder="Enter Page Title" value="">
            </div>

            <div class="col-md-6 col-lg-6 ">
                <label for="title">Permalink</label>
                <input type="text" class="form-control" name="permalink" id="permalink" placeholder="Enter Permalink" value="" readonly="">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6 col-lg-6">
                <label for="title">Meta Title</label>
                <textarea class="form-control" name="meta_title" id="meta_title" rows="5" placeholder="Enter Meta Title" value=""></textarea>
            </div>
            <div class="col-md-6 col-lg-6">
                <label for="title">Meta Description</label>
                <textarea class="form-control" name="meta_description" id="meta_description" rows="5" placeholder="Enter Meta Description" value=""></textarea>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6 col-lg-6">
                <label class="" for="inputGroupFile">Feature Image</label>
                <div class="input-group mb-3">
                    <input type="file" class="custom-file-input form-control" id="feature_image" name="feature_image"/>
                    <label class="custom-file-label" id="picture_name" for="customFile">Choose Feature Image</label>
                    <small id="small"></small>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <label for="title">Order No</label>
                <input type="number" class="form-control" name="order_no" id="order_no" placeholder="Enter Order Number" value="">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6 col-lg-6 d-flex" >
                <input class="" type="checkbox"  id="show_in_footer" name="show_in_footer">
                <label class="form-check-label pl-2" for="show_in_footer">
                    Show Footer
                </label>
            </div>

            <div class="col-md-6 col-lg-6 d-flex">
                <input class="" type="checkbox"  id="show_in_header" name="show_in_header">
                <label class="form-check-label pl-2" for="show_in_header">
                    Show header
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12">
                <label for="title">Page Description</label>
                <textarea class="ckeditor form-control" id="page_description" name="page_description" rows="8" placeholder="Enter Page Description" ></textarea>
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

    //////////////////////////////////////////////////////////////////*VALIDATION*/////////////////////////////////////////////////////////////////////////////
    function fieldValidation(){
        var valid = true;
        $(".error").remove();
        if ($('#page_title').val() == "") {
            $("#page_title").after(
                '<span class="error">Page title field is required</span>'
            );
            valid = false;
        }
        if(CKEDITOR.instances.page_description.getData() == ''){
            $("#page_description").after(
                '<span class="error">Page description field is required</span>'
            );
            valid = false;
        }
        if ($('#meta_title').val() == "") {
            $("#meta_title").after(
                '<span class="error">Meta title field is required</span>'
            );
            valid = false;
        }
        if ($('#meta_description').val() == "") {
            $("#meta_description").after(
                '<span class="error">Meta description field is required</span>'
            );
            valid = false;
        }
        if ($('#feature_image').val() != "") {
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
    //////////////////////////////////////////////////////////////////*INSERT PAGE*////////////////////////////////////////////////////////////////////////////
    $('#add_page').submit(function(event){
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        var ckpage = CKEDITOR.instances.page_description.getData();
        formData.append('page_description', ckpage);
        if (fieldValidation()) {
            $("#add_event_btn").prop("disabled", true);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "{{ url('admin/add_page') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response['status'] == 1) {
                        $("#add_page")[0].reset();
                        $(".selected").html("Choose file");
                        $('#addPageModal').modal('hide');
                        
                        $("#status").html(
                            '<div class="alert alert-success"><strong>Success!</strong> New Page Added Successfully.</div>'
                        );
                        setTimeout(function () {
                            $(".alert").css("display", "none");
                            window.location.href = "{{route('pages')}}";
                        }, 3000);
                    } else {
                        $("#status").html(
                            '<div class="alert alert-danger"><strong>Fail!</strong> Something is wrong.</div>'
                        );
                        setTimeout(function () {
                            $(".alert").css("display", "none");
                        }, 3000);
                    }
                }
            });
        }
    });
    //////////////////////////////////////////////////////////////////*PERMALINK AUTO ADD*/////////////////////////////////////////////////////////////////////

    $("#page_title").on( "keyup", function(e) {
        e.preventDefault();
        var page_title = $('#page_title').val();
        var result = page_title.replace(/ /g, "-");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "{{ url('admin/check_permalink') }}",
            type : "POST",
            data : {'permalink':result },
            success : function(response){
                if (response['status'] == 1) {
                    $('#permalink').val(response.permalink);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed', status, error);
            }
        })

    });
</script>
@endsection
