$( 'document' ).ready(iniciar);

function iniciar()
{
	$( "#tbluser" ).on('click','.btnuser',miJuego);
	$( "#tblmachine" ).on('click','.btnmachine',jugar);
}

function jugar(event)
{
	var id=event.target.id;
	$("#"+id).prop('disabled','');
	$.ajax(
		{
			url:'/batallanaval/juego/atacar/'+id,
			type:'post',
			dataType:'json'
		}
	)
	.done(
		function(rpta)
		{
			console.log(rpta);
			if(rpta.estado == true)
			{
				$("#"+id).removeClass('btn-warning');
				$("#"+id).addClass('btn-danger');
				$("#"+id).attr('disabled','true');
			}
			else
			{
				$("#"+id).removeClass('btn-warning');
				$("#"+id).addClass('btn-info');
				$("#"+id).attr('disabled','true');
			}
			$.ajax({
				url:'/batallanaval/juego/estado/player-0',
				type: 'post',
				dataType:'json'
			}).done(function(r){
				console.log(r.estado);
				if(parseInt(r.estado) == 6)
				{
					window.location.href = 'http://localhost/batallanaval/win/player';
				}
			}).fail(
					function(xhr,textStatus)
					{
						console.log(textStatus);
					}
			);
			$.ajax({
				url: '/batallanaval/juego/machine',
				type: 'post',
				dataType:'json'
			}).done(function (resp) {
				if(resp.estado == true)
				{
					$("#pos-"+resp.place).removeClass('btn-success');
					$("#pos-"+resp.place).addClass('btn-danger');
					$("#pos-"+resp.place).attr('disabled','true');
				}
				else
				{
					$("#pos-"+resp.place).removeClass('btn-info');
					$("#pos-"+resp.place).addClass('btn-warning');
					$("#pos-"+resp.place).attr('disabled','true');
				}
			}).fail(function(xhr,textStatus){

				console.log(textStatus);
			});

			$.ajax({
				url:'/batallanaval/juego/estado/player-1',
				type: 'post',
				dataType:'json'
			}).done(function(r){
				console.log(r.estado);
				if(r.estado == 6)
				{
					window.location.href = 'http://localhost/batallanaval/win/machine';
				}
			}).fail(
					function(xhr,textStatus)
					{
						console.log(textStatus);
					}
			);
		}
	)
	.fail(
		function(xhr,textStatus)
		{
			console.log(textStatus);
		}
	);

}

function miJuego(event)
{
	var id=event.target.id;
	var option = $("#"+id).hasClass('btn-success');
	if( option == true )
	{
		console.log('ENTRO');
		$.ajax(
				{
					url:'/batallanaval/restarPosicion/'+id,
					type:'post',
					dataType:'json'
				}
				)
				.done(
						function(rpta)
						{
							console.log(rpta);
							if(rpta.estado<6){
								$( "#"+id).removeClass('btn-success');
								$( "#"+id).addClass('btn-info');
								if(rpta.estado==5){
									$( ".btnmachine").prop('disabled','');
								}
							}
							else if(rpta.estado==6){
								$(".btnuser").attr('disabled','true');
								$("#dialog").dialog({
									title:'Batalla Naval',
									buttons:[{
										text:'OK',
										click:function()
										{
											$(this).dialog('close');
										}
									}]
								});
							}
						}
				)
				.fail(
						function(xhr,textStatus)
						{
							console.log(textStatus);
						}
				);
	}
	else
	{

		$.ajax(
			{
				url:'/batallanaval/adicionarPosicion/'+id,
				type:'post',
				dataType:'json'
			}
		)
		.done(
			function(rpta)
			{
				console.log(rpta);
				if(rpta.estado<6){
					$( "#"+id).removeClass('btn-info');
					$( "#"+id).addClass('btn-success');
					if(rpta.estado==5){
						$( ".btnmachine").prop('disabled','');

					}
				}
				else if(rpta.estado==6){
					$(".btnuser").attr('disabled','true');
					$("#dialog").dialog({
						title:'Batalla Naval',
						buttons:[{
							text:'OK',
							click:function()
							{
								$(this).dialog('close');
							}
						}]
					});
				}
			}
		)
		.fail(
			function(xhr,textStatus)
			{
				console.log(textStatus);
			}
		);
	}


}
