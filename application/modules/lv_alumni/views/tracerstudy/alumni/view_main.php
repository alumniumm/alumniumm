	<?php $this->load->view('themes/alumni/header'); ?>
	<?php $this->load->view('themes/alumni/sidebar'); ?>
		<div class="page animsition" style="animation-duration: 800ms; opacity: 1;">
		    <div class="page-header">
		      <h1 class="page-title">Kelola <i>Tracer Study</i> Alumni</h1>
		      <ol class="breadcrumb">
		        <li><a href="javascript:void(0)">Alumni</a></li>
		        <li><a href="javascript:void(0)">Karir</a></li>
		        <li class="active">Data Karir Alumni</li>
		      </ol>
		      <div class="page-header-actions">
		        <a class="btn btn-sm btn-primary btn-round waves-effect waves-light waves-round" href="<?php echo base_url()?>" target="_blank">
		          <i class="icon md-link" aria-hidden="true"></i>
		          <span class="hidden-xs">Aluminium</span>
		        </a>
		      </div>
		    </div>
			<div class="page-content">	
			  <!-- Panel Wizard Form Container -->
	          <div class="panel" id="exampleWizardFormContainer">
	            <div class="panel-heading">
	              <h3 class="panel-title">Pearls Steps</h3>
	            </div>
	            <div class="panel-body">
	              <!-- Steps -->
	              <div class="pearls row">
	                <div class="pearl current col-xs-4">
	                  <div class="pearl-icon"><i class="icon md-account" aria-hidden="true"></i></div>
	                  <span class="pearl-title">Account Info</span>
	                </div>
	                <div class="pearl col-xs-4">
	                  <div class="pearl-icon"><i class="icon md-card" aria-hidden="true"></i></div>
	                  <span class="pearl-title">Billing Info</span>
	                </div>
	                <div class="pearl col-xs-4">
	                  <div class="pearl-icon"><i class="icon md-check" aria-hidden="true"></i></div>
	                  <span class="pearl-title">Confirmation</span>
	                </div>
	              </div>
	              <!-- End Steps -->
	              <!-- Wizard Content -->
	              <form class="wizard-content" id="exampleFormContainer">
	                <div class="wizard-pane active" role="tabpanel">
	                  <div class="form-group form-material">
	                    <label class="control-label" for="inputUserNameOne">Username</label>
	                    <input type="text" class="form-control" id="inputUserNameOne" name="username" required="required">
	                  </div>
	                  <div class="form-group form-material">
	                    <label class="control-label" for="inputPasswordOne">Password</label>
	                    <input type="password" class="form-control" id="inputPasswordOne" name="password"
	                    required="required">
	                  </div>
	                </div>
	                <div class="wizard-pane" id="exampleBillingOne" role="tabpanel">
	                  <div class="form-group form-material">
	                    <label class="control-label" for="inputCardNumberOne">Card Number</label>
	                    <input type="text" class="form-control" id="inputCardNumberOne" name="number" placeholder="Card number">
	                  </div>
	                  <div class="form-group form-material">
	                    <label class="control-label" for="inputCVVOne">CVV</label>
	                    <input type="text" class="form-control" id="inputCVVOne" name="cvv" placeholder="CVV">
	                  </div>
	                </div>
	                <div class="wizard-pane" id="exampleGettingOne" role="tabpanel">
	                  <div class="text-center margin-vertical-20">
	                    <h4>Please confrim your order.</h4>
	                    <div class="table-responsive">
	                      <table class="table table-hover text-right">
	                        <thead>
	                          <tr>
	                            <th class="text-center">#</th>
	                            <th>Description</th>
	                            <th class="text-right">Quantity</th>
	                            <th class="text-right">Unit Cost</th>
	                            <th class="text-right">Total</th>
	                          </tr>
	                        </thead>
	                        <tbody>
	                          <tr>
	                            <td class="text-center">1</td>
	                            <td class="text-left">Server hardware purchase</td>
	                            <td>32</td>
	                            <td>$75</td>
	                            <td>$2152</td>
	                          </tr>
	                          <tr>
	                            <td class="text-center">2</td>
	                            <td class="text-left">Office furniture purchase</td>
	                            <td>15</td>
	                            <td>$169</td>
	                            <td>$4169</td>
	                          </tr>
	                          <tr>
	                            <td class="text-center">3</td>
	                            <td class="text-left">Company Anual Dinner Catering</td>
	                            <td>69</td>
	                            <td>$49</td>
	                            <td>$1260</td>
	                          </tr>
	                        </tbody>
	                      </table>
	                    </div>
	                  </div>
	                </div>
	              </form>
	              <!-- Wizard Content -->
	            </div>
	          </div>
	          <!-- End Panel Wizard Form Container -->
			</div>
		</div>
					
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
	<?php $this->load->view('themes/footer'); ?>