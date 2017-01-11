<?php
// get all promotions

/*$stmt = $db->prepare('SELECT * FROM orders ORDER BY created DESC');
$stmt->execute();
*/
$orders = array();
$ordersThisMonth = array();
$statuses = array(
    0 => 'New',
    10 => 'Open',
    50 => 'Ready',
    60 => 'Delivered',
    90 => 'Canceled',
);


$statusStyle = array(
    0 => 'font-weight:bold;color:#4CAF50',
    10 => 'color:#2196F3',
    50 => 'color:#4c53a',
    60 => 'color:#4c53a !important;',
    90 => 'color:#F44336',
);


$reportStatusColors = array(
    0 => '#4CAF50',
    10 => '#2196F3',
    50 => '#4c53a2',
    60 => '#4c53a2',
    90 => '#F44336',
);

$reportStatusColorsRGBA = array(
    0 => 'rgba(76,175,80,0.2)',
    10 => 'rgba(33,150,243,0.2);',
    50 => 'rgba(76, 83, 162, 0.2);',
    60 => 'rgba(76,83,162,0.2);',
    90 => 'rgba(244,67,54,0.2);',
);





$ordersCount = [
    0 => 0,
    10 => 0,
    50 => 0,
    60 => 0,
    90 => 0,
];
$revenue = 0;

$ordersCountThisMonth = [
    0 => 0,
    10 => 0,
    50 => 0,
    60 => 0,
    90 => 0,
];
$revenueThisMonth = 0;

$currentMonthNumber = date('m');

$query = 'SELECT * FROM orders ORDER BY created DESC';
$sql = $db->prepare($query);
$sql->execute();
$ordersContent =  $sql->fetchAll(PDO::FETCH_ASSOC);

$products = [];
foreach($ordersContent as $row) {
    if ($user['type'] != 1) {
        if ($row['shop'] !== $user['name']) {
            continue;
        }
    }
/*    if (isSet($_GET['test'])) {
        var_dump($row);
    }*/

    $order = $row;
    $order['st'] = "<span style='" . $statusStyle[$order['status']] ."'>" . $statuses[$order['status']] . "</span>";
    
    $orderDate =  DateTime::createFromFormat('Y-m-d H:i:s', $order['created']);

    $ordersCount[$order['status']]++;
    if ($orderDate->format('m') == $currentMonthNumber) {
        $ordersCountThisMonth[$order['status']]++;
    }

    if (in_array($order['status'], [60])) {
        $revenue += $order['price'];

        if ($orderDate->format('m') == $currentMonthNumber) {
            $revenueThisMonth += $order['price'];
            $ordersThisMonth[] = $order;
        }
    }


    $order['status'] = $statuses[$order['status']];
    $orderUser = json_decode($order['user']);
    if (isSet($orderUser->name)) {
        $order['owner'] = $orderUser->name;
    }

    $order['history'] = getHistory($db, ['table'=>'orders', 'item_id'=>$order['id']]);

    
    $order['delete'] = '<button type="button" class="btn btn-danger" data-toggle="confirmation" data-href=' . $web_self . '/?remove=true&what=order&id=' . $order['id'] . '>
                        <i class="fa fa-trash-o"></i>
                    </button>';
    $orders[] = $order;

    $pr = json_decode($order['details']);
/*
    foreach($pr as $p) {
        if 
    }
*/
}

$theOrder = array();
if (isset($_GET['order_id']) && intval($_GET['order_id']) > 0) {
    foreach($orders as $order) {
        if ($order['id'] == $_GET['order_id']) {
            $theOrder = $order;
        }
    }
}

?>
<style type="text/css">
    #ordersTable  td {
        cursor: pointer;
    }
    #ordersModal {
        overflow-y: auto;
    }

    .orderTitles {
        text-align: right    
    }

    .orderTitles {

    }




@media screen {
  #printSection {
      display: none;
  }
}

@media print {
  body * {
    visibility:hidden;
  }
  #printSection, #printSection * {
    visibility:visible;
  }
  #printSection .control-order, .eurodeliNotesText {
    visibility:hidden;
    display:none;
  }
  #printSection {
    position:absolute;
    left:0;
    top:0;
  }
}
</style>
<script>

function clickPrint() {
    printElement(document.getElementById('orderModalBody'), false, "<hr />");
    window.print();
}

