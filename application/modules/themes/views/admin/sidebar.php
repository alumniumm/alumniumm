<div class="site-menubar site-menubar-light">
    <div class="site-menubar-body">
      <div>
        <div>
          <ul class="site-menu" data-plugin="menu">
            <li class="site-menu-item <?php echo ($this->uri->segment(1) == 'dashboard' ? 'active' : '') ?>">
              <a class="animsition-link waves-effect waves-classic" href="<?php echo base_url('admin')?>" data-slug="Dashboard">
                <i class="site-menu-icon icon wb-home" aria-hidden="true"></i>
                <span class="site-menu-title">Dashboard</span>
              </a>
            </li>
            <li class="site-menu-item <?php echo ($this->uri->segment(2) == 'admin/alumni' ? 'active' : '') ?>">
              <a class="animsition-link waves-effect waves-classic" href="<?php echo base_url('admin/alumni')?>" data-slug="Alumni">
                <i class="site-menu-icon fa fa-graduation-cap" aria-hidden="true"></i>
                <span class="site-menu-title">Alumni</span>
              </a>
            </li>
            <li class="dropdown site-menu-item has-sub">
              <a data-toggle="dropdown" href="javascript:void(0)" data-dropdown-toggle="false">
                <i class="site-menu-icon fa-pencil" aria-hidden="true"></i>
                <span class="site-menu-title">Pertanyaan</span>
                <span class="site-menu-arrow"></span>
              </a>
              <div class="dropdown-menu">
                <div class="site-menu-scroll-wrap is-list">
                  <div>
                    <div>
                      <ul class="site-menu-sub site-menu-normal-list">
                        <li class="site-menu-item">
                          <a class="animsition-link waves-effect waves-classic" href="<?php echo base_url('admin/pertanyaan/alumni')?>">
                            <span class="site-menu-title"><i>Tracer Study</i> Alumni</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="dropdown site-menu-item has-sub">
              <a data-toggle="dropdown" href="javascript:void(0)" data-dropdown-toggle="false">
                <i class="site-menu-icon fa-book" aria-hidden="true"></i>
                <span class="site-menu-title">Laporan</span>
                <span class="site-menu-arrow"></span>
              </a>
              <div class="dropdown-menu">
                <div class="site-menu-scroll-wrap is-list">
                  <div>
                    <div>
                      <ul class="site-menu-sub site-menu-normal-list">
                        <!---<li class="site-menu-item">
                          <a class="animsition-link waves-effect waves-classic" href="<?php echo base_url('admin/laporan/alumni')?>">
                            <span class="site-menu-title"><i>Tracer Study</i> Alumni</span>
                          </a>
                        </li>-->
                        <li class="site-menu-item">
                          <a class="animsition-link waves-effect waves-classic" href="<?php echo base_url('admin/laporan/stakeholder')?>">
                            <span class="site-menu-title"><i>Tracer Study</i> Stakeholder</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="site-menu-item <?php echo ($this->uri->segment(3) == 'admin/karir' ? 'active' : '') ?>">
              <a class="animsition-link waves-effect waves-classic" href="<?php echo base_url('admin/karir')?>" data-slug="Karir">
                <i class="site-menu-icon fa fa-briefcase" aria-hidden="true"></i>
                <span class="site-menu-title">Karir</span>
              </a>
            </li>
            <li class="site-menu-item <?php echo ($this->uri->segment(4) == 'admin/agenda' ? 'active' : '') ?>">
              <a class="animsition-link waves-effect waves-classic" href="<?php echo base_url('admin/agenda')?>" data-slug="Agenda">
                <i class="site-menu-icon fa fa-calendar" aria-hidden="true"></i>
                <span class="site-menu-title">Agenda</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>