<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title ?></h1>
        </div>
        <div class="row">
            <div class="col-12">
                <?php if ($this->session->flashdata('flash')) : ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <?= $this->session->flashdata('flash'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Chart Tagihan</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div id="divname" style="width:100%; height:100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Page Specific JS File -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<script>
    new Morris.Donut({
        element: 'divname',
        data: [{
                label: 'Tagihan Lunas',
                value: <?= $tagihan_lunas ?>
            },
            {
                label: 'Tagihan Belum Lunas',
                value: <?= $tagihan ?>
            }
        ]
    });
</script>