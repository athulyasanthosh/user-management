@extends('layouts.layout')
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
          
        <div class="card">
          <div class="card-header">
            @if(session()->has('success'))
              
              <div class="alert alert-success alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <div>{{ nl2br(Session::get('success')) }}</div>
              </div>
              @endif
              @if(session()->has('deleted'))
              
              <div class="alert alert-success alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <div>{{ nl2br(Session::get('deleted')) }}</div>
              </div>
              @endif
            <div class="row">
              <div class="col-md-10">
                <h3 class="card-title">{{__('page-data.user_details')}}</h3>
              </div>
              <div class="col-md-2">
                <a href="{{route('user.create')}}" class="btn btn-primary">{{__('page-data.add_user')}}</a>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>{{__('page-data.user_id')}}</th>
                <th>{{__('page-data.user_name')}}</th>
                <th>{{__('page-data.user_email')}}</th>
                <th>{{__('page-data.user_status')}}</th>
                <th>{{__('page-data.edit')}}</th>
                <th>{{__('page-data.delete')}}</th>
              </tr>
              </thead>
              <tbody>
              @forelse($users as $user)
                <tr>
                  <td>{{$user->id}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{($user->status == 1? 'Active':'Inactive')}}</td>
                  <td><a href="{{route('user.edit',$user->id)}}" class="btn btn-primary">{{__('page-data.edit')}}</a></td>
                  <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" onclick="deleteData({{$user->id}})">{{__('page-data.delete')}}</button></td></td>
                </tr>                  
                @empty
                <tr>
                    <td colspan="6">{{__('page-data.empty_list')}}</td>
                 </tr>                      
                @endforelse
              </tbody>
             
            </table>
            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="deleteModal">
                <form method="POST" action="" id="delete-form"> 
                        @method('DELETE')
                        @csrf    
                  <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">{{__('page-data.delete_user')}}</h4>
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <p>{{__('page-data.confirmation')}}</p>
                        </div>
                        <div class="modal-footer">
                         
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('page-data.close')}}</button>
                            <button type="submit" class="btn btn-danger" onclick="formSubmit()">{{__('page-data.delete')}}</button>
                        </div>
                      </div>
                  </div>
                </form>
             </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
@endsection
@section('scripts')
<!-- DataTables  & Plugins -->

<script type="text/javascript">
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  function deleteData(id)
    {
        var user_id = id;
        var url = '{{ route("user.destroy", ":id") }}';
        url = url.replace(':id', user_id);
        jQuery("#delete-form").attr('action', url);
        
    }
</script>
@endsection