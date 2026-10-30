 baseUrl=$('#bases_url').val();

 function save_communication(trainerId){
    	//alert("gfdfg");
			//		exit();

			submitUrl = '<?php echo base_url()?>TrainerAddress/insert_trainerAddress';

			if($('.trainer_id').val()>0){
       
				submitUrl = '<?php echo base_url()?>TrainerAddress/editTrainerAddress';
				$.ajax({
					
						url :submitUrl,
						type : "POST",
						data : $("#Communicational_Details").serializeArray(),
						success : function(data) {//alert(data);
							alert("succses");
							
							return;
						},
						error : function(data) {
							alert("failed");
							return;
						}
				});
				$('.close').click();
              // location.href="index.php";
			}
		}



 function save_education(){

    		//console.log($("#Education_Details").serialize());

			submitUrl = baseUrl+'TrainerEducation/insert_education';

			$.ajax({
				
					url :submitUrl,
					type : "POST",
					data : $("#Education_Details").serialize(),
					success : function(data) {//alert(data);
						console.log(true);
						console.log(data);
						
						return;
					},
					error : function(data) {
						alert("failed");
						return;
					}
			});

			$('.close').click();

          // location.href="index.php";
			
		}
