<?php 
if($this->session->userdata("logged_in")){
?>
<?php $this->load->view("admin/commons/adminheader.php") ;?>
<style type="text/css">
  .submitbtn{
    width:150px;
    border-radius:25px;
    font-weight:bold;
  }
</style>
<div class="container-fluid">
  <h4 class="text-center heading">Add New Payment</h4>
  <br>
  <form action="<?php echo base_url()?>submit-payment" method="post">
    <input type="hidden" id="baseurl" name="baseurl" value="<?php echo base_url()?>"/>
    <input type="hidden" name="totalfee" id="totalfee" value="0"/>
    <input type="hidden" name="paidfee" id="paidfee" value="0"/>
    <input type="hidden" name="balancefee" id="balancefee" value="0"/>
    <div class="row">
      <!--Left Side Form-->
      <div class="col-sm-6">
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Reg. Id:</label>
          <div class="col-sm-8">
            <?php $reglist=$this->RegisterModel->getRegistrationList()?>
            <select id="regid" name="regid" class="form-control" onchange="updateAmount()">
              <?php foreach($reglist as $row){
                if($row->balance_fee!=0){
                  $studinfo=$this->StudentModel->getStudentById($row->std_id);
                  $coursetitle=$this->CourseModel->getCourseTitleById($row->course_id);
              ?>
                <option value="<?=$row->reg_id?>"><?=$row->registration_id."-".$studinfo['first_name']." ".$studinfo['last_name']."-".$coursetitle?></option>
              <?php } }?>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Amount (&#8377;):</label>
          <div class="col-sm-8">
            <input type="number" id="feeamount" name="feeamount" class="form-control" placeholder="Enter Amount To Be Paid Without Tax" onkeyup="updateNetAmount()" required="required"/>
          </div>
        </div>
      
       <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Tax Amount (&#8377;):</label>
          <div class="col-sm-8">
            <input type="number" id="taxamount" name="taxamount" class="form-control" placeholder="Enter Tax Amount" onkeyup="updateNetAmount()" value="0" required="required"/>
          </div>
       </div>

       <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Net Amount (&#8377;):</label>
          <div class="col-sm-8">
            <input type="number" id="netamount" name="netamount" class="form-control" placeholder="Enter Amount with Tax" required="required"/>
          </div>
       </div>

       <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Payment Mode:</label>
          <div class="col-sm-8">
            <select id="paymentmode" name="paymentmode" class="form-control" onchange="updateTransStatus()">
              <option value="Cash">Cash</option>
              <option value="PayTM Wallet">PayTM Wallet</option>
              <option value="Net Banking">Net Banking</option>
              <option value="Credit Card">Credit Card</option>
              <option value="Debit Card">Debit Card</option>
              <option value="Cheque">Cheque</option>
              <option value="Other">Other</option>
            </select>
          </div>
       </div>

       <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Payment Type:</label>
          <div class="col-sm-8">
            <select name="paymenttype" class="form-control">
              <option value="Course Fee">Course Fee</option>
              <option value="Exam Fee">Exam Fee</option>
              <option value="Other Payment">Other Payment</option>
            </select>
          </div>
       </div>

       <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Payment Date:</label>
          <div class="col-sm-8">
            <input type="date" name="transdate" class="form-control" value="<?=date('Y-m-d')?>" required="required"/>
          </div>
       </div>

       
      </div>
      <!--Right Side Form-->
      <div class="col-sm-6">
         <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Transaction Status:</label>
          <div class="col-sm-8">
            <select id="transstatus" name="transstatus" class="form-control">
              <option value="Completed">Completed</option>
              <option value="Subject To Realisation">Subject To Realisation</option>
              <option value="Failed">Failed</option>
            </select>
          </div>
         </div>
         <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Instrument No.:</label>
            <div class="col-sm-8">
              <input type="text" id="instnumber" name="instnumber" class="form-control" placeholder="Enter Transaction/Cheque No." value="0" required="required"/>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Instrument Date:</label>
            <div class="col-sm-8">
              <input type="date" name="instdate" class="form-control" value="<?=date('Y-m-d')?>" required="required"/>
            </div>
          </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Instrument Amount (&#8377;):</label>
          <div class="col-sm-8">
            <input type="number" id="instamount" name="instamount" class="form-control" placeholder="Enter Transaction/Cheque Amount" required="required"/>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Instrument Bank:</label>
          <div class="col-sm-8">
            <input type="text" id="instbank" name="instbank" class="form-control" placeholder="Enter Transaction Bank Name" value="Cash" required="required"/>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Remarks:</label>
          <div class="col-sm-8">
            <textarea name="remarks" class="form-control" placeholder="Enter Transaction Remarks" rows="4" required="required"></textarea>
          </div>
        </div>
        
      </div>


    </div>
    
    <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-4 text-center">
        <input type="submit" value="Submit" class="btn btn-primary submitbtn"/>
      </div>
      <div class="col-sm-4"></div>
    </div>
  </form>

</div>
<?php $this->load->view("admin/commons/adminfooter.php") ;?>
<script type="text/javascript">
  function updateNetAmount(){
    var amount=document.getElementById("feeamount");
    var taxamount=document.getElementById("taxamount");
    var netamount=document.getElementById("netamount");
    var instamount=document.getElementById("instamount");

    netamount.value=parseInt(amount.value)+parseInt(taxamount.value) ;
    instamount.value=parseInt(amount.value)+parseInt(taxamount.value) ;
  }

  function updateTransStatus(){
    var transstatus=document.getElementById("transstatus");
    var paymentmode=document.getElementById("paymentmode");
    var instnumber=document.getElementById("instnumber");
    var instbank=document.getElementById("instbank");
    if(paymentmode.value=='Cheque'){
      transstatus.selectedIndex=1 ;
      instbank.value=null ;
    }else if(paymentmode.value=='Cash'){
      transstatus.selectedIndex=0 ;
      instnumber.value="0" ;
      instbank.value="Cash" ;
    }else if(paymentmode.value=='PayTM Wallet'){
      transstatus.selectedIndex=0 ;
      instbank.value="PayTM Wallet" ;
    }else{
      transstatus.selectedIndex=0 ;
      instbank.value=null ;
    }
  }
</script>
<script type="text/javascript" src="<?=asset_url()."js/ajax/addpaymentajax.js"?>"></script>
<script type="text/javascript">
  updateAmount();
</script>
<?php 
}else{
  redirect(base_url()."login");
}
?>