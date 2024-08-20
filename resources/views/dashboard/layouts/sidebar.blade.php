 <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
     <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu"
         aria-labelledby="sidebarMenuLabel">
         <div class="offcanvas-header">
             <h5 class="offcanvas-title" id="sidebarMenuLabel">HRIS</h5>
             <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                 aria-label="Close"></button>
         </div>
         <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
             <ul class="nav flex-column mb-auto">
                 <li class="nav-item">
                     <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="/">
                         <i class="fa-solid fa-house"></i>
                         Dashboard
                     </a>
                 </li>
                 <h6
                     class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                     <span>Karyawan</span>
                     <a class="link-secondary" href="#" aria-label="Add a new report">
                         <i class="fa-solid fa-users-rectangle"></i>
                     </a>
                 </h6>
                 <hr class="my-3">
                 <li class="nav-item">
                     <a class="nav-link d-flex align-items-center gap-2" href="{{ url('karyawan') }}">
                         <i class="fa-solid fa-users"></i>
                         Karyawan
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link d-flex align-items-center gap-2" href="/karyawan/create">
                         <i class="fa-solid fa-user-plus"></i>
                         Input Data Karyawan
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link d-flex align-items-center gap-2" href="{{ url('karyawankeluar') }}">
                         <i class="fa-solid fa-users-slash"></i>
                         Karyawan Keluar
                     </a>
                 </li>
             </ul>

             <h6
                 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                 <span>Data Master</span>
                 <a class="link-secondary" href="#" aria-label="Add a new report">
                     <i class="fa-solid fa-database fa-lg"></i>
                 </a>
             </h6>

             <hr class="my-3">

             <ul class="nav flex-column mb-auto">
                 <li class="nav-item">
                     <a class="nav-link d-flex align-items-center gap-2" href="/cuti">
                         <i class="fa-solid fa-person-walking-luggage"></i>
                         Cuti
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link d-flex align-items-center gap-2" href="/departemen">
                         <i class="bi bi-building"></i>
                         Departemen
                     </a>
                 </li>
                 {{-- <li class="nav-item">
                     <a class="nav-link d-flex align-items-center gap-2" href="/divisi">
                         <i class="fa-solid fa-clipboard-list"></i>
                         Divisi
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link d-flex align-items-center gap-2" href="/jabatan">
                         <i class="fa-solid fa-suitcase"></i>
                         Jabatan
                     </a>
                 </li> --}}
             </ul>

             <hr class="my-3">

             <ul class="nav flex-column mb-auto">
                 <li class="nav-item">
                     <form action="/logout" method="POST">
                         @csrf
                         <button type="submit" class="nav-link d-flex align-items-center gap-2">
                             <i class="fa-solid fa-door-open"></i>
                             Logout
                         </button>
                     </form>
                 </li>
             </ul>
         </div>
     </div>
 </div>
