<div class="row">
    <?php
    if (isset($dashboard_stats_list)) {
        foreach ($dashboard_stats_list as $stat) {
            ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat2 ">
                        <div class="display">
                            <div class="number">
                                <h3 class="font-<?= $stat['font-color'];?>">
                                    <span data-counter="counterup" data-value="" class="counter"><?= $stat['number'];?></span>
                                </h3>
                                <small><?= strtoupper($stat['text']);?></small>
                            </div>
                            <div class="icon">
                                <i class="<?= $stat['icon'];?>"></i>
                            </div>
                        </div>
                        <div class="progress-info">
                            <a href="<?= $stat['uri'];?>" class="btn btn-default btn-xs <?= $stat['font-color'];?>">View</a>
<!--                            <div class="progress">
                                <span style="width: 76%;" class="progress-bar progress-bar-success green-sharp">
                                    <span class="sr-only">76% progress</span>
                                </span>
                            </div>
                            <div class="status">
                                <div class="status-title"> progress </div>
                                <div class="status-number"> 76% </div>
                            </div>-->
                        </div>
                    </div>
                </div>
            <?php
        }
    }
    ?>
</div>
