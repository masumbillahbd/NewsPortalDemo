@extends('layouts.backend')
@section('title')
 Admin | Trash Post
@endsection

@section('extra_css')

    <style type="text/css">
        .category__filter button {
            margin-left: 10px;
        }
        .create__post svg{
            stroke: #fff !important;
            width: 18px !important;
            height: 18px !important;
            margin-right: -4px;
        }
    </style>
@endsection

@section('extra_js')

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
                                <div class="col-md-6">
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
                                        All Trash Post
                                    </h4>
                                </div>
                                <div class="col-md-1 create__post">
                                    <a href="{{ route('post.create') }}" class="btn btn-info pt-3 pb-3 float-right">
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
                                        <th class="text-center">ID</th>
                                        <th>Headline</th>
                                        <th class="text-center" style="width: 120px">Time</th>
                                        <th>Created By</th>
                                        <th>Deleted By</th>
                                        <th class="text-center" style="width: 120px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <div class="pagination-info">
                                           <p>Showing {{$trashposts->firstItem()}} to {{$trashposts->lastItem()}} of {{$trashposts->total()}}</p>
                                        </div>
                                    @foreach($trashposts as $post)
                                        <tr>
                                            <td class="text-center">{{$post->post_id}}</td>
                                            <td class="post__name">
                                                <p>{{ Str::limit($post->headline, 80) }}</p>
                                            </td>
                                            <td class="text-center">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('H:i/d-m') }}</td>
                                            <td> 
                                                @if( $post->user_id != null) 
                                                    @if( $user = \App\Models\User::where('id',$post->user_id)->first() )
                                                  {{$user->name}}
                                                    @endif
                                                @endif 
                                            </td>
                                            <td>
                                                @if( $post->deleted_by != null) 
                                                    @if( $user = \App\Models\User::where('id',$post->deleted_by)->first() )
                                                  {{$user->name}}
                                                    @endif
                                                @endif 
                                                
                                            </td>
                                        
                                            <td class="text-center">
                                                <a title="view" target="_self" href="{{ route('trashpost.view',['id'=>$post->id]) }}"
                                                   class="btn btn-soft-success btn-icon btn-circle btn-sm"><i
                                                            class="fa fa-eye"></i></a>

                                                <div class="float-right">
                                                    <form method="POST"
                                                          action="{{ route('trashpost.destroy', ['id' => $post->id]) }}">
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

                                {{ $trashposts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


