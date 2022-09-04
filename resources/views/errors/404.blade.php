<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Portal - Bootstrap 5 Admin Dashboard Template For Developers</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 

    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="/assets/css/styles.css">

</head> 

<body class="app app-404-page">   	
   
    <div class="container mb-5">
	    <div class="row">
		    <div class="col-12 col-md-11 col-lg-7 col-xl-6 mx-auto">
			    <div class="app-branding text-center mb-5">
		            <a class="app-logo" href="/">
                        <img class="logo-icon me-2" src="/assets/images/app-logo.svg" alt="logo"><span class="logo-text">{{ __('pagesError.404.logoText') }}</span>
                    </a>
	
		        </div><!--//app-branding-->  
			    <div class="app-card p-5 text-center shadow-sm">
				    <h1 class="page-title mb-4">{{ __('pagesError.404.code') }}<br><span class="font-weight-light">{{ __('pagesError.404.error') }}</span></h1>
				    <div class="mb-4">{{ __('pagesError.404.desc') }}</div>
				    <a class="btn app-btn-primary" href="/">{{ __('pagesError.404.goHome') }}</a>
			    </div>
		    </div><!--//col-->
	    </div><!--//row-->
    </div><!--//container-->
   
    
    @include('backend.includes.footer')

    <!-- Page Specific JS -->
    <script src="/assets/js/app.js"></script> 

</body>
</html> 
