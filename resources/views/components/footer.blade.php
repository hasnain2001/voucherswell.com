<footer class="bg-dark text-white pt-5 pb-4">
  <div class="container">
    <div class="row g-4">

      <!-- Brand Section with Enhanced Logo -->
      <div class="col-lg-4 col-md-6">
        <div class="footer-brand">
          <a href="{{ url(app()->getlocale().'/') }}" class="enhanced-logo mb-3 d-inline-block">

            <x-application-logo class="footer-logo"/>
          </a>
          <p class="text-light mb-4">@lang('nav.about-f')</p>
          <div class="social-links">
            <a href="#" class="text-warning me-3 fs-5"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-warning me-3 fs-5"><i class="bi bi-twitter"></i></a>
            <a href="#" class="text-warning me-3 fs-5"><i class="bi bi-instagram"></i></a>
            <a href="#" class="text-warning fs-5"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="col-lg-2 col-md-6">
        <h6 class="text-warning mb-3 fw-bold text-uppercase small">@lang('nav.Quick Links')</h6>
        <ul class="list-unstyled">
          <li class="mb-2"><a href="{{ url(app()->getlocale().'/') }}" class="text-white text-decoration-none hover-gold">@lang('nav.home')</a></li>
          <li class="mb-2"><a href="{{ route('stores' ,['lang'=> app()->getlocale()]) }}" class="text-white text-decoration-none hover-gold">@lang('nav.stores')</a></li>
          <li class="mb-2"><a href="{{ route('category' ,['lang'=> app()->getlocale()]) }}" class="text-white text-decoration-none hover-gold">@lang('nav.cateories')</a></li>
          <li class="mb-2"><a href="{{ route('blog' ,['lang'=> app()->getlocale()]) }}" class="text-white text-decoration-none hover-gold">@lang('nav.blogs')</a></li>
        </ul>
      </div>

      <!-- Support Links -->
      <div class="col-lg-3 col-md-6">
        <h6 class="text-warning mb-3 fw-bold text-uppercase small">@lang('nav.support')</h6>
        <ul class="list-unstyled">
          <li class="mb-2"><a href="{{ route('imprint', ['lang' => app()->getLocale()]) }}" class="text-white text-decoration-none hover-gold">@lang('nav.Imprint')</a></li>
          <li class="mb-2"><a href="{{ route('contact', ['lang' => app()->getLocale()]) }}" class="text-white text-decoration-none hover-gold">@lang('nav.contact')</a></li>
          <li class="mb-2"><a href="{{ route('privacy', ['lang' => app()->getLocale()]) }}" class="text-white text-decoration-none hover-gold">@lang('nav.Privacy Policy')</a></li>
          <li class="mb-2"><a href="{{ route('terms', ['lang' => app()->getLocale()]) }}" class="text-white text-decoration-none hover-gold">@lang('nav.Terms of Service')</a></li>
          <li class="mb-2"><a href="{{ route('about', ['lang' => app()->getLocale()]) }}" class="text-white text-decoration-none hover-gold">@lang('nav.about')</a></li>
        </ul>
      </div>

      <!-- Contact Info -->
      <div class="col-lg-3 col-md-6">
        <h6 class="text-warning mb-3 fw-bold text-uppercase small">@lang('nav.contact')</h6>
        <div class="contact-info">
          <p class="mb-2 d-flex align-items-center">
            <i class="bi bi-geo-alt text-warning me-2"></i>
            <span class="small">New York, United States</span>
          </p>
          <p class="mb-0 d-flex align-items-center">
            <i class="bi bi-envelope text-warning me-2"></i>
            <a href="mailto:info@retailtosave.com" class="text-white text-decoration-none hover-gold small">info@retailtosave.com</a>
          </p>
        </div>
      </div>
    </div>

    <!-- Copyright -->
    <hr class="my-4 border-warning">
    <div class="row align-items-center">
      <div class="col-md-8">
        <p class="mb-0 small">&copy; {{ date('Y') }} @lang('nav.Company Name. All rights reserved').</p>
      </div>
      <div class="col-md-4 text-md-end">
        <a href="{{ route('privacy', ['lang' => app()->getLocale()]) }}" class="text-warning text-decoration-none small me-3">Privacy Policy</a>
        <a href="{{ route('terms', ['lang' => app()->getLocale()]) }}" class="text-warning text-decoration-none small">Terms of Service</a>
      </div>
    </div>
  </div>
</footer>
