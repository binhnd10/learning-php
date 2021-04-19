@extends('base')

@section('main')
<div class="row">
    <div class="col-sm-12">
        <h1 class="display-3">candidates</h1> 
        @include('candidates.add_modal')
        @include('candidates.edit_modal')
        <!-- Button trigger modal -->
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addCandidateModal">Add candidate</button>   
        <table class="table table-striped candidate-list-table" id="candidate-list-table">
            <thead>
                <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Sex</td>
                <td>Birthday</td>
                <td>Avartar</td>
                <td>Graduated year</td>
                <td colspan = 2>Actions</td>
                </tr>
            </thead>
            <tbody>
                @foreach($candidates as $candidate)
                <tr id="row{{$candidate->id}}">
                    <td>{{$candidate->id}}</td>
                    <td>{{$candidate->name}}</td>
                    @if($candidate->sex == 1)
                        <td>Male</td>
                    @elseif($candidate->sex == 2)
                        <td>Female</td>
                    @else
                        <td>Other</td>
                    @endif
                    <td>{{$candidate->birthday}}</td>
                    <td class='candidate-avatar'><img src="{{ URL::to('/') }}/images/{{$candidate->image_url}}" class="img-fluid img-thumbnail" alt="Candidate"></td>
                    <td>{{$candidate->graduated_year}}</td>
                    <td>
                        <a href="{{ route('candidates.edit',$candidate->id)}}" class="btn btn-primary">Edit</a>
                        {{-- <button type="button" class="btn btn-primary" data-target="#editCandidateModal" data-toggle="modal" data-id="{{ $candidate->id }}" data-name="{{ $candidate->name }}" data-sex="{{ $candidate->sex }}" data-birthday="{{ $candidate->birthday }}" data-image_url="{{ asset(Storage::url('images/'.$candidate->image_url)) }}" data-image="{{$candidate->image_url}}" data-graduated_year="{{ $candidate->graduated_year }}">Edit</button> --}}
                    </td>
                    <td>
                        <button class="btn btn-danger delete-candidate-btn" onclick=deleteCandidate({{$candidate->id}}) type="submit">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    <div>
</div>
<script type="text/javascript">
    window.onload = function() {
        if (window.jQuery) {  
            // jQuery is loaded  
            
            window.jQuery = window.$ = jQuery;
        } else {
            // jQuery is not loaded
            alert("Doesn't Work");
        }
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    function deleteCandidate(id){
        $.ajax({
              type: "DELETE",
              url: "{{ url('candidates')}}"+'/'+id,
              success: function (data) {
                $("#row" + id).remove()
              },
              error: function (data,response) {
                  alert(response)
                  console.log('Error:', data);
              }
          });
      }
    
    var loadFile = function(event) {
        console.log('loadFile');
        var image = document.getElementById('edit-avatar');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
  </script>
@endsection