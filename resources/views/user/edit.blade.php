@extends('layouts.layout')
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">{{__('page-data.edit_user')}}</h3>
          </div>
          <!-- <form> -->
            <div class="card-body">
              <form method="POST" action="{{route('user.update', $user->id)}}" id="create-student-form" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                <div class="form-group">
                  <label for="name">{{__('page-data.user_name')}}</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" placeholder="{{__('page-data.user_name')}}" >
                </div>
                @if($errors->has('name'))
                    <div class="error">{{ $errors->first('name') }}</div>
                @endif
                <div class="form-group">
                  <label for="exampleInputEmail1">{{__('page-data.user_email')}}</label>
                  <input type="email" class="form-control" name="email" id="email"  value="{{$user->email}}" placeholder="{{__('page-data.user_email')}}">
                  @if ($errors->has('email'))
                    <div class="error">{{ $errors->first('email') }}</div>
                  @endif  
                </div>
                <div class="form-group">
                  <label for="status">{{__('page-data.user_status')}} </label>
                  <div class="input-group input-group-outline">
                      <input type="radio" class="radio" id="active" name="status" value="1" {{($user->status == 1 ? 'checked' : '')}} ><label for="active">{{__('page-data.active_user')}}</label>
                      <input type="radio" class="radio" id="inactive" name="status" value="0" {{($user->status == 0 ? 'checked' : '')}}><label for="inactive">{{__('page-data.inactive_user')}}</label>
                  </div>
                </div>
              <!-- /.card-body -->
              <input type="hidden" name="user_id" value="{{ $user->id }}"/>
              <div class="card-footer">
                <a href="{{route('user.index')}}" class="btn btn-primary">{{__('page-data.cancel_user')}}</a>
                <input type="submit"  value="{{__('page-data.submit_user')}}" class="btn btn-success">
              </div>
            </form>
          <!-- </form> -->
        </div>

      </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
@endsection