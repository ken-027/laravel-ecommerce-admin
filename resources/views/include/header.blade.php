<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- end Gist JS code-->
      <!-- saved from url=(0053) -->
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <!-- Required meta tags -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">

      <meta name="title" content="meta title here!">
      <meta name="keywords" content="meta keywords here!">
      <meta name="description" content="meta description here!">
      
      <meta name="robots" content="index,follow,archive">
      
      <title>{{ get_title_of_page(Route::currentRouteName()) }}</title>
      
      {{-- <link type="image/png" rel="shortcut icon" href="data:image/png;base64,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"> --}}
      <!-- Bootstrap CSS -->

      {{-- <link rel="stylesheet" href="{{ url('') }}/admin/css/bootstrap.min.css" />
      <link rel="stylesheet" href="{{ url('') }}/admin/css/dataTables.bootstrap5.min.css" /> --}}

    <!-- <link rel="sitemap" type="application/xml" title="Sitemap" href="https://jaspher-ga.stackstaging.com/sitemap.xml"> -->
      {{-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/> --}}
      <!-- Animation Quote Now Button CSS  -->
      {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> --}}
      {{-- <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"> --}}
      <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
      {{-- <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'> --}}

      {{-- user --}}

      @if (!strstr(url()->current(), 'admin') && !request()->routeIs('forgot-password') && !request()->routeIs('new-password'))
         <link rel="stylesheet" href="{{ mix('css/user.css') }}" type="text/css">
            {{-- <link rel="stylesheet" href="/css/user/style.css">
            <link rel="stylesheet" href="/css/user/custom.css">
            <link rel="stylesheet" href="/css/user/tellinput.css">
            <link rel="stylesheet" href="/css/user/bootstrapValidator.css">
            <link rel="stylesheet" href="/css/user/anim_button.css"> --}}
         {{-- <script>
            (function(d,h,w){var gist=w.gist=w.gist||[];gist.methods=['trackPageView','identify','track','setAppId'];gist.factory=function(t){return function(){var e=Array.prototype.slice.call(arguments);e.unshift(t);gist.push(e);return gist;}};for(var i=0;i<gist.methods.length;i++){var c=gist.methods[i];gist[c]=gist.factory(c)}s=d.createElement('script'),s.src="https://widget.getgist.com",s.async=!0,e=d.getElementsByTagName(h)[0],e.appendChild(s),s.addEventListener('load',function(e){},!1),gist.setAppId("zmafcg9f"),gist.trackPageView()})(document,'head',window);
         </script><script src="https://widget.getgist.com" async=""></script> --}}
      @else
         <link rel="stylesheet" href="{{ mix('css/admin.css') }}" type="text/css">
      @endif
   </head>
   <body>