<!-- <div class="modal fade" id="onlineuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body" id="onlusr">
		<div class="panel  panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
		<i class="fa fa-user"></i>Online User
		</h3>
		</div>
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th >User Name</th>
						<th >User Email</th>
					</tr>
				</thead>
				<tbody id="usrhtml">
					
				</tbody>
			</table>
		</div>
	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
	  
    </div>
  </div>
</div>	 -->

</section>
<!-- End of section -->
    </div>
    <!-- End of content -->

        <footer class="main-footer">
            <div class="text-center">
                Copyright &copy; Oglinginches <?php echo date('Y'); ?>. Design By<a href="https://www.movinnza.in/seo-company-pune"> Movinnza</a>
            </div>
        </footer>

    </div>
    <!-- End of main-wrapper -->
</div>
<!-- End of app -->

	<!-- <script src="<?php echo base_url();?>public/js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>public/web/custom/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="<?php echo base_url();?>public/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>public/js/script.js"></script>
    
	<script src="<?php echo base_url()?>public/web/switchery/dist/switchery.min.js"></script>
	<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script> -->

<?php
//echo my_file1('web/multiselect/js/select2.full.min',2);
//echo my_file1('web/multiselect/css/select2;.min',1)
?>



<!--Jquery.min js-->
<script src="<?php echo base_url();?>public/js/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script src="<?php echo base_url();?>public/js/date-time-picker.min.js"></script>

<!--popper js-->
<script src="<?php echo base_url();?>public/js/popper.js"></script>

<!--Tooltip js-->
<script src="<?php echo base_url();?>public/js/tooltip.js"></script>

<!--Bootstrap.min js-->
<script src="<?php echo base_url();?>public/plugins/bootstrap/js/bootstrap.min.js"></script>

<!--Jquery.nicescroll.min js-->
<script src="<?php echo base_url();?>public/plugins/nicescroll/jquery.nicescroll.min.js"></script>

<!--Scroll-up-bar.min js-->
<script src="<?php echo base_url();?>public/plugins/scroll-up-bar/dist/scroll-up-bar.min.js"></script>

<!--Sidemenu js-->
<script src="<?php echo base_url();?>public/plugins/toggle-menu/sidemenu.js?v=051020.0"></script>

<!--Select2 js-->
<script src="<?php echo base_url();?>public/plugins/select2/select2.full.js"></script>
<!-- <script src="<?php echo base_url();?>public/plugins/select2/select2.multi-checkboxes.js"></script> -->

<!--Inputmask js-->
<script src="<?php echo base_url();?>public/plugins/inputmask/jquery.inputmask.js"></script>

<!--Moment js-->
<script src="<?php echo base_url();?>public/plugins/moment/moment.min.js"></script>

<!--Bootstrap-daterangepicker js-->
<script src="<?php echo base_url();?>public/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<!--Bootstrap-datepicker js-->
<script src="<?php echo base_url();?>public/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>

<!--Bootstrap-colorpicker js-->
<script src="<?php echo base_url();?>public/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>

<!--Bootstrap-timepicker js-->
<script src="<?php echo base_url();?>public/plugins/bootstrap-timepicker/bootstrap-timepicker.js"></script>

<!--mCustomScrollbar js-->
<script src="<?php echo base_url();?>public/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

<!--iCheck js-->
<script src="<?php echo base_url();?>public/plugins/iCheck/icheck.min.js"></script>

<!--forms js-->
<script src="<?php echo base_url();?>public/js/forms.js"></script>

<!--Scripts js-->
<script src="<?php echo base_url();?>public/js/scripts.js"></script>

<!--DataTables js-->
<script src="<?php echo base_url();?>public/plugins/Datatable/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>public/plugins/Datatable/js/dataTables.bootstrap4.js"></script>

<!-- Modaal-->
<script src="<?php echo base_url();?>public/js/modaal.js"></script>

<script src="<?php echo base_url();?>public/js/es5-shim.min.js"></script>
		

        <!-- <script src="<?php echo base_url();?>public/js/jquery-2.1.0.js"></script> -->
	<script src="<?php echo base_url();?>public/js/jquery.mousewheel.js"></script>
	<script src="<?php echo base_url();?>public/js/select2.js"></script>
    <script src="<?php echo base_url();?>public/dist/select2.optgroupSelect.js"></script>
    <script src="<?php echo base_url();?>public/js/zebra_datepicker.min.js"></script>
	<script src="<?php echo base_url();?>public/js/ckeditor.js"></script>
	<script src="<?php echo base_url();?>public/dropify/dist/js/dropify.min.js"></script>
	<script src="<?php echo base_url();?>public/dropzone-master/dist/dropzone.js"></script>
	<script src="<?php echo base_url();?>public/js/jQuery.style.switcher.js"></script>
	<script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();
        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });
        // Used events
        var drEvent = $('#input-file-events').dropify();
        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });
        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });
        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });
        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
    </script>
	<script>
			Dropzone.autoDiscover = false;

		// Dropzone class:
		var myDropzone = new Dropzone("div#mydropzone", { url: "/file/post"});

		// If you use jQuery, you can use the jQuery plugin Dropzone ships with:
		$("div#myDrop").dropzone({ url: "/file/post" });
	</script>
	<script>
		ClassicEditor
			.create( document.querySelector( '.editor' ), {
				// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
			} )
			.then( editor => {
				window.editor = editor;
			} )
			.catch( err => {
				console.error( err.stack );
			} );
	</script>
	<script type="text/javascript">
        var specialKeys = new Array();
        specialKeys.push(8); //Backspace
        function IsNumeric(e) {
            var keyCode = e.which ? e.which : e.keyCode
            var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
            return ret;
        }
    </script>
	<script>
		CI_ROOT = '<?php echo base_url();?>';
		if ($(window).width() < 514) {
		$('label').removeClass('control-label');
		} 
		
	

		 $(".select2").select2();
		 
		 
		function IsChkNumc(source){
			bmobile = $(source).val();
				if(isNaN(bmobile)){
				bmobile = bmobile.replace(/\D/g,'');
				$(source).val(bmobile);
			}
		} 
		
		
$("#onlineuserpopup").click(function(){
	$("#usrhtml").html(''); 
	$.ajax({
	type : "POST",
	url : CI_ROOT+'Welcome/displayonlineusers',
	success :function(result)
	{
		$("#usrhtml").html(result); 
		$('#onlineuser').modal('show');
	}
});
	
	
	
	
});			

$(document).ready(function() {
  
  $('.parent').click(function() {
       $('.submenu').toggle('visible');
   });

}); 

function goBack() {
  window.history.back();
}

	</script>

<script>
	ClassicEditor
		.create( document.querySelector( '#editor' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
</script>

</body>

</html>