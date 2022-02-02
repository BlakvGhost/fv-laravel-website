<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="{{ asset('logo.jpg') }}">
        <link rel="stylesheet" href="{{ asset('vendors/bootstrap/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/fa/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/bi/bootstrap-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/animate/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/swiper/package/swiper-bundle.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/owl/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/toastr/toastr.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/aos-master/dist/aos.css') }}">
        <script src="{{ asset('vendors/jquery/jquery.js') }}" charset="utf-8"></script>
        <script src="{{ asset('vendors/bootstrap/bootstrap.min.js') }}" charset="utf-8"></script>
        <script src="{{ asset('vendors/owl/owl.carousel.min.js') }}" charset="utf-8"></script>
        <script src="{{ asset('vendors/swiper/package/swiper-bundle.min.js') }}" charset="utf-8"></script>
        <script src="{{ asset('vendors/toastr/toastr.min.js') }}" charset="utf-8"></script>
        <script src="{{ asset('vendors/typed.js-master/lib/typed.min.js') }} " charset="utf-8"></script>
        <script src="{{ asset('vendors/aos-master/dist/aos.js') }}" charset="utf-8"></script>
        <script src="{{ asset('vendors/tinymce/tinymce.min.js') }}" charset="utf-8"></script>
        <script src="{{ asset('vendors/fv/fjs.init.js') }}" charset="utf-8" type="module"></script>
        <script src="{{ asset('js/app.js') }}" charset="utf-8" async></script>
          <script type="text/javascript" defer>
              tinymce.init({
                  selector: '#editor',
              });
          </script>
        <title>@yield('title') - FuturaVision</title>
        <style>
            @import "/css/master.css";
            @import "/css/mobile.css";
        </style>
  </head>
  <body>
       <section id="modal" style="z-index: 5000;">
        <div id="WindowPreloader" class="position-fixed top-0 start-0 w-100 modal-backdrop h-100 bg-black">
            <div class="container-fluid position-absolute start-0 top-50">
                <div class="row">
                    <div class="col col-6 m-auto">
                        <div class="text-center">
                            <h2 class="m-auto"><a href="javascript:void(0)" class="text-white-50 text-decoration-none">FuturaVision</a></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-offcanvas></x-offcanvas>
       </section>
      <x-header></x-header>
      <main>
        @yield('main')
      </main>
      <footer>
        @include('partials.footer')
      </footer>
  </body>
  @yield('script')
</html>
