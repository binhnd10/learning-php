@extends('base') 
@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Update a candidate</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif
        <form method="post" action="{{ route('candidates.update', $candidate->id) }}" enctype="multipart/form-data">
            @method('PATCH') 
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter name" required value="{{$candidate->name}}">
              </div>
              <div class="form-group">
                <label>Sex</label>
                <br/>
                <label class="radio-inline">
                  <input type="radio" name="sex" id="sex-1" value=1 {{ $candidate->sex == 1 ? 'checked' : '' }}>Male
                </label>
                <label class="radio-inline">
                  <input type="radio" name="sex" id="sex-2" value=2 {{ $candidate->sex == 2 ? 'checked' : '' }}>Female
                </label>
                <label class="radio-inline">
                  <input type="radio" name="sex" id="sex-3" value=3 {{ $candidate->sex == 3 ? 'checked' : '' }}>Other
                </label>
              </div>
              <div class="form-group">
                <label>Avatar</label>
                <p><img id="edit-avatar" class="candidate-avatar" src="{{ asset(Storage::url('images/'.$candidate->image_url)) }}"/></p>
                <input type="text" hidden name="image_name" value="{{$candidate->image_url}}">
                <input type="file" class="form-control" name="image" onchange="loadFile(event)">
              </div>
              <div class="form-group">
                <label>Birthday</label>
                <div id="datepicker-edit" class="input-group date" data-date-format="yyyy-mm-dd"> 
                  <input class="form-control" type="text" name="birthday" required value="{{$candidate->birthday}}"> 
                  <span class="input-group-addon" onclick=te()>
                    <i class="glyphicon glyphicon-calendar"></i>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label>Graduated year</label>
                <div id="yearpicker-edit" class="input-group date" data-date-format="yyyy"> 
                  <input class="form-control" type="text" name="graduated_year" required value="{{$candidate->graduated_year}}"> 
                  <span class="input-group-addon">
                    <i class="glyphicon glyphicon-menu-down"></i>
                  </span>
                </div>
              </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
<script>
    var loadFile = function(event) {
        console.log('loadFile');
        var image = document.getElementById('edit-avatar');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
    $(function () {  
        $("#datepicker-edit").datepicker({         
            autoclose: true,         
            todayHighlight: true 
            }).datepicker('update', new Date());
            $("#yearpicker-edit").datepicker({         
            format: " yyyy", // Notice the Extra space at the beginning
            viewMode: "years", 
            minViewMode: "years"
        });
    });

</script>
@endsection