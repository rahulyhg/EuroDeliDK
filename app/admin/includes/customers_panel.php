<?php
// get all promotions
$stmt = $db->prepare('SELECT * FROM pricelist_subscribers ORDER BY created DESC');
$stmt->execute();

$customers = array();
while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
    $customers[] = $row;
}
?>
<script>
var customersData = <?php echo json_encode($customers); ?>

$(function () {
    $('#customersTable').bootstrapTable({
        data: customersData,
        pageSize: 25,
        pageList: 'All'
    });

    $(".mybtn-top").click(function () {
        $('#customersTable').bootstrapTable('scrollTo', 0);
    });
    
    $(".mybtn-btm").click(function () {
        $('#customersTable').bootstrapTable('scrollTo', 'bottom');
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
    <table id="customersTable" data-search="true" data-show-columns="true" data-pagination="true" data-height="250">
        <thead>
            <tr>
                <th data-field="email" data-sortable="true">email</th>
                <th data-field="send_newsletter" data-sortable="true">Newsletter</th>
                <th data-field="shop" data-sortable="true">Shop</th>
                <th data-field="country" data-sortable="true">Country</th>
                <th data-field="created" data-sortable="true">Date</th>
            </tr>
        </thead>
    </table>
</div>