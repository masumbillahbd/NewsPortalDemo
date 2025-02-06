@extends('layouts.backend')
@section('title')
     Admin | User post
@endsection

@section('extra_css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

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
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
$(function() {
  $('input[name="date"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
</script>

@endsection

@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-6">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                        <div class="card-header">
                            <div class="row">
                                
                                <div class="col-md-12 justify-content-center">
                                    <div class="justify-content-center">
                                        <form method="get" class="form-sub" id="date-form" action="{{ route('user.post.by.date')}}">
                                            <div class="form-group d-flex">
                                               <div class="dateSearch w-90" id="dateSrcBox">
                                                <input class="form-control"  type="text" name="date" value="" required="" placeholder="date" >
                                                </div>
                                                <button type="submit" class="w-10 btn btn-info float-right ">Filter
                                                </button>
                                            </div>
                                        </form>
                                    </div>    
                                </div>
                            </div>
                            <div class="text-center">
                                <h4>{{$start_date}} to {{$end_date}}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th class="text-center">Total Post</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dateRange as $date)
                                        <?php 
                                         $totalUserPost = DB::select('SELECT count(id) as userPost FROM posts WHERE (DATE(created_at) BETWEEN "'.$date.'" AND "'.$date.'") AND user_id='.$user->id.' ');   
                                        ?>
                                        <tr>
                                            <td>{{$date}}</td>
                                            <td class="text-center">{{$totalUserPost[0]->userPost}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


