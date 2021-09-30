  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <div class="row">

          <div class="col-md-3 col-12">
            <a href="<?= base_url('Petugas/dataOrder/date') ?>">
              <div class="card pull-up bg-primary">
                <div class="card-content">
                  <div class="card-body">
                    <div class="media d-flex">
                      <div class="media-body text-left text-white">
                        <span>Order Hari Ini</span>
                        <h3 class="text-white"><?= $lapHarian ?></h3>
                      </div>
                      <div class="align-self-center">
                        <i class="la la-paste font-large-2 float-right text-white"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>

          <div class="col-md-3 col-12">
            <a href="<?= base_url('Petugas/dataOrder/week') ?>">
              <div class="card pull-up bg-info">
                <div class="card-content">
                  <div class="card-body">
                    <div class="media d-flex">
                      <div class="media-body text-left text-white">
                        <span>Order Minggu Ini</span>
                        <h3 class="text-white"><?= $lapMingguan ?></h3>
                      </div>
                      <div class="align-self-center">
                        <i class="la la-paste font-large-2 float-right text-white"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>

          <div class="col-md-3 col-12">
            <a href="<?= base_url('Petugas/dataOrder/month') ?>">
              <div class="card pull-up bg-success">
                <div class="card-content">
                  <div class="card-body">
                    <div class="media d-flex">
                      <div class="media-body text-left text-white">
                        <span>Order Bulan Ini</span>
                        <h3 class="text-white"><?= $lapBulanan ?></h3>
                      </div>
                      <div class="align-self-center">
                        <i class="la la-paste font-large-2 float-right text-white"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>

          <div class="col-md-3 col-12">
            <a href="<?= base_url('Petugas/dataOrder/year') ?>">
              <div class="card pull-up bg-danger bg-hexagons-danger">
                <div class="card-content">
                  <div class="card-body ">
                    <div class="media d-flex">
                      <div class="media-body text-left text-white">
                        <span>Order Tahun Ini</span>
                        <h3 class="text-white"><?= $lapTahunan ?></h3>
                      </div>
                      <div class="align-self-center">
                        <i class="la la-paste font-large-2 float-right text-white"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>

        </div>

      </div>
    </div>
  </div>