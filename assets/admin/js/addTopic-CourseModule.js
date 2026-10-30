      function addNewTopic() {

        var count=parseInt($("#countTopic").val());
            
            count++;
            $("#countTopic").val(count);

          var addNewChild=document.getElementById('add_child');

              addNewChild.appendChild(tableRow(count));

      }
    
    function tableRow(count) {
      
      var tr = document.createElement('tr');

          tr.id="tableRow"+count;

          tr.appendChild(inputHiddenField(count))

          tr.appendChild(tableData1(count));

          tr.appendChild(tableData2(count));

          tr.appendChild(tableData3(count));

      return tr;    

    }

    function inputHiddenField(count) {

      hiddenInput=document.createElement('input');
      
      hiddenInput.type='hidden';
      
      hiddenInput.name='flag'+count;
      
      hiddenInput.id='flag'+count;
      
      hiddenInput.value=1;
      
      return hiddenInput;

    }

    function tableData1(count) {


      var th = document.createElement('th');

          th.id="tableHeading"+count;

          th.className="text-center";

          th.appendChild(sequenceInput(count))

      return th;       

    }

    function sequenceInput(count) {
      var input=document.createElement('input');
          input.type="text";
          input.name="sequence"+count;
          input.id="sequence"+count;
          input.className="form-control number";
          input.placeholder="Enter Sequence";
          input.required=true;
      return input;
    }



    function tableData2(count) {

      var td = document.createElement('td');

          td.id="tableDataOne"+count;

          td.className="text-center";

          td.appendChild(input(count));

      return td    
    }

    function input(count) {

      var input=document.createElement('input');
          input.type="text";
          input.name="topic_name"+count;
          input.id="topic_name"+count;
          input.className="form-control";
          input.placeholder="Enter Topic Name"
          input.required=true;
      return input;      
    }

    function tableData3(count) {

      var td = document.createElement('td');
          td.className="text-center";
          td.id="tableDataTwo"+count;
          td.appendChild(button(count));

      return td    
    }
    

    function button(count) {

      var button=document.createElement('button');
          button.type="button";
          button.id="removeBtn"+count;
          button.setAttribute('data',count);
          button.className="form-control bg-danger p-1 text-white";
          button.onclick = function() {removeTopic(count);};
          button.appendChild(addIcon(count));
      return button;       
    }

    function addIcon(count) {

      var addIcon=document.createElement('i');
          addIcon.className="fa fa-trash";  
      return addIcon;
    }

 
    function removeTopic(count) {

      document.getElementById("tableRow"+count).style.display='none';
      document.getElementById("flag"+count).value=0;
      document.getElementById("topic_name"+count).required=false;
      document.getElementById("sequence"+count).required=false;

         
    }    