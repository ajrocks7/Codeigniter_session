
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<!------ Include the above in your HEAD tag ---------->

<div class="container">
       <table class="table table-striped">
          <tbody>
             <tr>
                <td colspan="1">
                   <form method="post" onsubmit="javascript:void();" id="myform">
                   	<input type="hidden" name="id" value=""
                      <fieldset>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Full Name</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input id="fullName" data-validation="required" name="fullName" placeholder="Full Name" class="form-control" required="true"  type="text" value=""></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Address Line 1</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span><input id="addressLine1" data-validation="required" name="addressLine1" placeholder="Address Line 1" class="form-control" required="true" value="" type="text"></div>
                            </div>
                         </div>
                        
                       
                       
                        
                         
                         <div class="form-group">
                            <label class="col-md-4 control-label">Email</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input id="email" data-validation="email" name="email" placeholder="Email" class="form-control" required="true" value="" type="text"></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Phone Number</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span><input id="phoneNumber" data-validation="number" name="phoneNumber" placeholder="Phone Number" class="form-control" required="true" value="" type="text"></div>
                            </div>
                         </div> <br>

                        <br> <div class="form-group">
                         
                           
                               <center><div class="input-group">
                                <br>	<input id="phoneNumber" name="phoneNumber" placeholder="Phone Number" class="form-control btn btn-success" required="true" value="Save" type="button" onclick="formsubmit()">&nbsp;&nbsp;</div></center>
                             
                         </div>



                      </fieldset>
                   </form>
                </td>
                
             </tr>
          </tbody>
       </table>
    </div>
 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Details</h4>
        </div>
        <div class="modal-body " id="details">
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  

<div class="container">
	<div class="row">
		
        
        <div class="col-md-12">
   <br/><br/>  <div class="col-xs-12" align="right">
               
        </div><br/><br/>
        <div class="table-responsive">

                
              <table id="mytable" class="table table-bordred table-striped">
                   
                   <thead>
                   
                 
                   <th>Name</th>
                    <th>Address1</th>
                     <th>Email</th>
                     <th>Contact</th>
                      <th>Edit</th>
                       <th>Delete</th>
                   </thead>
    <tbody id="tbdata">
    
    </tbody>
        
</table>

<div class="clearfix"></div>

                
            </div>
            
        </div>
	</div>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>$.validate({});</script>

<script type="text/javascript">
function formsubmit()
	{
var valz = $("#myform").serialize();

	$.ajax({
type:'POST',
url:'<?php echo base_url();?>Login/submit',
data:{
	values:valz,
},
success:function(data)
{
	 //alert("Inserted");
	 returntabledata();
}
});




	}

function returntabledata()
{
	$.ajax({
url:'<?php echo base_url();?>Login/getdetails',
dataType:'Json',
success:function(b)
{
	$("#tbdata").html(b.values);
}

	});
}


$(document).on("click", ".open-AddBookDialog", function () {
     var myBookId = $(this).data('id');
    $.ajax({
type:'POST',    	
url:'<?php echo base_url();?>Login/geteditdetails',
data:{
id:myBookId,
},
dataType:'Json',
success:function(b)
{
	$("#details").html(b.values);
}
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
});


function updatedata()
	{
var valz = $("#editform").serialize();
var id = $("#editval").val();
	$.ajax({
type:'POST',
url:'<?php echo base_url();?>Login/editsumbit',
data:{
	values:valz,
	id:id,
},
success:function(data)
{
	 //alert("Inserted");
	 $("#myModal").modal('hide');
	 returntabledata();
}
});
}


function deletedata(id)
{
	$.ajax({
		type:'POST',
url:'<?php echo base_url();?>Login/delete',
data:{
	id:id,
},
success:function(b)
{
	alert("Deleted Successfully");
	$("#hidedat"+id).hide();
}

	});
}
</script>