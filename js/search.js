window.onload=function()
			{
				var hidediv=document.getElementById('div1');

				document.onclick=function(div)
				{
					if(div.target.id!=='div1')
					{
						hidediv.style.display="none";
					}
				}
				var showdiv=document.getElementById('input_search');
				document.onclick=function(div)
				{
					if(div.target.id!=='input_search' )
					{
						hidediv.style.display="none";
					}
				}
			};
			$(document).ready(function(){
				$(".search_bar").keyup(function(){
					var search=$(this).val();
					if(search!='')
					{
						$('.search_bar').focus(function(){
								$('.show_search_result').show();
							});
							$('.show_search_result').show();
						$.ajax({
								url:"search.php",
								method:"post",
								data:{search:search},
								dataType:"text",
								success:function(data)
								{
									$('.show_search_result').html(data);
								}//success function end
							});
						
					}else{
							$('.show_search_result').hide();
							$('.show_search_result').html('');
					}
				});// keyup event
			});// ready function