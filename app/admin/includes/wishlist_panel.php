<?php
// get all promotions
$stmt = $db->prepare('SELECT * FROM messages WHERE type="wishlist" ORDER BY created DESC');
$stmt->execute();

$messages = array();
while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
    $messages[] = $row;
}
?>
<script>
var messagesData = <?php echo json_encode($messages); ?>

$(function () {
    $('#messagesTable').bootstrapTable({
        data: messagesData
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
                <th data-field="name" data-sortable="true">Name</th>
                <th data-field="email" data-sortable="true">email</th>
                <th data-field="phone" data-sortable="true">phone</th>
                <th data-field="to" data-sortable="true">to</th>
                <th data-field="message" data-sortable="true">message</th>
                <th data-field="newsletter" data-sortable="true">Newsletter</th>
                <th data-field="shop" data-sortable="true">Shop</th>
                <th data-field="country" data-sortable="true">Country</th>
                <th data-field="created" data-sortable="true">Date</th>
            </tr>
        </thead>
    </table>
</div>