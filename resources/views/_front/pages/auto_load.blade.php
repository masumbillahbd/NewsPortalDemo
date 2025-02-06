<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CL24</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        main > .container {
            padding: 60px 15px 0;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">CL24</a>
            </div>
        </nav>
    </header>
    <main class="flex-shrink-0">
        <div class="container" id="post">
            
        </div>
        <p class="text-center loading">Loading...</p>
    </main>
    <script type="text/javascript">
        var paginate = 1;
        loadMoreData(paginate);
        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() >= $(document).height()) {
                paginate++;
                loadMoreData(paginate);
              }
        });
        // run function when user reaches to end of the page
        function loadMoreData(paginate) {
            $.ajax({
                url: '?page=' + paginate,
                type: 'get',
                datatype: 'html',
                beforeSend: function() {
                    $('.loading').show();
                }
            })
            .done(function(data) {
                if(data.length == 0) {
                    $('.loading').html('No more posts.');
                    return;
                  } else {
                    $('.loading').hide();
                    $('#post').append(data);
                  }
            })
               .fail(function(jqXHR, ajaxOptions, thrownError) {
                  alert('Something went wrong.');
               });
        }
    </script>
</body>
</html>