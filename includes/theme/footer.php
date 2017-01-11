<style>
.pre-terms-text {
    white-space: pre-wrap;       /* Since CSS 2.1 */
    white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
    white-space: -pre-wrap;      /* Opera 4-6 */
    white-space: -o-pre-wrap;    /* Opera 7 */
    word-wrap: break-word;
    word-break: initial !important;
    background-color: transparent;
    color:inherit;
    font-family: inherit;
    border: none;
}
</style>
<!-- Footer -->
<footer class="text-center">
	<div class="footer-above">
		<div class="container">
			<div class="row">
				<div class="footer-col col-md-2 col-xs-12">
					<h3><?= $texts['Footer.locations.title']; ?></h3>
					<div class="home-shops">
						<a href="#shop_2">
							<?= $texts['Magazin2.title']; ?>
						</a><br/>
						<a href="#shop_1">
							<?= $texts['Magazin1.homepage']; ?>
						</a><br/> 
						<a href="#shop_3">
							<?= $texts['Magazin3.title']; ?>
						</a><br/>
						<a href="#shop_4">
							<?= $texts['Magazin4.title']; ?>
						</a>
					</div>
				</div>
				<div class="footer-col col-md-8 col-xs-12">
					<h3><?= $texts['Footer.facebook.title']; ?></h3>
<!-- 					<p>
						<a href="<?= $texts['Facebook.Main.Link']; ?>" target="_blank" class="">
            				<img src="images/fb.png" id="fb-icon" alt="" /> <?= $texts['Facebook.Main.Text']; ?>
						</a>
					</p>
 -->
					<div class="col-md-6" style="text-align: left">
						<p>
							<a href="<?= $texts['Facebook1.Link']; ?>" target="_blank" class="">
	            				<img src="images/fb.png" id="fb-icon" alt="" /> <?= $texts['Facebook1.Text']; ?>
							</a>
						</p>
						<p>
							<a href="<?= $texts['Facebook2.Link']; ?>" target="_blank" class="">
	            				<img src="images/fb.png" id="fb-icon" alt="" /> <?= $texts['Facebook2.Text']; ?>
							</a>
						</p>
						<p>
							<a href="<?= $texts['Facebook3.Link']; ?>" target="_blank" class="">
	            				<img src="images/fb.png" id="fb-icon" alt="" /> <?= $texts['Facebook3.Text']; ?>
							</a>
						</p>
						<p>
							<a href="<?= $texts['Facebook4.Link']; ?>" target="_blank" class="">
	            				<img src="images/fb.png" id="fb-icon" alt="" /> <?= $texts['Facebook4.Text']; ?>
							</a>
						</p>
					</div>
					<div class="col-md-6" style="text-align: left">
						<p>
							<a href="<?= $texts['Facebook5.Link']; ?>" target="_blank" class="">
	            				<img src="images/fb.png" id="fb-icon" alt="" /> <?= $texts['Facebook5.Text']; ?>
							</a>
						</p>
						<p>
							<a href="<?= $texts['Facebook6.Link']; ?>" target="_blank" class="">
	            				<img src="images/fb.png" id="fb-icon" alt="" /> <?= $texts['Facebook6.Text']; ?>
							</a>
						</p>
						<p>
							<a href="<?= $texts['Facebook7.Link']; ?>" target="_blank" class="">
	            				<img src="images/fb.png" id="fb-icon" alt="" /> <?= $texts['Facebook7.Text']; ?>
							</a>
						</p>
						<p><!-- 
							<a href="<?= $texts['Facebook8.Link']; ?>" target="_blank" class="">
	            				<img src="images/fb.png" id="fb-icon" alt="" /> <?= $texts['Facebook8.Text']; ?>
							</a> -->
						</p>
					</div>
				</div>
				<div class="footer-col col-md-2 col-xs-12">
					<h3><?= $texts['Footer.company.title']; ?></h3>
					<p><?= $texts['Footer.company.text']; ?></p>
					<br/>
					<h3 data-toggle="modal" style="cursor: pointer;" data-target="#termsAndConditions"><?= $texts['Footer.TermsLink']; ?></h3>
				</div>
			</div>
			<div class="row">
				<p>
					Copyright &copy; SBB 2016
				</p>
			</div>
		</div>
	</div>
</footer>

<!-- Terms And Conditions Modal -->
<div class="modal fade" id="termsAndConditions" tabindex="-1" role="dialog" aria-labelledby="termsAndConditionsLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h2 class="modal-title" id="termsAndConditionsLabel"><?= $texts['Terms.Title']?></h2>
      </div>
      <div class="modal-body">
      	<pre class="pre-terms-text">
      		<?= $texts['Terms.Text']?>
  		</pre>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
