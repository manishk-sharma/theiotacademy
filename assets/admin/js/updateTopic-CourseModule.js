
 function dbTopicData(topicsData) {
   
   console.log(topicsData[0]);

   var count=1; 

   for (var i = 0; i < topicsData.length; i++) {

        count=count+i;
        $("#countTopic").val(count);
        
        updateTopic(count,topicsData[i]);

  }

 }


 function updateTopic(count,topicData) {

          if (count!=-1) {

            $("#countTopic").val(count);
            $("#activeCount").val(count);

          }else{

            count=parseInt($("#countTopic").val());
            count=count+1;
            $("#countTopic").val(count);
          }
        

            

          var addNewChild=document.getElementById('add_child');

              addNewChild.appendChild(tableRow(count,topicData));
                
        

      }
    
    function tableRow(count,topicData) {
      
      var tr = document.createElement('tr');

          tr.id="tableRow"+count;

          tr.className="tableRowDiv";

          tr.appendChild(flagInputHiddenField(count,topicData));

          tr.appendChild(actionHidenField(count,topicData))

          tr.appendChild(DBtopicIdHiddenField(count,topicData));

          tr.appendChild(tableData1(count,topicData));

          tr.appendChild(tableData2(count,topicData));

          tr.appendChild(tableData3(count,topicData));

      return tr;    

    }

    function flagInputHiddenField(count,topicData) {

      hiddenInput=document.createElement('input');
      
      hiddenInput.type='hidden';
      
      hiddenInput.name='flag'+count;
      
      hiddenInput.id='flag'+count;
      
      hiddenInput.value=1;
      
      return hiddenInput;

    }


    function actionHidenField(count,topicData) {

      hiddenInput=document.createElement('input');
      
      hiddenInput.type='hidden';
      
      hiddenInput.name='action'+count;
      
      hiddenInput.id='action'+count;

      hiddenInput.value='insert';

      if (topicData.topic_id) {
        hiddenInput.value='update';
      }
      
      
      return hiddenInput;

    }


    function DBtopicIdHiddenField(count,topicData) {

      hiddenInput=document.createElement('input');
      
      hiddenInput.type='hidden';
      
      hiddenInput.name='dbID'+count;
      
      hiddenInput.id='dbID'+count;

      hiddenInput.value='nil';

      if (topicData.topic_id) {
        hiddenInput.value=topicData.topic_id;
      }
      
      
      return hiddenInput;

    }

    function tableData1(count,topicData) {


      var th = document.createElement('th');

          th.id="tableHeading"+count;

          th.className="text-center";

          th.appendChild(sequenceInput(count,topicData))

      return th;       

    }

    function sequenceInput(count,topicData) {
      var input=document.createElement('input');
          input.type="number";
          input.required=true;
          input.id="sequence"+count;
          input.name="sequence"+count;
          if (topicData.sequence) {
            input.value=topicData.sequence;
          
          }
          input.placeholder="Enter Sequence"
          input.className="form-control number";
      return input;
    }



    function tableData2(count,topicData) {

      var td = document.createElement('td');

          td.id="tableDataOne"+count;

          td.className="text-center";

          td.appendChild(topicInput(count,topicData));

      return td    
    }

    function topicInput(count,topicData) {

      var input=document.createElement('input');
          input.type="text";
          input.required=true;
          input.id="topic_name"+count;
          input.name="topic_name"+count;
          input.className="form-control";

          if (topicData.topic_name) {
            input.value=topicData.topic_name;
          }

          input.placeholder="Enter Topic Name"
      return input;      
    }

    function tableData3(count,topicData) {

      var td = document.createElement('td');
          td.className="text-center";
          td.id="tableDataTwo"+count;
          td.appendChild(removeButton(count,topicData));

      return td    
    }
    

    function removeButton(count,topicData) {

      var button=document.createElement('button');
          button.type="button";
          button.id="removeBtn"+count;
          button.setAttribute('data',count);
          button.className="form-control bg-danger p-1 text-white lastBtn";
          //button.setAttribute('onclick','removeTopic('+count+','+topicData+');');
          button.onclick = function() {removeTopic(count,topicData);};

          button.appendChild(addIcon());

      return button;       
    }

    function addIcon() {

      var addIcon=document.createElement('i');
          addIcon.className="fa fa-trash";  
      return addIcon;
    }

 
    function removeTopic(count,topicData) {

      var totalTopicRow = ($('#topicTable tr.tableRowDiv').filter(function() {
                              return $(this).css('display') !== 'none';
                            }).length);
      
      if(totalTopicRow>1){

        if (topicData.topic_id) {

            document.getElementById("action"+count).value='remove';
      
        }
        $('#tableRow'+count).css('display','none');

        $('#flag'+count).val(0);

        $('#topic_name'+count).prop('required',false);

        $('#sequence'+count).prop('required',false);
        
        $('#activeCount').value=count-1;
        
      }
      else{
        $('.lastBtn').css('cursor','not-allowed');
        $('.lastBtn').prop( "disabled", true );

      }
    }  