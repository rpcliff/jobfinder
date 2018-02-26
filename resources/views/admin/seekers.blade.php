@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="list-group">
                @foreach($seekers as $seeker)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-2">
                                <?php $img_src = '/storage/seeker_images/seeker'.$seeker->user_id.'.png'; ?>
                                @if(file_exists(public_path($img_src)))
                                    <img style="width:120px;height:120px;" src="{{$img_src}}?={{ File::lastModified(public_path().'/'.$img_src) }}">
                                @else
                                    <img style='width:120px;height:120px;' src='/storage/company_images/noimage.png'>
                                @endif
                            </div>
                            <div class="col-md-4">
                                
                                <h4>{{ $seeker->name }}</h4>
                                <p>
                                <strong>Phone: </strong>{{ $seeker->phone }}<br>
                                <strong>Location: </strong>{{ $seeker->city }}, {{ $seeker->state }} {{ $seeker->zipcode }}<br>
                                <strong>Age: </strong>{{ $seeker->age }}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <h6>{{ $seeker->user->email }}</h6>
                                <strong>Applications: </strong>{{ count($seeker->applications) }}
                            </div>
                            <div class="col-md-2">
                                <span class="badge badge-secondary">{{ $seeker->created_at->toDayDateTimeString() }}</span>
                                
                            </div>
                        </div>
                        
                        <div class="row">
                            
                            <div class="col-md-12">
                                <a href="" class="btn btn-sm btn-outline-primary pr-2 pl-2 mt-2">View</a>
                                <a href="" class="btn btn-sm btn-outline-warning ml-2 mr-2 mt-2">Freeze</a>
                                <a href="" class="btn btn-sm btn-outline-danger mt-2">Delete</a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
 
    {{ $seekers->links('partials.pagination') }}

@endsection