@push('scripts')
<script type="text/javascript">
function readURL(input,image_id) {
	if (input.files && input.files[0]) {
		    var reader = new FileReader();
		    reader.onload = function (e) {
		        $('#'+image_id).attr('src', e.target.result);
		    }
		    reader.readAsDataURL(input.files[0]);
		}
}	
</script>
@endpush