function printElement(elem, append, delimiter) {
    var domClone = elem.cloneNode(true);

    var $printSection = document.getElementById("printSection");

    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }

    if (append !== true) {
        $printSection.innerHTML = "";
    }

    else if (append === true) {
        if (typeof(delimiter) === "string") {
            $printSection.innerHTML += delimiter;
        }
        else if (typeof(delimiter) === "object") {
            $printSection.appendChlid(delimiter);
        }
    }

    $printSection.appendChild(domClone);
}

var ordersData = <?php echo json_encode($orders); ?>;
var ordersThisMonthData = <?php echo json_encode($orders); ?>;
var order = <?php echo json_encode($theOrder); ?>;



    function sendEmail(to, text) {
        var settings = {
          "async": true,
          "crossDomain": true,
          "url": "https://api.mailgun.net/v3/sandboxdac28cb0fc314e639edd4cd3804fd616.mailgun.org/messages",
          "method": "POST",
          "headers": {
            "authorization": "Basic YXBpOmtleS04M2JkMTEwYzNiOGMyODM2Yzc1NmViMjZmNGMxODNhZQ==",
            "content-type": "application/x-www-form-urlencoded",
            "Access-Control-Allow-Origin" : "*",
            "Access-Control-Allow-Methods" : "GET,POST,PUT,DELETE,OPTIONS",
            "Access-Control-Allow-Headers": "Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Headers, Authorization, X-Requested-With"
          },
          "data": {
            "from": "postmaster@sandboxdac28cb0fc314e639edd4cd3804fd616.mailgun.org",
            "to": to,
            "subject": "New Email",
            "text": text
          }
        }

        $.ajax(settings).done(function (response) {
          console.log(response);
        });
    }
