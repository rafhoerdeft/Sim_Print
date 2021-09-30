<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="navigation-header">
                <span data-i18n="nav.category.menu">Menu</span>
                <i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="menu"></i>
            </li>

            <li class="nav-item <?= ($active == '1' ? 'active' : '') ?>">
                <a href="<?= base_url('Petugas') ?>">
                    <i class="la la-home"></i>
                    <span class="menu-title">Dashboard</span>
                    <!-- <span class="badge badge badge-info badge-pill float-right mr-2">3</span> -->
                </a>
            </li>
            <li class="nav-item <?= ($active == '2' ? 'active' : '') ?>">
                <a href="javascript:void(0)">
                    <i class="la la-paste"></i>
                    <span class="menu-title">Order</span>
                </a>
                <ul class="menu-content">
                    <li class="menu-item <?= ($active == '2.1' ? 'active' : '') ?>">
                        <a href="<?= base_url('Petugas/addOrder') ?>">Tambah Order</a>
                    </li>
                    <li class="menu-item <?= ($active == '2.2' ? 'active' : '') ?>">
                        <a href="<?= base_url('Petugas/dataOrder') ?>">List Order</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?= ($active == '3' ? 'active' : '') ?>">
                <a href="<?= base_url('Petugas/dataLaporan') ?>">
                    <i class="la la-pencil-square"></i>
                    <span class="menu-title">Laporan</span>
                </a>
            </li>

        </ul>
    </div>
</div>