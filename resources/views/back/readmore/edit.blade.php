@extends('layouts.backend')
@section('title')
Admin | All Category
@endsection

@section('extra_css')

<style type="text/css">

</style>
@endsection

@section('extra_js')
<script>
  
</script>
@endsection

@section('content')
  <main>
  <div class="container-fluid">
    <div class="row justify-content-center">  
      @include('back.parts.message')
      <div class="col-lg-4">
        <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
          <div class="card-header"><h4 class="text-center font-weight-light my-1">Edit Read More</h4></div>          
          <div class="card-body">
            <form role="form" name="form" method="post" action="{{ route('readmore.update',['id'=>$edit->id]) }}">
              @csrf

              <div class="form-group row">
                <label class="col-md-3" for="name">Leader Post <span class="text-danger">*</span></label>
                <div class="col-md-9">
                  <select class="form-control" name="leader" style="width:100%;">
                    <option value="">--Select Post--</option>
                    @foreach($posts as $post)
                    <option value="{{$post->id}}">{{$post->headline}}</option>
                    @endforeach
                  </select>
                  <span class="text-danger">{{ $errors->has('leader') ? $errors->first('leader'):''}}</span>
                </div>  
              </div>

              <div class="form-group row">
                <label class="col-md-3" for="name">Read More <span class="text-danger">*</span></label>
                <div class="col-md-9">
                  <select class="form-control" name="post_id" style="width:100%;">
                    <option value="">--Select Post--</option>
                    @foreach($posts as $post)
                    <option value="{{$post->id}}">{{$post->headline}}</option>
                    @endforeach
                  </select>
                  <span class="text-danger">{{ $errors->has('post_id') ? $errors->first('post_id'):''}}</span>
                </div>  
              </div>
              <button type="submit" class="float-right btn btn-primary">Updated</button>
            </form>
          </div>
        </div>
      </div> <!--col-6-->

      <div class="col-lg-8">
        <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">

          <div class="card-header"><h4 class="text-center font-weight-light my-1">All Read More</h4></div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                  <th>Leader Post</th>
                  <th>Read More</th>
                  <th>Image</th>
                  <th class="text-center" style="width: 150px">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($readmore as $post)
                  <tr>
                    <td>
                      <?php $leader = \App\Models\Post::where('id',$post->leader)->first(); ?>
                      @if(!empty($leader))
                        {{ $leader->headline}}
                      @endif
                    </td>
                    <td>
                      @if(!empty($post->post->headline))
                        {{ $post->post->headline }}
                      @endif
                    </td>
                    <td>
                      @if(!empty($post->post->featured_image))
                        <img src="{{ $post->post->featured_image}}"></td>
                    @endif
                    <td class="text-center">
                      @if(!empty($post->post->featured_image))
                        <a title="edit" href="{{ route('readmore.edit', ['id' => $post->id])}}" class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                      @endif
                      <div class="" style="display: inline-block;">
                        <form method="POST" action="{{ route('readmore.delete', ['id' => $post->id])}}">
                          @csrf
                          <input name="_method" type="hidden" value="DELETE">
                          <button type="submit" class="btn btn-soft-danger btn-icon btn-circle btn-sm delete_confirm" data-toggle="tooltip" title='Delete'><i class="fa fa-trash"></i></button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div> <!--col-6-->
      
    </div>
  </div>
</main>
<script type="text/javascript"> 
  document.forms['form'].elements['post_id'].value={{ $edit->post_id }}
</script>

@endsection