$(function () {

    $('.start-order').click(function(ev) {
        ev.preventDefault();
        var order_id = $(this).parent().data('id');
        console.log(order_id);

        var data = {
            order_id : order_id,
            start : true
        }

        $.post( "../../core/mail/process-order.php", data)
        .done(function( data ) {
            var location = 'cms.php?page=orders&order_id=' + order_id;
            window.location = location;
        });
    })


   $('.update-order').click(function(ev) {
        ev.preventDefault();
        var order_id = $(this).parent().data('id');
        console.log(order_id);

        var data = {
            order_id : order_id,
            update : true,
            price : $('.orderPrice').val(),
            notes : $('.eurodeliNotesText').val()
        }

        $.post( "../../core/mail/process-order.php", data)
        .done(function( response ) {
            var response = JSON.parse(response);
            if (response.success) {
                var location = 'cms.php?page=orders&order_id=' + order_id;
                window.location = location;
            } else {
                alert('Coulnd update at the moment, refresh the page please');
            }
        });
    })

   $('.finish-order').click(function(ev) {
        ev.preventDefault();
        var order_id = $(this).parent().data('id');
        console.log(order_id);

        var data = {
            order_id : order_id,
            finish : true
        }

        $.post( "../../core/mail/process-order.php", data)
        .done(function( data ) {
            var location = 'cms.php?page=orders&order_id=' + order_id;
            window.location = location;
        });
    })

    $('.deliver-order').click(function(ev) {
        ev.preventDefault();
        var order_id = $(this).parent().data('id');
        console.log(order_id);

        var data = {
            order_id : order_id,
            deliver : true
        }

        $.post( "../../core/mail/process-order.php", data)
        .done(function( data ) {
            var location = 'cms.php?page=orders&order_id=' + order_id;
            window.location = location;
        });
    })

    $('.cancel-order').click(function(ev) {
        ev.preventDefault();
        var order_id = $(this).parent().data('id');
        console.log(order_id);

        var data = {
            order_id : order_id,
            cancel : true
        }

        $.post( "../../core/mail/process-order.php", data)
        .done(function( data ) {
            var location = 'cms.php?page=orders&order_id=' + order_id;
            window.location = location;
        });
    })
    $('.send-to-shop').click(function(ev) {
        ev.preventDefault();
        var order_id = $(".control-order").data('id');
        var shop = $(this).data('shop');

        var data = {
            order_id : order_id,
            shop : shop
        }

        $.post( "../../core/mail/process-order.php", data)
        .done(function( data ) {
            console.log(data);
            var location = 'cms.php?page=orders&order_id=' + order_id;
            window.location = location;
        });
    })






    $(document).ready(function() {
      if (order.length != 0) {
        var data = {
            products : order.details,
        };
        data.order = {
            name : order.name,
            number : order.id,
            address : order.address,
            phone : order.phone,
            email : order.email,
            notes : order.message,
            price : order.price,
            history : order.history,
            status : order.status,
            eurodeliNotes : order.notes
        }
        setOrderModalProductsData(data);
        $('#orderModal').modal('show');
    }  
    })

    function updateOrder() {
        var data = {
            order_id : id,

        }
    }


    function setOrderModalProductsData(data) {
        console.log(data);

        var orderHistory = data.order.history;

        var historyText = "";
        $('.orderHistory').text("");
        if (orderHistory.length > 0) {
            orderHistory.map((action, id) => {
                theD = JSON.parse(action.data);
                console.log(theD.notes);
                if (theD.status == 10) {
                    theD.status = "Updated Order";
                } else if (theD.status == 50) {
                    theD.status = "Order Collected";
                } else if (theD.status == 60) {
                    theD.status = "Order Delivered";
                } else if (theD.status == 90) {
                    theD.status = "Order Canceled";
                } else {
                    theD.status = "New Order";
                }
                var aa = "<li class='list-group-item'><div class='row'><div class='col-md-2'><p>"+action.username+"</p></div><div class='col-md-3'><p>"+theD.notes + "</p></div><div class='col-md-2'><p>"+theD.status+"</p></div><div class='col-md-2'><p>"+action.email_sent+"</p></div><div class='col-md-2'><p>"+action.created+"</p></div></div></li>";
                $('.orderHistory').append(aa);

            })
        }

        $('#orderModal').on('show.bs.modal', function (event) {
            var modal = $(this);

            var products = JSON.parse(data.products);
            console.log(products);
            totalItems = products.length;
            totalPrice = data.order.price;
            $('#orderProducts tbody').text('');
            $.each(products, function(i, p) {
                $('#orderProducts tbody').append(
                    '<tr><td class="col-md-2">' + p.company + '</td><td class="col-md-3">' + p.name + '</td><td class="col-md-2">' + p.amount + '</td><td class="col-md-2">' + p.ean + '</td><td class="col-md-1">' + p.quantity + '</td><td class="col-md-2">' + p.price + '</td></tr>')

            });

            modal.find('.orderNumber').text(data.order.number);
            modal.find('.orderItemsCount').text(totalItems);
            modal.find('.orderPrice').val(totalPrice);
            modal.find('.orderNameText').text(data.order.name);
            modal.find('.orderAddressText').text(data.order.address);
            modal.find('.orderPhoneText').text(data.order.phone);
            modal.find('.orderEmailText').text(data.order.email);
            modal.find('.orderNotesText').text(data.order.notes);
            var dataHref = '/app/admin/cms.php?remove=true&what=order&id='+data.order.number;
            $('#deleteOrder').attr('data-href',dataHref);
            var adminEditItemsHref = 'http://eurodeli.dk/admin-order.php?orderId='+data.order.number;
            $('.admin-edit-items').attr('href',adminEditItemsHref);
            console.log($('#deleteOrder').data('href')); 

            modal.find('.control-order').data('id' , data.order.number);
        
            modal.find('.start-order').show();
            modal.find('.update-order').show();
            modal.find('.deliver-order').show();
            modal.find('.finish-order').show();
            modal.find('.cancel-order').show();
            modal.find('.orderPrice').prop('disabled', true);
            modal.find('.eurodeliNotesText').prop('disabled', true);
            modal.find('.eurodeliNotesText').val(data.order.eurodeliNotes);
        
            if (data.order.status == "New") {
                modal.find('.update-order').hide();
                modal.find('.finish-order').hide();
                modal.find('.deliver-order').hide();
            } else if (data.order.status == "Open") {
                modal.find('.start-order').hide();
                modal.find('.deliver-order').hide();
                modal.find('.orderPrice').prop('disabled', false);
                modal.find('.eurodeliNotesText').prop('disabled', false);
            } else if (data.order.status == "Ready") {
                modal.find('.start-order').hide();
                modal.find('.update-order').hide();
                modal.find('.finish-order').hide();
                modal.find('.cancel-order').hide();
            } else if (data.order.status == "Delivered" || data.order.status == "Canceled") {
                modal.find('.start-order').hide();
                modal.find('.update-order').hide();
                modal.find('.deliver-order').hide();
                modal.find('.finish-order').hide();
                modal.find('.cancel-order').hide();
            }



        })
    }
    $('#ordersTable').bootstrapTable({
        data: ordersData,
        height: 'auto',
        onClickRow: function(row, $element) {
            var data = {
                products : row.details,
            };
            data.order = {
                name : row.name,
                number : row.id,
                address : row.address,
                phone : row.phone,
                email : row.email,
                history : row.history,
                notes : row.message,
                price : row.price,
                status : row.status,
                eurodeliNotes : row.notes
            }
            setOrderModalProductsData(data);
            $('#orderModal').modal('show');
        }
    });

    $(".mybtn-top").click(function () {
        $('#ordersTable').bootstrapTable('scrollTo', 0);
    });
    
    $(".mybtn-btm").click(function () {
        $('#ordersTable').bootstrapTable('scrollTo', 'bottom');
    });

    $('.filter-orders').click(function(ev) {
        $('.filter-orders').css({'font-weight': 'normal'});
        $(this).css({'font-weight': '600'});



        var filter = $(this).data("filter");
        if (filter === "reset") {
            $('#ordersTable').bootstrapTable('filterBy', '');
            //$('#ordersTable').bootstrapTable({data:ordersData});
        }
        else {
        $('#ordersTable').bootstrapTable('filterBy', {status: filter});
        }
        console.log(filter);
    
    })

});
</script>
<!-- 
<div class="form-inline">
    <button type="button" 
            class="btn btn-default mybtn-top">
        Scroll to top
    </button>
    <button type="button" 
            class="btn btn-default mybtn-btm">
        Scroll to bottom
    </button>
