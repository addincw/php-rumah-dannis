$( document ).ready(function(){
	$('.tampil').click(function(){
		var kod = '5';
		//var val = 'ini';
		$('.hasil').load('file1.php', {kode : kod});
	});

	$('#login').click(function(){
    alert('halo addin');
  });
});
