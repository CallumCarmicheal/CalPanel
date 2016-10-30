<!-- Bootstrap 3.3.7 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
		integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
		crossorigin="anonymous"></script>

<!-- Bootbox -->
<script src="/js/bootbox.min.js"></script>

<script>

var Laravel = {
	RootURL: "<?php echo e(url('/')); ?>/"
};

$(function() {
	$.ajaxSetup({ 
		headers: { 
			'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' 
		} 
	});
});

</script>