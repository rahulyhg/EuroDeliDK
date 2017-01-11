<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:90%;min-width: 1000px">
        <div class="modal-content">
            <div class="modal-body" id="orderModalBody">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
                </button>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-xs-6" style="height:50px">
                            <p style="font-size:20px" id="orderModalLabel">Order Nr: 001-<span class="orderNumber"></span></p>
                        </div>
                        <div class="col-xs-6 control-order" data-id style="height:50px" >
                              <?php if ($user['type'] === 1) {
                              	$sendToHtml = '
                              	<a href="" class="btn admin-edit-items" style="background-color:#c0c0c0;color:white"><i class="material-icons">&#xE85D;</i></a>
                            	<span class="dropdown open">
                              	<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Send To:
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item btn send-to-shop" data-shop="Aaboulevard" style="color:black; margin-left:20px" href="#">Aaboulevard</a>
                                <br/>
                                <a class="dropdown-item btn send-to-shop" data-shop="Taastrup" style="color:black; margin-left:20px" href="#">Taastrup</a>
                                <br/>
                                <a class="dropdown-item btn send-to-shop" data-shop="Odense" style="color:black; margin-left:20px" href="#">Odense</a>
                                <br/>
                                <a class="dropdown-item btn send-to-shop" data-shop="Ikast" style="color:black; margin-left:20px" href="#">Ikast</a>
                              </div>
                            </span>
							';
								echo $sendToHtml;
                              } 
                              ?>
                              
                            <button type="button" class="btn btn-danger start-order">
                                Start
                            </button>
                            
                            <button type="button" class="btn btn-warning update-order">
                                Update Order
                            </button>
                            <button type="button" class="btn btn-success finish-order">
                                Ready
                            </button>
                            <button type="button" class="btn btn-success deliver-order">
                                Delivered
                            </button>
                            <button type="button" class="btn btn-primary print-order" onclick="clickPrint()">
                                Print
                            </button>
                            <button type="button" class="btn btn-primary cancel-order">
                                Cancel
                            </button>
                            <?php if ($user['type'] === 1) {
                              	$btnDel = '<button type="button" class="btn btn-danger" id="deleteOrder" data-placement="right" data-toggle="confirmation" data-href="">
                                <i class="fa fa-trash-o"></i>
                            </button>';
								echo $btnDel;
                            } 
                            ?>
                            
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="col-xs-6" style="">
                            <h4>Client:</h4>
                            <div class="col-xs-12">
                                <div class="col-xs-3 orderTitles">
                                    <p class="orderNameTitle">
                                        Name:
                                    </p>
                                </div>
                                <div class="col-xs-8 orderTexts">
                                    <p class="orderNameText">
                                    </p>
                                </div>    
                            </div>
                            
                            <div class="col-xs-12">
                                <div class="col-xs-3 orderTitles">
                                    <p class="orderAddressTitle">
                                        Address:
                                    </p>
                                </div>
                                <div class="col-xs-8 orderTexts">
                                    <p class="orderAddressText">
                                    </p>
                                </div>    
                            </div>

                            <div class="col-xs-12">
                                <div class="col-xs-3 orderTitles">
                                    <p class="orderPhoneTitle">
                                        Tlf:
                                    </p>
                                </div>
                                <div class="col-xs-8 orderTexts">
                                    <p class="orderPhoneText">
                                    </p>
                                </div>    
                            </div>

                            <div class="col-xs-12">
                                <div class="col-xs-3 orderTitles">
                                    <p class="orderEmailTitle">
                                        Email:
                                    </p>
                                </div>
                                <div class="col-xs-8 orderTexts">
                                    <p class="orderEmailText">
                                    </p>
                                </div>    
                            </div>

                            <div class="col-xs-12">
                                <div class="col-xs-3 orderTitles">
                                    <p class="orderNotesTitle">
                                        Notes:
                                    </p>
                                </div>
                                <div class="col-xs-8 orderTexts">
                                    <p class="orderNotesText">
                                    </p>
                                </div>    
                            </div>
                        </div>
                        <div class="col-xs-6" style="">
                            <h4>EuroDeli:</h4>
                            <div class="col-xs-12">
                                <div class="col-xs-3 orderTitles">
                                    <p class="eurodeliCVRTitle">
                                        CVR:
                                    </p>
                                </div>
                                <div class="col-xs-8 orderTexts">
                                    <p class="eurodeliCVRText">
                                        1342564652
                                    </p>
                                </div>    
                            </div>
                            
                            <div class="col-xs-12">
                                <div class="col-xs-3 orderTitles">
                                    <p class="eurodeliAddressTitle">
                                        Address:
                                    </p>
                                </div>
                                <div class="col-xs-8 orderTexts">
                                    <p class="eurodeliAddressText">
                                        <?= $texts['Magazin2.address1']?>
                                        <br/>
                                        <?= $texts['Magazin2.address2']?>
                                    </p>
                                </div>    
                            </div>

                            <div class="col-xs-12">
                                <div class="col-xs-3 orderTitles">
                                    <p class="eurodeliPhoneTitle">
                                        Tlf:
                                    </p>
                                </div>
                                <div class="col-xs-8 orderTexts">
                                    <p class="eurodeliPhoneText">
                                        <?= $texts['Magazin2.telephone']?>
                                    </p>
                                </div>    
                            </div>

                            <div class="col-xs-12">
                                <div class="col-xs-3 orderTitles">
                                    <p class="eurodeliNotesTitle">
                                        Notes:
                                    </p>
                                </div>
                                <div class="col-xs-8 orderTexts">
                                    <textarea class="eurodeliNotesText" name="eurodeliNotesText" style="
                                    border: 1px solid rgb(51, 122, 183);
                                    outline: none;
                                    border-radius: 4px;
                                    width: 100%;
                                    padding: 5px;
                                    margin-top: 0px;
                                    margin-bottom: 0px;
                                    height: 124px;
                                    "></textarea>
                                </div>    
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="col-xs-6" style=" height:50px;">
                            <h4>Items: <span class="orderItemsCount"></h4>
                        </div>
                        <div class="col-xs-6" style=" height:50px;">
                            <h4 style="text-align: right">Total Price: <input style="width:50px" type="text" class="orderPrice">DKK</h4>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <table id="orderProducts" class="table" style="text-align: center">
                        <tbody>
                        </tbody>
                        </table>
                    </div>
                    <div class="col-xs-12">
                        <p>
                        &nbsp;
                        </p>
                    </div>
                </div>
                <div class="col-md-12">
                    <h4>History:</h4>
                    <ul class="orderHistory list-group">
                        
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>