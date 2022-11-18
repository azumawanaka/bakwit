<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                @auth()
                <a class="nav-link" href="{{ route('home') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                @endauth
                <a class="nav-link" href="{{ route('mdrrmo.centers') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
                    MDRRMO
                </a>
                <a class="nav-link collapsed"
                   href="#"
                   data-bs-toggle="collapse"
                   data-bs-target="#collapseBdrrmo"
                   aria-expanded="false"
                   aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-city"></i></div>
                    BDRRMO
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse"
                     id="collapseBdrrmo"
                     aria-labelledby="headingOne"
                     data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('bdrrmo.index') }}">Evacuation Centers</a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ auth()->user()->name }}
        </div>
    </nav>
</div>