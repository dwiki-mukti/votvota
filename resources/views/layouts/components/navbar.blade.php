<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="../../index3.html" class="navbar-brand">
        <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="{{ Route('voting.index') }}" class="nav-link" id="sidebarVoting">Voting</a>
          </li>
          <li class="nav-item">
            <a href="{{ Route('riwayat.index') }}" class="nav-link" id="sidebarRiwayat">Riwayat</a>
          </li>
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item dropdown">
          <div class="btn btn-sm btn-logout" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-power-off"></i>
            <span>logout</span>
          </div>
        </li>
      </ul>
    </div>
  </nav>

  <!-- modal -->
@auth
<div class="modal fade" id="logoutModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ Route('logout') }}" method="POST" class="text-center">
                @csrf
                <div class="modal-body">
                  <div class="my-4">Anda Benar-benar ingin logout dari akun in?</div>
                </div>
                <div class="row m-0 border-top">
                  <button type="submit" class="btn justify-content-center col-6 py-3 hover:bg-danger border-right" style="cursor: pointer; border-radius: 0; border-bottom-left-radius: 0.2rem;">Ya</button>
                  <div type="button" data-dismiss="modal" aria-label="Close" class="col-6 py-3 hover:bg-secondary" style="cursor: pointer; border-bottom-right-radius: 0.2rem;">Tidak</div>
                </div>
            </form>
        </div>
    </div>
</div>
@endauth
<!-- end modal -->