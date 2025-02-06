<footer class="bg-light " style="padding:0.75rem;">
    <style>
        .breaking__news .news__ticker .heading .bi.bi-quote{
            font-size: 46px;
            position: relative;
            color: #e98100;
        }
    </style>
    @php 
    $settings = \App\Models\Setting::first();
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">© <?php echo date("Y"); ?> <a href="/" style="color:#212529;" target="_blank"><strong>{{$settings->site}}</strong></a> | সর্বস্বত্ব স্বত্বাধিকার সংরক্ষিত</div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="d-flex float-right small">
                    <div class="text-muted">Powered by <a href="https://www.dataenvelope.com" style="color:#212529;" target="_blank"><strong>Data Envelope</strong></a></div>
                </div>
            </div>
        </div>
    </div>
</footer>