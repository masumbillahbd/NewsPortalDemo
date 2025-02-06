@extends('layouts.backend')
@section('title')
    Admin | Filter
@endsection

@section('extra_css')

<style type="text/css">
    .create__post svg {
        stroke: #fff !important;
        width: 18px !important;
        height: 18px !important;
        margin-right: -4px;
    }
</style>
@endsection

@section('extra_js')
<script>
    $(document).ready(function () {
        $('.auto-submit').on('change', function () {
            $('#filter-form').submit();
        });
        
        $('.publicationStatus').change(function(){
            var post_status = $(this).prop('checked') == true ? 1 : 0; 
            var id = $(this).data('id'); 
            console.log(id)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('publicationStatus') }}",
                data: {'post_status':post_status, 'id': id},
                success: function(data){
                     toastr.success(data.success)
                }
            });
        });
    })
</script>
@endsection

@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-12">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-2">
                                    <h4 class=" font-weight-light my-2 float-left">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon icon-tabler icon-tabler-brand-asana" width="38" height="38"
                                             viewBox="0 0 24 24" stroke-width="1" stroke="#ff9300" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <rect x="4" y="4" width="6" height="6" rx="1"/>
                                            <rect x="4" y="14" width="6" height="6" rx="1"/>
                                            <rect x="14" y="14" width="6" height="6" rx="1"/>
                                            <line x1="14" y1="7" x2="20" y2="7"/>
                                            <line x1="17" y1="4" x2="17" y2="10"/>
                                        </svg>
                                        All Posts
                                    </h4>
                                </div>
                                <div class="col-md-3">
                                    <div class="search-box">
                                        <div class="input-group">
                                            <form action="{{ route('post.search') }}" role="search" class="d-flex"
                                                  method="GET" style="margin: 0;">
                                                <input type="text" class="form-control" placeholder="Post ID, Headline or Text" name="value">
                                                <button class="btn btn-success px-4 ms-3" type="submit">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 category__filter">
                                    <div class="row m-0 p-0">
                                        <form id="filter-form" method="get" action="{{ route('post.filter')}}">
                                            <div class="form-group d-flex">
                                                <select style="width: 290px" class="form-select auto-submit form-control" id="sel1"
                                                        name="category_id">
                                                    <option value="" selected disabled>Category</option>
                                                    @foreach(\App\Models\Category::all() as $item)
                                                        <option @if($category_id) @if($category_id == $item->id)selected @endif @endif value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit"
                                                        class="btn btn-info float-right form-control" style="width: 130px">Submit
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-2 create__post">
                                    <a href="{{ route('post.create') }}" class="btn btn-primary pt-3 pb-3 float-right">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon icon-tabler icon-tabler-plus" width="8" height="8"
                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <line x1="12" y1="5" x2="12" y2="19"/>
                                            <line x1="5" y1="12" x2="19" y2="12"/>
                                        </svg>
                                        Create Post</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="text-center" style="width: 80px">ID</th>
                                        <th>Headline</th>
                                        <th class="text-center">Time</th>
                                        <th class="text-center">Publisher</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center" style="width: 80px">Total Hit</th>
                                        <th class="text-center" style="width: 180px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <div class="pagination-info">
                                           <p>Showing {{$posts->firstItem()}} to {{$posts->lastItem()}} of {{$posts->total()}}</p>
                                        </div>
                                    @foreach($posts as $post)
                                        <tr>
                                            <td class="text-center">{{$post->id}}</td>
                                            <td class="post__name">
                                                <a href="{{ news_url($post) }}" target="_blank">
                                                    <p>{{ Str::limit($post->headline, 55) }}</p>
                                                </a>
                                            </td>
                                            <td class="text-center">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('H:i/d-m') }}</td>
                                            <td class="text-center">{{  $post->User->name }}</td>
                                            <td class="text-center">
                                                <label class="switch">
                                                    <input id="publicationStatus" class="publicationStatus" data-id="{{$post->id}}"
                                                           type="checkbox" {{ $post->post_status == 1 ? 'checked' : '' }} >
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                @foreach($post->Category as $category)
                                                    <p>{!! $category->name !!}</p>
                                                @endforeach
                                                @foreach($post->subCategory as $subCategory)
                                                    <p>{!! $subCategory->name !!}</p>
                                                @endforeach
                                            </td>
                                            <td class="text-center">{{ $post->view_count }}</td>
                                            <td class="text-center">
                                                <a title="view" target="_blank" href="{{ news_url($post) }}"
                                                   class="btn btn-soft-success btn-icon btn-circle btn-sm"><i
                                                            class="fa fa-eye"></i></a>
                                                <a title="edit" href="{{ route('post.edit', ['id' => $post->id])}}"
                                                   class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i
                                                            class="fa fa-edit"></i></a>
                                                <a title="duplicate"
                                                   href="{{ route('post.duplicate', ['id' => $post->id])}}"
                                                   class="btn btn-soft-warning btn-icon btn-circle btn-sm"><i
                                                            class="fa fa-clone"></i></a>
                                                <div class="" style="display: inline-block;">
                                                    <form method="POST"
                                                          action="{{ route('post.destroy', ['id' => $post->id]) }}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="submit"
                                                                class="btn btn-soft-danger btn-icon btn-circle btn-sm delete_confirm"
                                                                data-toggle="tooltip" title='Delete'><i
                                                                    class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                                {{ $posts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


