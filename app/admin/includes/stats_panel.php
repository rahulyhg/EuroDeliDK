<div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" style="color:black" href="#collapse1">Statistics</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body"><div class="row">
 <div class="col-lg-12" style="text-align: center">
 <h2 style="margin-bottom:30px">
     <? echo date('F Y'); ?>
 </h2>
     <div class="col-md-2 col-xs-4 col-xs-4 report-item pending col-md-offset-1">

        <i class="material-icons" style="margin-left:20px">&#xE854;</i>
        <span class="counter" data-type="pending" data-type="pending"><?= $ordersCountThisMonth[0]+$ordersCountThisMonth[10] ?></span>
        <h4>New & Open
        </h4>
    </div>

     <div class="col-md-2 col-xs-4 report-item canceled">
        <i class="material-icons" style="margin-left:20px">&#xE5C9;</i>
        <span class="counter" data-type="canceled"><?= $ordersCountThisMonth[90] ?></span>
        <h4>Canceled
        </h4>
     </div>
     <div class="col-md-2 col-xs-4 report-item done">
        <i class="material-icons" style="margin-left:20px">&#xE924;</i>
        <span class="counter" data-type="done"><?= $ordersCountThisMonth[50] ?></span>
        <h4>Ready
        </h4>
     </div>
     <div class="col-md-2 col-xs-4 report-item pending">
        <i class="material-icons" style="margin-left:20px">&#xE86C;</i>
        <span class="counter" data-type="done"><?= $ordersCountThisMonth[60] ?></span>
        <h4> Delivered
        </h4>
     </div>
     <div class="col-md-2 col-xs-4 report-item revenue col-md-offset-1">
        <!-- <i class="material-icons" style="color: #FFC107;">&#xE263;</i> -->
        <i class="material-icons" style="color: #FFC107;">&#xE227;</i>
        <h4 style="margin-top:15px;">Revenue This Month
        <h3 style="font-weight: 700;"><?= $revenueThisMonth; ?> DKK</h3>
        </h4>
     </div>
 </div>
 </div>


 <!-- TOTAL STATS -->
<div class="row">
 <div class="col-md-12" style="text-align: center">
 <h2 style="margin-bottom:30px">
     Totals
 </h2>
     <div class="col-md-2 col-xs-4 report-item pending col-md-offset-1">

        <i class="material-icons" style="margin-left:20px">&#xE854;</i>
        <span class="counter" data-type="pending"><?= $ordersCount[0]+$ordersCount[10] ?></span>
        <h4>New & Open
        </h4>
    </div>

     <div class="col-md-2 col-xs-4 report-item canceled">
        <i class="material-icons" style="margin-left:20px">&#xE5C9;</i>
        <span class="counter" data-type="canceled"><?= $ordersCount[90] ?></span>
        <h4>Canceled
        </h4>
     </div>
     <div class="col-md-2 col-xs-4 report-item done">
        <i class="material-icons" style="margin-left:20px">&#xE924;</i>
        <span class="counter" data-type="done"><?= $ordersCount[50] ?></span>
        <h4>Ready
        </h4>
     </div>
     <div class="col-md-2 col-xs-4 report-item pending">
        <i class="material-icons" style="margin-left:20px">&#xE86C;</i>
        <span class="counter" data-type="done"><?= $ordersCount[60] ?></span>
        <h4>Delivered
        </h4>
     </div>
     <div class="col-md-2 col-xs-4 report-item revenue col-md-offset-1">
        <!-- <i class="material-icons">&#xE263;</i> -->
        <i class="material-icons" style="color: #FFC107;">&#xE227;</i>
        <h4 style="margin-top:15px;">Revenue
        <h3 style="font-weight: 700;"><?= $revenue; ?> DKK</h3>
        </h4>
     </div>
 </div>
</div>
</div>
      </div>
    </div>
</div>
