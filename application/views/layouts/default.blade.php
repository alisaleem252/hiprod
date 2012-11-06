<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        {{ HTML::page_title() }}
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Twitter Bootstrap CSS -->
        {{ Asset::container('bootstrapper')->styles() }}
        <!-- End Twitter Bootstrap CSS -->

        <!-- Application CSS -->
        {{ HTML::style('css/screen.css') }}
        <!-- Application CSS -->
        
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>
    <body id="{{ Request::route()->controller }}" class="{{ Request::route()->controller_action }}">

        <!-- Header -->
        {{ $header }}
        <!-- End Header -->

        <!-- Content -->
        {{ $content }}
        <!-- End Content -->
        
        <!-- Footer -->
        {{ $footer }}
        <!-- End Footer -->
        
        <!-- Javascript -->
        {{ Asset::container('bootstrapper')->scripts() }}
        {{ HTML::script('js/api.js') }}
        @yield('footer_scripts')
        <!-- End Javascript -->
    </body>
</html>