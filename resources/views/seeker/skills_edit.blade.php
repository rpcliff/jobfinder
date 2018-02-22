@extends('layouts.master')

@section('page_css')
    <link href="{{ url('css/sortable.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

    <form method="POST" action="{{ url('/profile/'.Auth::user()->id.'/edit_skills') }}">

    {{ csrf_field() }}
    {{ method_field('PATCH') }}

        <div class="row justify-content-md-center">

            <div class="col-sm-6">
                
                @include('partials.errors')
                
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title text-center">Your Top 10 Skills List</h2>
                    </div>
                    
                    <div class="card-body">
                        <div class="skill_select_form" style="padding:10px;">
                            <select class="js-example-basic-single" id="skill_select" name="skill_select" style="width:400px;">
                                @foreach($skills_list as $skill)
                                    <?php $add = true; ?>
                                    @foreach($seeker_skills as $s_skill)
                                        @if($s_skill->skill_id == $skill->id)
                                            <?php 
                                                $add = false; 
                                                break;
                                            ?>
                                        @endif
                                    @endforeach
                                    @if($add)
                                        <option value='{{$skill->id}}'>{{$skill->name}}</option>
                                    @endif
                                @endforeach
                            </select>

                            <button type="button" class="add-el btn btn-primary" style="font-size:0.8em;">Add Skill</button>
                        </div>

                        <ul id="list2" class="list_2">
                            @foreach($seeker_skills as $skill)
                                
                                <li data-id='{{ $skill->skill_id }}' id='{{ $skill->skill_id }}'><span class='badge badge-dark'>{{ $skill->skill->name }} &nbsp;<i class='pull-right js-remove fa fa-trash'></i></span></li>
                                
                            @endforeach
                            
                        </ul>

                    </div>
                    
                    <div class="card-footer">
                        <h5 class="text-center" style="color:red; font-style:italic;">Order skills from most skilled (top) to least skilled (bottom).</h5>
                    </div>
                </div>
                
            </div>
        </div>
        
        <hr>
        
        <div class="row justify-content-md-center">
        
            <div class="col-md-3">
                <div class="form-group">
                    <a href="{{ url('/profile/'.Auth::user()->id) }}" class="btn btn-danger btn-block">Back</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </div>
            </div>
        </div>

    </form>

@endsection

@section('page_js')
    <script src="{{ asset('js/sortable.js') }}"></script>
    <script src="{{ asset('js/seeker_sortable.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
		  $('.js-example-basic-single').select2();
	   });
    </script>
@endsection