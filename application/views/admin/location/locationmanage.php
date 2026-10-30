<?php 
if($this->session->userdata("logged_in")){
?>
<?php $this->load->view("admin/commons/adminheader.php") ;?>
<div class="container-fluid">
  <h4 class="text-center heading">Event Location Management</h4>
  <br>
  <div class="text-right">
  <!-- Button Triggers Add Classroom modal -->
    <button type="button" class="btn btn-primary btn-sm text-center" data-toggle="modal" data-target="#addLocationModal"><strong><i class="fas fa-user-plus"></i>Add Location</strong></button>
  </div>

  <div class="accordion" id="accordionExample">
  <?php 
  $locationlist=$this->EventLocationModel->getLocationList() ;
  foreach($locationlist as $row){ 
  ?> 
  <div class="card">
    <div class="card-header cardstyle" id="headingOne">
      <h2 class="mb-0">
        <table border="0" class="tablestyle">
          <tbody>
          <tr> 
            <td class="idcol"><?=$row->location_id; ?></td>
            <td ><?=$row->location_title?></td>
            <td colspan="3" class="text-right edatecol">DOE: <?=date('d-m-Y',strtotime($row->created_on)) ?></td>
          </tr>
           <tr>
            <td colspan="3"><?=$row->district." , ".$row->state." , ".$row->country?> </td>
            <td class="text-right buttoncol">
               <?php if($row->status==1){ ?>
              <a href="<?php echo base_url()?>aevent/enableDisableLocation/<?=$row->location_id?>/0" class="btn btn-success btn-sm" title="Disable"><i class="fab fa-codiepie"></i></a>
              <?php }else{?>
                <a href="<?php echo base_url()?>aevent/enableDisableLocation<?=$row->location_id?>/1" class="btn btn-danger btn-sm" title="Disable"><i class="fab fa-codiepie"></i></a>
                <?php }?>
            </td>
            <td class="text-right buttoncol">
              <button type="button" class="btn btn-warning btn-sm text-center" 
              data-toggle="modal" 
              data-target="#updateLocationModal" 
              data-location-id="<?=$row->location_id?>" 
              data-location-title="<?=$row->location_title?>" 
              data-house-no="<?=$row->house_no?>" 
              data-area="<?=$row->area?>" 
              data-city="<?=$row->city?>" 
              data-district="<?=$row->district?>" 
              data-state="<?=$row->state?>" 
              data-pin-code="<?=$row->pin_code?>" 
              data-map-link="<?=$row->map_link?>"
              data-country="<?=$row->country?>">
              <strong><i class="fas fa-edit" title="Edit Location" ></i></strong></button>
            </td>
            <td class="text-right buttoncol">
               <button class="btn btn-primary btn-sm collapsed" type="button" data-toggle="collapse" data-target="#collapseOne<?=$row->location_id?>" aria-expanded="false" aria-controls="collapseOne" title="More Info"><i class="fas fa-info-circle"></i></button>
            </td>
          </tr>
        </tbody>
        </table>
      </h2>
    </div>

    <div id="collapseOne<?=$row->location_id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body cardbodystyle">
        <div class="row">
          <div class="col-sm-7">
            <table border="0" class="table tablestyle">
              <tbody>
                <tr>
                  <td class="cbtablecol">Location Title:</td>
                  <td class="text-center"><?=$row->location_title?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">House No:</td>
                  <td class="text-center"><?=$row->house_no?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Area:</td>
                  <td class="text-center"><?=$row->area?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">City:</td>
                  <td class="text-center"><?=$row->city?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">District:</td>
                  <td class="text-center"><?=$row->district?></td>
                </tr> 
                <tr>
                  <td class="cbtablecol">State:</td>
                  <td class="text-center"><?=$row->state?></td>
                </tr>              
              </tbody>
            </table>
          </div>
          <div class="col-sm-5">
             <table border="0" class="table tablestyle">
              <tbody>
                <tr>
                  <td class="cbtablecol">Country</td>
                  <td class="text-center"><?=$row->country?></td>
                </tr>
                <tr>
                  <td class="cbtablecol"> Pin Code</td>
                  <td class="text-center"><?=$row->pin_code?></td>
                </tr>
                <tr>
                  <td class="cbtablecol"> Google map</td>
                  <td class="text-center"><a href="<?=$row->map_link?>" target="blank">Google-Map</a></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Status:</td>
                  <td class="text-center"><?=$row->status;?></td>
                </tr>
                <tr>
                  <td class="cbtablecol" colspan="1">Created On:</td>
                  <td class="text-center"><?=$row->created_on?></td>
                </tr>
                <tr>
                  <td class="cbtablecol" colspan="1">Last Updated On:</td>
                  <td class="text-center"><?=$row->last_updated_on?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
</div>
<br>
<!-----------Model of Add Location----------------->
<div class="modal fade bd-example-modal-lg" id="addLocationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url()?>Location/insert_location" method="post">
          <div class="form-group row">

              <div class="col-sm-6">
                  <div class="row">
                      <label class="col-sm-4 col-form-label lead">Location. Title:</label>
                      <div class="col-sm-8">
                          <input type="text" name="title" class="form-control" placeholder="Enter Location Title"  required="required">
                      </div>
                  </div>
              </div>
              <div class="col-sm-6">
                  <div class="row">
                      <label class="col-sm-4 col-form-label lead">House No:</label>
                      <div class="col-sm-8">
                          <input type="text" name="house_no" class="form-control" placeholder="House Number" required="required">
                      </div>
                  </div>
              </div>
            </div>
            
          <div class="form-group row">
              <div class="col-sm-6">
                  <div class="row">
                      <label class="col-sm-4 col-form-label lead">Area:</label>
                      <div class="col-sm-8">
                          <input type="text" name="area" class="form-control" placeholder="Area"   required="required">
                      </div>
                   </div>
              </div>
              <div class="col-sm-6">
                  <div class="row">
                      <label class="col-sm-4 col-form-label lead">City:</label>
                      <div class="col-sm-8">
                          <input type="text" name="city" class="form-control" placeholder="Enter City"  required="required">
                      </div>
                  </div>
              </div>
          </div>

          <div class="form-group row">
             <div class="col-sm-6">
              <div class="row">
                  <label class="col-sm-4 col-form-label lead">District:</label>
                  <div class="col-sm-8">
                    <input type="text" name="district" class="form-control"  placeholder="Enter District" required="required">
                  </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="row">
                <label class="col-sm-4 col-form-label lead">State:</label>
                <div class="col-sm-8">
                  <select id="upusertypeid" name="state" class="form-control" required="required">
                      <option value="select">select</option>
                      <option value="Delhi">Delhi</option>
                      <option value="Uttar Pradesh">Uttar Pradesh</option>
                </select>
              </div>
            </div>
          </div>
        </div>

          <div class="form-group row">
            <div class="col-sm-6">
              <div class="row">
                <label class="col-sm-4 col-form-label lead">Pin Code:</label>
                <div class="col-sm-8">
                  <input type="text" name="pin_code" class="form-control" 
                  placeholder="Enter pin-code" required="required">
              </div>
            </div>
          </div>
          <div class="col-sm-6">
              <div class="row">
                <label class="col-sm-4 col-form-label lead">Country:</label>
                <div class="col-sm-8">
                  <select id="upusertypeid" name="country" class="form-control" required="required">
                      <option value="select">select</option>
                      <option value="india">India</option>
                </select>
              </div>
            </div>
          </div>
        </div>

            <div class="row">
              <div class="col-sm-6">
                  <div class="row">
                      <label class="col-sm-4 col-form-label lead">Map Location:</label>
                      <div class="col-sm-8">
                      <textarea name="map_link" class="form-control" placeholder="Enter Map Link" required="required"></textarea>
                      </div>
                  </div>
              </div>
               
              <div class="col-sm-6 text-right">
                  <input type="submit" value="Submit" class="btn btn-lg btn-success submitbtn"/>
              </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
<!----Model for Update Location-------->
<div class="modal fade bd-example-modal-lg" id="updateLocationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="<?php echo base_url()?>Location/updateLocation" method="post">
          <input type="hidden" name="uplocationid"/>
          <div class="form-group row">
              <div class="col-sm-6">
                <div class="row">
                  <label class="col-sm-4 col-form-label lead">location ID:</label>
                  <div class="col-sm-8 text-center">
                      <label class="col-form-label lead text-center" id="uplocationid"></label>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="row">
                  <label class="col-sm-4 col-form-label lead">Location. Title:</label>
                  <div class="col-sm-8">
                      <input type="text" name="uplocation_title" class="form-control" placeholder="Enter Desig. Title" required="required"/>
                  </div>
                </div>
              </div>
          </div>

          <div class="form-group row">
              <div class="col-sm-6">
                  <div class="row">
                      <label class="col-sm-4 col-form-label lead">House No:</label>
                      <div class="col-sm-8">
                          <input type="text" name="uphouse_no" class="form-control" placeholder="Enter Desig. Title" required="required"/>
                      </div>
                  </div>
              </div>
              <div class="col-sm-6">
                  <div class="row">
                      <label class="col-sm-4 col-form-label lead">Area:</label>
                      <div class="col-sm-8">
                          <input type="text" name="uparea" class="form-control" placeholder="Enter Desig. Title" required="required"/>
                      </div>
                   </div>
              </div>
            </div>
            
          <div class="form-group row">
              <div class="col-sm-6">
                  <div class="row">
                      <label class="col-sm-4 col-form-label lead">City:</label>
                      <div class="col-sm-8">
                          <input type="text" name="upcity" class="form-control" placeholder="Enter Desig. Title" required="required"/>
                      </div>
                  </div>
              </div>
              <div class="col-sm-6">
                  <div class="row">
                    <label class="col-sm-4 col-form-label lead">District:</label>
                    <div class="col-sm-8">
                      <input type="text" name="updistrict" class="form-control" required="required">
                    </div>
                </div> 
              </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-6">
              <div class="row">
                 <label class="col-sm-4 col-form-label lead">Pin Code:</label>
                 <div class="col-sm-8">
                    <input type="text" name="uppin_code" class="form-control" required="required"> 
                 </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="row">
                <label class="col-sm-4 col-form-label lead">State:</label>
                <div class="col-sm-8">
                  <select id="upusertypeid" name="upstate" class="form-control" required="required">
                      <option value="">select</option>
                      <option value="Delhi">delhi</option>
                      <option value="Uttar Pradesh">Uttar Pradesh</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-6">
              <div class="row">
                <label class="col-sm-4 col-form-label lead">Map Location:</label>
                <div class="col-sm-8">
                  <textarea name="upmap_link" class="form-control" 
                  placeholder="Enter Map Link" required="required"></textarea>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
              <div class="row">
                <label class="col-sm-4 col-form-label lead">Country:</label>
                <div class="col-sm-8">
                  <select id="upusertypeid" name="upcountry" class="form-control" required="required" >
                      <option value="india">India</option>
                </select>
              </div>
            </div>
          </div>
        </div>

          <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 ">
              
            </div>
            <div class="col-sm-4 text-right">
              <input type="submit" value="Submit" class="btn btn-success submitbtn"/></div>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>

</div>

<?php $this->load->view("admin/commons/adminfooter.php") ;?>
<script type="text/javascript">
    $(document).ready(function(){

      //show.bs.modal jquery attributes
        $('#updateLocationModal').on('show.bs.modal', function(e) {  
          
          var locationId = $(e.relatedTarget).data('location-id');
          var locationTitle = $(e.relatedTarget).data('location-title');
          var houseNo = $(e.relatedTarget).data('house-no');
          var area = $(e.relatedTarget).data('area');
          var city = $(e.relatedTarget).data('city');
          var district = $(e.relatedTarget).data('district');
          var state = $(e.relatedTarget).data('state');
          var pincode = $(e.relatedTarget).data('pin-code');
          var maplink = $(e.relatedTarget).data('map-link');
          var country = $(e.relatedTarget).data('country');
          //populate the textbox
          $(e.currentTarget).find('input[name="uplocationid"]').val(locationId);
          $(e.currentTarget).find('input[name="uplocation_title"]').val(locationTitle);
          $(e.currentTarget).find('input[name="uphouse_no"]').val(houseNo);
          $(e.currentTarget).find('input[name="uparea"]').val(area);
          $(e.currentTarget).find('input[name="upcity"]').val(city);
          $(e.currentTarget).find('input[name="updistrict"]').val(district);
          $(e.currentTarget).find('input[name="upstate"]').val(state);
          $(e.currentTarget).find('input[name="upcountry"]').val(country);
          $(e.currentTarget).find('input[name="uppin_code"]').val(pincode);
          $(e.currentTarget).find('textarea[name="upmap_link"]').val(maplink);
          $('#uplocationid').html(locationId);
        });
    });
</script>

<?php 
}else{
  redirect(base_url()."login");
}
?>