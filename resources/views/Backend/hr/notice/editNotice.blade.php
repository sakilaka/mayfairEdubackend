@extends('Backend.layouts.layouts')

@section('title', 'Edit Notice')

@section('main_contain')

<div class="br-mainpanel">

      <!-- <div class="br-pagetitle">
        <i class="fa-duotone fa-person-chalkboard"></i>
        <div>
          <h4>Update exam</h4>
          <p class="mg-b-0">Update Notice Information</p>
        </div>
      </div>d-flex -->


        <!-- <div class="p-5"> -->

            <div class="br-section-wrapper">
                {{-- <h2>Find The Best Teacher </h2> --}}
                @foreach ($editNotice as $notice)
               <form action="{{route('updateNotice',['id' => $notice->id])}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Notice :</label>
                            {{-- <input type="text" name="notice"  value="{{$notice->notice}}" class="form-control"> --}}
                            <select name="notice" id="" class="form-control">
                             <option value="">{{ $notice->notice }}</option>
                             <option value="Daily Notice">Daily Notice</option>
                                <option value="Monthly Notice">Monthly Notice</option>
                                <option value="Yearly Notice">Yearly Notice</option>
                                <option value="Instant Notice">Instant Notice</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="">Name :</label>
                            <input type="text" name="name"  value="{{$notice->name}}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Status : </label>
                            <select name="status" id="" class="form-control">
                                <option value="">-----Select Status-------</option>
                                <option value="active" @if($notice->status=='active') selected @endif>Active</option>
                                <option value="deactivae" @if($notice->status=='deactive') selected @endif>Deactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label for="">Description :</label>
                            <textarea id="editor" name="description" rows="10" cols="5" class="form-control">{{$notice->description}}</textarea>
                        </div>

                    </div>

                    <div class="row">
                        <button type="submit" class="btn btn-info"
                        style="width:30%;margin:0 auto; margin-top:30px;">
                        Update Notice</button>
                    </div>

               </form>
               @endforeach

            </div>


        <!-- </div> -->

<script src="js/custom/addTeacherForClass.js"></script>
</div>
@stop
