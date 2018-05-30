<div class="site-menubar site-menubar-light">
    <div class="site-menubar-body">
      <div>
        <div>
          <ul class="site-menu" data-plugin="menu">
            <li class="site-menu-item <?php echo ($this->uri->segment(1) == 'dashboard' ? 'active' : '') ?>">
              <a class="animsition-link waves-effect waves-classic" href="<?php echo base_url('alumni')?>" data-slug="Dashboard">
                <i class="site-menu-icon icon wb-home" aria-hidden="true"></i>
                <span class="site-menu-title">Dashboard</span>
              </a>
            </li>
            <li class="dropdown site-menu-item has-sub">
              <a data-toggle="dropdown" href="javascript:void(0)" data-dropdown-toggle="false">
                <i class="site-menu-icon fa-book" aria-hidden="true"></i>
                <span class="site-menu-title">Tracer Study</span>
                <span class="site-menu-arrow"></span>
              </a>
              <div class="dropdown-menu">
                <div class="site-menu-scroll-wrap is-list">
                  <div>
                    <div>
                      <ul class="site-menu-sub site-menu-normal-list">
                        <li class="site-menu-item">
                          <a class="animsition-link waves-effect waves-classic" href="<?php echo base_url('alumni/ts-alumni')?>">
                            <span class="site-menu-title"><i>Tracer Study</i> Alumni</span>
                          </a>
                        </li>
                        <li class="site-menu-item">
                          <a class="animsition-link waves-effect waves-classic" href="<?php echo base_url('alumni/ts-stakeholder')?>">
                            <span class="site-menu-title"><i>Tracer Study</i> Stakeholder</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="site-menu-item <?php echo ($this->uri->segment(2) == 'admin/alumni' ? 'active' : '') ?>">
              <a class="animsition-link waves-effect waves-classic" href="<?php echo base_url('alumni/cari-alumni')?>" data-slug="Alumni">
                <i class="site-menu-icon fa fa-graduation-cap" aria-hidden="true"></i>
                <span class="site-menu-title">Cari Alumni Terdekat</span>
              </a>
            </li>
            <li class="site-menu-item <?php echo ($this->uri->segment(3) == 'dashboard' ? 'active' : '') ?>">
              <a class="animsition-link waves-effect waves-classic" href="<?php echo base_url('alumni/karir')?>" data-slug="Dashboard">
                <i class="site-menu-icon fa fa-building" aria-hidden="true"></i>
                <span class="site-menu-title">Informasi Karir</span>
              </a>
            </li>
            <li class="site-menu-item navbar-right">
              <button class="btn btn-warning margin-top-10 margin-left-25 btn-sm animated infinite pulse waves-effect waves-light" data-toggle="modal" data-target="#modalAluminium"><i class="fa fa-graduation-cap"></i> Selamat Datang di Aluminium</button>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>