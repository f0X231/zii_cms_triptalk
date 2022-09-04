<!DOCTYPE html>
<html lang="en"> 
<head>
    @include('backend.includes.head')
</head> 

<body class="app">
    
    @include('backend.includes.header')

    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">

			    @yield('content')

		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
	    @include('backend.includes.footer')
	    
    </div><!--//app-wrapper-->    					

    @include('backend.includes.scriptFooter')
</body>
</html> 

