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

$(document).ready(function(){
	$("button").on('click',function(){
		var $this = $(this);
		$this.button('loading');

		setTimeout(function(){
			$this.button('reset');
		},2000);
	});
});
</script>
@endpush