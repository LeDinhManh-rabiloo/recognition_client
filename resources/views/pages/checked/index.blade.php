@extends('layouts.app')

@section('title', __('Check student'))

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>@yield('title')</h2>
    <div class="btn-toolbar mb-2 mb-md-0">
      <a href="{{ route('home') }}" class="btn btn-outline-secondary">{{ __('Về trang chủ')}}</a>
    </div>
  </div>
  <div class="card ">
    <div class="card-body">
      <div class="container">
        <h1 class="text-center">
          Upload ảnh để điểm danh
        </h1>
        <div class="row conten-img">
          <div class="col-sm-3 pr-4" id="pig-0">
              <div class="form-group row border border-light py-3 rounded bg-light" id="frame-0">
                <div class="col col-12 col-sm-12">
                  <div class="add-cover-img mb-2 d-block">
                    <img src="{{ asset('images/not-found.png') }}" class="img-fluid" id="img-0"
                         width="200px">
                  </div>
                  <div class="custom-file">
                    <input type="file" name="sliders[]" class="custom-file-input input-file" id="slide-0"
                           data-index="0">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
                  <input id="update-0" class="update-file" data-index="0" name="update[]" type="hidden"
                         value="0">
                  <input class="update-base64" data-index="0" name="base64[]" type="hidden"
                         value="0" id="base64-0">
                </div>
                <div class="col col-12 col-sm-1 text-right">
                  <div class="btn btn-danger btn-sm icon-delete-slide" data-id="0" data-index="0">
                    <i class="fas fa-times"></i>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 d-flex justify-content-center">
            <div class="btn btn-success d-flex justify-content-center" id="add">
              +
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-3">
            <label for="Classes">Chọn lớp điểm danh:</label>
            {!! Form::select('class_number', $classes, null, ['id' => 'class_number', 'class' => 'form-control']) !!}
          </div>
        </div>
        <div class="row mt-3">
          <button class="btn btn-success" id="checked">
            Điểm danh
          </button>
        </div>
        <div class="row">
          {!! Form::open(['url' => route('studentcheck.checked'), 'method' => 'POST', 'id' => 'chekedTarget']) !!}
          {!! Form::hidden('classId', null, ['class' => "form-control", 'id' => 'classId']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection

@push('styles')
  <style type="text/css">
    #results { padding:10px; border:1px solid; background:#ccc; }
  </style>
@endpush
@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.25.0/moment.min.js"></script>
  <script language="JavaScript">
    var num = 0;
    $(document).on('click', '#add', function(event) {
      num++;
      let html = '<div class="col-sm-3 pr-4" id="pig-' + num +'">'+
        '<div class="form-group row border border-light py-3 rounded bg-light" id="frame-' + num +'">'+
        '<div class="col col-12 col-sm-12">'+
        '<div class="add-cover-img mb-2 d-block">'+
        '<img src="{{ asset("images/not-found.png") }}" class="img-fluid" id="img-' + num + '" width="200px">' +
        '</div>' +
        '<div class="custom-file">' +
        '<input type="file" name="sliders[]" class="custom-file-input input-file" id="slide-0" data-index="' + num + '">' +
        '<label class="custom-file-label" for="customFile">Choose file</label>' +
        '</div>' +
        '<input type="hidden" class="update-file" name="update[]" value="0" data-index="' + num + '" />' +
        '<input type="hidden" class="update-base64" name="base64[]" value="0" data-index="' + num + '" id="base64-'+ num +'"/>' +
        '</div>' +
        '<div class="col col-12 col-sm-1 text-right">'+
        '<div class="btn btn-danger btn-sm icon-delete-slide" data-id="' + num + '" data-index="' + num + '">'+
        '<i class="fas fa-times"></i>'+
        '</div>'+
        '</div>'+
        '</div>'+
      '</div>';
      $('.conten-img').append(html);
    });

    $(document).on('change', '.input-file', function(event) {
      event.preventDefault();
      let data_index = $(this).attr('data-index');
      /* Act on the event */
      let file = event.target.files[0];
      if (file) {
        let url = URL.createObjectURL(file);
        $('#frame-' + data_index + ' img').attr('src', url);
        var fileif = event.target.files[0];
        encodeImgtoBase64(fileif, data_index)
      }
    });


    $(document).on("click", ".icon-delete-slide", function() {
      let data_index = $(this).attr('data-index');
      let data_id = $(this).attr('data-id');
      if (data_id) {
        $('.list-file-delete').append('<input type="hidden" name="file_delete[]" value="' + data_id + '"/>');
      }
      $('#pig-' + data_index).remove();
    });

    function encodeImgtoBase64(file, data_index) {
      var reader = new FileReader();
      reader.onloadend = function() {
        $("#base64-" + data_index).val(reader.result);
      }
      reader.readAsDataURL(file);
    }

    $('#checked').click(function() {
      var images = $('input[name^=base64]').map(function(idx, elem) {
        return $(elem).val();
      }).get();
      var classId = $('#class_number option:selected').val();
      var form_data = {
        "classId" : classId,
        "images" : images
      }
      $('#classId').val(classId)
      $.ajax({
        type: 'POST',
        url: 'http://localhost:5000/api/v1/checkImage',
        contentType:"application/json",
        data: JSON.stringify(form_data),
        crossDomain:true,
        cache:false,
        processData: false,
        success: function(data) {
          if (data.about == 'success') {
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            var form_data_check = {
              "teacherId": "{{ Auth::user()->id }}",
              "classId": classId,
              "data": data.data
            }
            $.ajax({
              type: 'POST',
              url: "{{ route('studentcheck.checkday') }}",
              contentType:"application/json",
              dataType: 'json',
              data: JSON.stringify(form_data_check),
              success: function(data){
                if (data.success == 'successfully') {
                  $('#chekedTarget').submit();
                }
              }
            })
          }
        },
      });
    });
  </script>
@endpush
