<?php
// get all promotions
$stmt = $db->prepare('SELECT * FROM messages ORDER BY created DESC');
$stmt->execute();

$messages = array();
while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
    if (strlen($row['image_link']) > 0 ) {
        $row['image_link'] = '<a href="' . $row['image_link'] . '" target="_blank"><img style="width: 40px;" src="' . $row['image_link'] . '" alt="" /></a>';
    }

    $row['st'] = $row['status'];
    if ($row['status'] == 0) {
        $row['status'] = "New";
    } else {
        $row['status'] = "Answered";
    }
    $messageUser = json_decode($row['user']);
    if (isSet($messageUser->name)) {
        $row['owner'] = $messageUser->name;
    }
    $row['history'] = getHistory($db, ['table'=>'messages', 'item_id'=>$row['id']]);
    $messages[] = $row;
}


$theMessage = array();
if (isset($_GET['message_id']) && intval($_GET['message_id']) > 0) {
    foreach($messages as $message) {
        if ($message['id'] == $_GET['message_id']) {
            $theMessage = $message;
        }
    }
}
?>
<script>
var messagesData = <?php echo json_encode($messages); ?>;
var message = <?php echo json_encode($theMessage); ?>;
$(document).ready(function() {
    if (message.length != 0) {
        setMessageModalData(message);
        $('#messageModal').modal('show');
    }  
})
function setMessageModalData(data) {
    console.log(data);
    var messageHistory = data.history;

    var historyText = "";
    $('.messageHistory').text("");
    if (messageHistory.length > 0) {
        messageHistory.map((action, id) => {
            theD = JSON.parse(action.data);
            var aa = "<li class='list-group-item'><div class='row'><div class='col-md-2'><p>"+action.username+"</p></div><div class='col-md-6'><p>"+theD.response + "</p></div><div class='col-md-2'><p>"+action.email_sent+"</p></div><div class='col-md-2'><p>"+action.created+"</p></div></div></li>";
            $('.messageHistory').append(aa);

        })
    }

    $('#messageModal').on('show.bs.modal', function (event) {
        var modal = $(this);

        modal.find('.messageNumber').text("");
        modal.find('.messageNameText').text("");
        modal.find('.messageAddressText').text("");
        modal.find('.messagePhoneText').text("");
        modal.find('.messageEmailText').text("");
        modal.find('.messageNotesText').text("");
        modal.find('.messageShopText').text("");
        modal.find('.messageNewsletterText').text("");
        modal.find('.messageImageText').text("");

        modal.find('.messageNumber').text(data.id);
        modal.find('.messageNameText').text(data.name);
        modal.find('.messageAddressText').text(data.country);
        modal.find('.messagePhoneText').text(data.phone);
        modal.find('.messageEmailText').text(data.email);
        modal.find('.messageNotesText').text(data.message);
        modal.find('.messageShopText').text(data.shop);
        modal.find('.messageNewsletterText').text(data.newsletter);
        modal.find('.messageImageText').append(data.image_link);
        modal.find('.control-message').data('id' , data.id);



       /* var dataHref = '/app/admin/cms.php?remove=true&what=order&id='+data.order.number;
        $('#deleteOrder').attr('data-href',dataHref);
        var adminEditItemsHref = 'http://eurodeli.dk/admin-order.php?orderId='+data.order.number;
        $('.admin-edit-items').attr('href',adminEditItemsHref);
        console.log($('#deleteOrder').data('href')); 

    
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
        }*/



    })
}

$(function () {
    $('#messagesTable').bootstrapTable({
        data: messagesData,
        onClickRow: function(row, $element) {
            setMessageModalData(row);
            $('#messageModal').modal('show');
        }
    });

    $(".mybtn-top").click(function () {
        $('#messagesTable').bootstrapTable('scrollTo', 0);
    });
    
    $(".mybtn-btm").click(function () {
        $('#messagesTable').bootstrapTable('scrollTo', 'bottom');
    });

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
<div style="">
    <table id="messagesTable" data-search="true" data-show-columns="true" data-pagination="true" data-height="250">
        <thead>
            <tr>
                <th data-field="status" data-sortable="true">Status</th>
                <th data-field="name" data-sortable="true">Name</th>
                <th data-field="image_link" data-sortable="false">Image</th>
                <th data-field="email" data-sortable="true">email</th>
                <th data-field="country" data-sortable="true">Country</th>
                <th data-field="owner" data-sortable="true">Owner</th>
                <th data-field="created" data-sortable="true">Date In</th>
                <th data-field="finished_at" data-sortable="true">Date Out</th>
            </tr>
        </thead>
    </table>
</div>