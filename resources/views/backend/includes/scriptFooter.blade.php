<!-- Javascript -->          
<script src="/assets/js/popper.min.js{{config('global.cacheversion')}}"></script>
<script src="/assets/js/bootstrap.min.js{{config('global.cacheversion')}}"></script>  

<!-- Charts JS -->
{{-- <script src="assets/plugins/chart.js/chart.min.js"></script> 
<script src="assets/js/index-charts.js"></script>  --}}

<!-- Page Specific JS -->
@if(!empty($pinfo['name'])) 
    <script src="/assets/js/{{$pinfo['name']}}.js{{config('global.cacheversion')}}"></script> 
@endif
<script src="/assets/js/app.js{{config('global.cacheversion')}}"></script> 
