<!-- Footer -->
<footer style="margin: auto">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <ul class="list-inline text-center">
           
          </ul>
          {{-- @if (!\Request::is('login') && !\Request::is('register')) --}}
          <p class="copyright text-muted">Copyright &copy; ESTI  {{ date('Y') }}</p>
          {{-- @endif --}}
        </div>
      </div>
    </div>
  </footer>
