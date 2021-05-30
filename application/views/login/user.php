      <div class="right_col" role="main">
        <?php $this->session->set_userdata('referred_from', current_url()); ?>
        <?php if( $this->session->flashdata('auth2') ): ?>
          <div class="row">
              <div class="col-lg-12 flash">
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <?= $this->session->flashdata('auth2'); ?>.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              </div>
          </div>
        <?php elseif( $this->session->flashdata('flash') ): ?>
          <div class="row">
              <div class="col-lg-12 flash">
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Data <strong>Berhasil!</strong> <?= $this->session->flashdata('flash'); ?>.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              </div>
          </div>
        <?php elseif( $this->session->flashdata('makespjl') ): ?>
        <div class="row">
            <div class="col-lg-12 flash">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('makespjl'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
        <?php endif; ?>
      </div>