</div>
 -->
 <style>
 .report-item {/*
    background-color: #EEEEEE;
    border-radius: 3px;
    outline:4px solid white;
    color:white !important;*/
 }
 .report-item h4 {
    font-weight: 200;
 }
 .report-item i {
    font-size: 70px;
 }

 .pending i {
    color: <?= $reportStatusColors[0] ?>;
 }

 .canceled i {
    color: <?= $reportStatusColors[90] ?>;
 }

 .done i {
    color: <?= $reportStatusColors[60] ?>;
 }

 .revenue i {
    color: <?= $reportStatusColors[50] ?>;

 }
 .counter {
    position:relative;
    top:-10px;
    left:-26px;
    font-size:14px;
    border-radius: 50%;
    background-color: red;
    color:black;
    min-width:30px;
    min-height:20px;
    display: inline-block;
    background-color: white;
    border: 1px solid black;
    padding:3px;
 }

 </style>

<?php 
// if ($user['type'] == 1) {
    include('stats_panel.php');
// }
?>



 <div class="col-lg-12" style="text-align: right;">
    <button class="ed-button filter-orders" style="margin-left:10px; color: <?= $reportStatusColors['0']?>;" data-filter="New">
      New
    </button>
    <button class="ed-button filter-orders" style="margin-left:10px; color: <?= $reportStatusColors['10']?>;" data-filter="Open">
      Open
    </button>
    <button class="ed-button filter-orders" style="margin-left:10px; color: <?= $reportStatusColors['50']?>;" data-filter="Ready">
      Ready
    </button>
    <button class="ed-button filter-orders" style="margin-left:10px; color: <?= $reportStatusColors['60']?>;" data-filter="Delivered">
      Delivered
    </button>
    <button class="ed-button filter-orders" style="margin-left:10px; color: <?= $reportStatusColors['90']?>;" data-filter="Canceled">
      Canceled
    </button>
    <button class="ed-button filter-orders" style="margin-left:10px;color:black" data-filter="reset">
      Reset All
    </button>
 </div>
<div class="orders-table" style="">
    <table id="ordersTable" data-search="true" data-show-columns="true" data-pagination="true" data-height="250">
        <thead>
            <tr>
                <th data-field="st" data-sortable="true">Status</th>
                <th data-field="id" data-sortable="true">Nr</th>
                <th data-field="price" data-sortable="true">~Price</th>
                <th data-field="name" data-sortable="true">Name</th>
                <th data-field="address" data-sortable="true">Address</th>
                <th data-field="phone" data-sortable="true">Phone</th>
                <!-- <th data-field="message" data-sortable="true">Message</th> -->
                <th data-field="email" data-sortable="true">Email</th>
                <th data-field="owner" data-sortable="true">Operator</th>
                <th data-field="shop" data-sortable="true">Shop</th>
                <th data-field="created" data-sortable="true">Date In</th>
                <th data-field="finished_at" data-sortable="true">Date Out</th>
                <!-- <th data-field="delete" data-sortable="true">Delete</th> -->
            </tr>
        </thead>
    </table>
</div>
