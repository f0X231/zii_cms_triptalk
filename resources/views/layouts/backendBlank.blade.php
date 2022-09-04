<!DOCTYPE html>
<html lang="en"> 
<head>
    @include('backend.includes.head')
</head> 

<body class="app app-login p-0">    	
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">	
				    <div class="app-auth-branding mb-4">
                        <a class="app-logo" href="index.html">
                            <img class="logo-icon me-2" src="/assets/images/app-logo.svg" alt="logo">
                        </a>
                    </div>
					
                    @yield('content')

			    </div><!--//auth-body-->
		    
                @include('backend.includes.footer')
		    </div><!--//flex-column-->
	    </div><!--//auth-main-col-->

	    <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
		    <div class="auth-background-holder"></div>
		    <div class="auth-background-mask"></div>
	    </div><!--//auth-background-col-->
    
    </div><!--//row-->


</body>
</html> 

