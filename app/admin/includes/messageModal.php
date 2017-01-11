<script type="text/javascript">
    $(document).ready(function() {
        $('.update-message').click(function(ev) {
            ev.preventDefault();
            //console.log(message_id);
            var data = {
                message_id : $(this).parent().data('id'),
                update : true,
                notes : $('.eurodeliMessageText').val()
            }
            console.log(data);

            $.post( "../../core/mail/process-message.php", data)
            .done(function( resonse ) {
                console.log(resonse);
                var resonse = JSON.parse(resonse);
                if(resonse.success) {
                    var location = 'cms.php?page=messages&message_id=' + data.message_id;
                    window.location = location;
                }
            });
            /*var data = {
                'id' : 2,
                'get_history' : true
            }
            $.post( "../../core/mail/process-message.php", data)
            .done(function( data ) {
                console.log(data);
                // var location = 'cms.php?page=messages&message_id=' + message_id;
                // window.location = location;
            });*/
        })
    })
</script>

<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:90%;min-width: 1000px">
        <div class="modal-content">
            <div class="modal-body" id="messageModalBody">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
                </button>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6" style="height:50px">
                            <p style="font-size:20px" id="messageModalLabel">Message Nr: 001-<span class="messageNumber"></span></p>
                        </div>
                        
                    </div>

                    <div class="col-md-8">
                        <div class="col-md-12">
                            <h4>Client:</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="col-md-2 messageTitles">
                                    <p class="messageNameTitle">
                                        Name:
                                    </p>
                                </div>
                                <div class="col-md-10 messageTexts">
                                    <p class="messageNameText">
                                    </p>
                                </div>    
                            </div>
                            
                            <div class="col-md-12">
                                <div class="col-md-2 messageTitles">
                                    <p class="messagePhoneTitle">
                                        Tlf:
                                    </p>
                                </div>
                                <div class="col-md-10 messageTexts">
                                    <p class="messagePhoneText">
                                    </p>
                                </div>    
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-2 messageTitles">
                                    <p class="messageEmailTitle">
                                        Email:
                                    </p>
                                </div>
                                <div class="col-md-10 messageTexts">
                                    <p class="messageEmailText">
                                    </p>
                                </div>    
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="col-md-4 messageTitles">
                                    <p class="messageNewsletterTitle">
                                        Spam:
                                    </p>
                                </div>
                                <div class="col-md-8 messageTexts">
                                    <p class="messageNewsletterText">
                                    </p>
                                </div>    
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-4 messageTitles">
                                    <p class="messageAddressTitle">
                                        Country:
                                    </p>
                                </div>
                                <div class="col-md-8 messageTexts">
                                    <p class="messageAddressText">
                                    </p>
                                </div>    
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-4 messageTitles">
                                    <p class="messageShopTitle">
                                        Shop:
                                    </p>
                                </div>
                                <div class="col-md-8 messageTexts">
                                    <p class="messageShopText">
                                    </p>
                                </div>    
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-4 messageTitles">
                                    <p class="messageImageTitle">
                                        Image:
                                    </p>
                                </div>
                                <div class="col-md-8 messageTexts">
                                    <p class="messageImageText">
                                    </p>
                                </div>    
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-12 control-message" data-id style="height:50px" >
                              <?php if ($user['type'] === 1) {
                                $sendToHtml = '
                                
                                <button type="button" class="btn btn-success update-message pull-right">
                                    Update
                                </button>
                            ';
                                echo $sendToHtml;
                              } 
                              ?>
                            
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-8">

                            <h4>
                                Message:
                            </h4>
                            <p class="messageNotesText"  style="
                            border: 1px solid rgb(51, 122, 183);
                            outline: none;
                            border-radius: 4px;
                            width: 100%;
                            padding: 5px;
                            margin-top: 0px;
                            margin-bottom: 0px;
                            min-height: 124px;
                            ">
                            </p>
                        </div>
                        <div class="col-md-4">
                            <h4>Eurodeli:
                            </h4>
                            <textarea class="eurodeliMessageText" name="eurodeliMessageText" style="
                            border: 1px solid rgb(51, 122, 183);
                            outline: none;
                            border-radius: 4px;
                            width: 100%;
                            padding: 5px;
                            margin-top: 0px;
                            margin-bottom: 0px;
                            min-height: 124px;
                            "></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <h4>History:</h4>
                            <ul class="messageHistory list-group">
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>