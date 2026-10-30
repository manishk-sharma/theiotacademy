var NewDateArray,DbDateArray,DBDateArrLenth,NewDateArrLenth;
 
function getDataForUppendDateAndSchdCard(newDateArray , dbDateData) {

	//console.log(newDateArray);
	console.log(dbDateData);
	 var dbDaysData,schdData,dbDateArrLen="",newDateArrLen="";
	 var dbDateArray=[];
        dbDaysData=dbDateData.days_data[0];
        for(var i=0; i<dbDaysData.length; i++){
        	date=dbDaysData[i].day_date;
          	//console.log("Date : "+date);
          	dbDateArray.push((new Date(date)));
          	schdData=dbDaysData[i].schd_data;
          for(j=0;j<schdData.length; j++){
           // console.log("Schedule : "+schdData[j].start_time);
          }
        }  
		DbDateArray=dbDateArray;
        NewDateArray=newDateArray;
        DBDateArrLenth=dbDateArrLen=dbDateArray.length;
        NewDateArrLenth=newDateArrLen=newDateArray.length;
        if (dbDateArrLen==newDateArrLen) {
        	//console.log("Equal  lenght");
        	generateEventLayout(newDateArray,dbDateArray,dbDaysData);//create accordian
        	populateSchedule(dbDaysData);//After that populate Schedule And Speaker 

        }
        else if(dbDateArrLen<newDateArrLen){
        	//console.log("Db date is Less than New date");
        	generateEventLayout(newDateArray,dbDateArray,dbDaysData);//create accordian
        	populateSchedule(dbDaysData);//After that populate Schedule And Speaker
        	
        }
        else{        	
        	for (var i = newDateArrLen; i < dbDateArrLen; i++) {
        		newDateArray[i]=dbDateArray[i];
        		//console.log(newDateArray[i]);
        	}

        	generateEventLayout(newDateArray,dbDateArray,dbDaysData);//create accordian
        	populateSchedule(dbDaysData);
        }
}
var accordionForCards=document.getElementById("accordionForUpdateDaysAndSchedules") ;
//console.log(accordionForCards);
function generateEventLayout(IstDateArray,IIndDateArray,dbDaysData){
	//(dbDateArray,daysData)
	accordionForCards.innerHTML="";
	var i=0
	dayCount=1;
	IstDateArray.forEach(function(date) {
	var newDateYMD=formatDateToYMD(date); //getting New date in YYYY-MM-DD Format
    var newDateDMY=formatDateToDMY(date); //getting New date in DD/MM/YYYY Format

    if (dayCount<=DBDateArrLenth) {
	var dbDayData=dbDaysData[i];
  	var dbid=dbDaysData[i].day_id;
  	var dbDateDMY=formatDateToDMY(IIndDateArray[i]);//getting Db date in DD/MM/YYYY Format
  	var dbDateYMd=formatDateToYMD(IIndDateArray[i]);//getting Db date in YYYY-MM-DD Format
	}
	else{
		var dbDayData="nil";
		var dbid=0;
		var dbDateDMY="nil";// Db date not found.
		var dbDateYMd="nil";// Db date not found.
	}
//============DB Dependant Functions===========
	if (NewDateArrLenth==DBDateArrLenth) {
	  accordionForCards.appendChild(createIdDayDateHidField(dayCount,dbid)) ;
	  accordionForCards.appendChild(createDbDayDateHidField(dayCount,dbDateYMd)) ;
	  accordionForCards.appendChild(createNewDayDateHidField(dayCount,newDateYMD)) ;
	  accordionForCards.appendChild(createOprDayDateHidField(dayCount,dbDateYMd,newDateYMD,dbDayData));
	  accordionForCards.appendChild(createCardDiv(dayCount,newDateDMY,dbDayData)) ;
	}

	else if(DBDateArrLenth<NewDateArrLenth){
	  console.log(dayCount);
	  accordionForCards.appendChild(createIdDayDateHidField(dayCount,dbid)) ;
	  accordionForCards.appendChild(createDbDayDateHidField(dayCount,dbDateYMd)) ;
   	  accordionForCards.appendChild(createNewDayDateHidField(dayCount,newDateYMD)) ;
	  accordionForCards.appendChild(createOprDayDateHidField(dayCount,dbDateYMd,newDateYMD)) ;
	  accordionForCards.appendChild(createCardDiv(dayCount,newDateDMY,dbDayData)) ;
	}
	else{
	  //console.log(dayCount);
	  accordionForCards.appendChild(createIdDayDateHidField(dayCount,dbid)) ;
	  accordionForCards.appendChild(createDbDayDateHidField(dayCount,dbDateYMd)) ;
   	  accordionForCards.appendChild(createNewDayDateHidField(dayCount,newDateYMD)) ;
	  accordionForCards.appendChild(createOprDayDateHidField(dayCount,dbDateYMd,newDateYMD)) ;
	  accordionForCards.appendChild(createCardDiv(dayCount,newDateDMY,dbDayData)) ;
	}
    i++;
    dayCount++;
  }); 


}

//---------------For Dates of Event-----------------------------------------

function createIdDayDateHidField(dayCount,dbid){
	//dbid will be 0 if dbDateArray exceed its lenght.
	//console.log("createDayDateHiddenField");
	var dayDateHiddenField=document.createElement("input") ;
	dayDateHiddenField.type="hidden" ;
	dayDateHiddenField.id="daydate"+dayCount+"dbid" ;
	dayDateHiddenField.name="daydate"+dayCount+"dbid" ;
	dayDateHiddenField.value=dbid;
	return dayDateHiddenField ;
}
function createDbDayDateHidField(dayCount,dbDateYMd){
	//dbDateYMD will be nil if dbDateArray exceed its lenght.
	//console.log("createDayDateHiddenField");
	var dayDateHiddenField=document.createElement("input") ;
	dayDateHiddenField.type="hidden" ;
	dayDateHiddenField.id="daydate"+dayCount+"dbdate" ;
	dayDateHiddenField.name="daydate"+dayCount+"dbdate" ;
	dayDateHiddenField.value=dbDateYMd ;
	return dayDateHiddenField ;
}
function createNewDayDateHidField(dayCount,newDateYMD){
	//console.log("createDayDateHiddenField");
	var dayDateHiddenField=document.createElement("input") ;
	dayDateHiddenField.type="hidden" ;
	dayDateHiddenField.id="daydate"+dayCount+"newdate";
	dayDateHiddenField.name="daydate"+dayCount+"newdate";
	dayDateHiddenField.value=newDateYMD;
	return dayDateHiddenField ;
}
function createOprDayDateHidField(dayCount,dbDateYMd,newDateYMD){
	//var dayDate = formatDateToYMD(dayData.day_date);
	operation='skip';
	if (dbDateYMd!==newDateYMD) {
		operation='update';
	}
	if (dayCount>NewDateArrLenth) {
		operation='remove';
	}
	if (dayCount>DBDateArrLenth) {
		operation='insert';
	}
		dayDateHiddenField=document.createElement("input") ;
		dayDateHiddenField.type="hidden" ;
		dayDateHiddenField.id="daydate"+dayCount+"operation" ;
		dayDateHiddenField.name="daydate"+dayCount+"operation" ;
	
	dayDateHiddenField.value= operation;
	return dayDateHiddenField ;
}

function createCardDiv(dayCount,newdateDMY,dayData){
	//var dayDate = formatDateToDMY(dayData.day_date);
	//console.log(dayData);
	var event_type=document.getElementById("eventtypeid").value;
	var cardDiv=document.createElement("div") ;
	cardDiv.id="day"+dayCount ;
	cardDiv.className="card mt-1";

	var cardHeader=createCardHeader(dayCount,newdateDMY,dayData) ;
	var cardBody=createCardCollapse(dayCount,newdateDMY,dayData) ;
	//adding card header and then card body to major card div
	cardDiv.appendChild(cardHeader);
	
	/*if event_type = 4  it means i.e -> Industrial Visit 
	And don't Append card Body to major card div.*/
	if(event_type!=4){
	cardDiv.appendChild(cardBody);
	}
	return cardDiv ;
}
//For Card Header
function createCardHeader(dayCount,newdateDMY,dayData){
	//var dayDate = formatDateToDMY(dayData.day_date);
	//console.log("createCardHeader");
	var cardHeaderDiv=document.createElement("div") ;
	if (dayCount>NewDateArrLenth) {
		cardHeaderDiv.className="card-header date-card-header header-danger" ;
	}
	else{
		cardHeaderDiv.className="card-header date-card-header header-grad" ;
	}
	cardHeaderDiv.id="headingDay"+dayCount ;

	var h2tag=document.createElement("h2") ;
	h2tag.className="ml-4 mb-0";

	var cButton=document.createElement("button");
	cButton.type="button" ;
	//Creating Attributes For Button
	var dataToggleAttribute=document.createAttribute("data-toggle");
	dataToggleAttribute.value = "collapse"; 
	cButton.setAttributeNode(dataToggleAttribute);

	var dataTargetAttribute=document.createAttribute("data-target");
	dataTargetAttribute.value = "#collapseDay"+dayCount;
	cButton.setAttributeNode(dataTargetAttribute) ;

	var ariaExpandedAttribute=document.createAttribute("aria-expanded");
	ariaExpandedAttribute.value = "false";
	cButton.setAttributeNode(ariaExpandedAttribute) ;

	var ariaControlsAttribute=document.createAttribute("aria-controls");
	ariaControlsAttribute.value = "collapseDay"+dayCount ;
	cButton.setAttributeNode(ariaControlsAttribute) ;

	cButton.innerHTML="Date: "+newdateDMY ;
	cButton.className="btn btn-link text-white btn-sm font-weight-bold";

	//Adding button to h2 tag
	h2tag.appendChild(cButton) ;

	//Adding h2 tag to cardHeader
	cardHeaderDiv.appendChild(h2tag) ;

	return cardHeaderDiv ;
}

//-----------For Dates of Events Ends--------------------------------------------

//-----------For Schedules of Dates----------------------------------------------
//For Card Body
function createCardCollapse(dayCount,newdateDMY,dayData){
	//console.log(dayData);
	var cardCollapseDiv=document.createElement("div") ;
	if (dayCount>NewDateArrLenth) {
		cardCollapseDiv.className="collapse show card-inner-danger" ;
	}
	else{
		cardCollapseDiv.className="collapse show card-inner" ;
	}
	cardCollapseDiv.id="collapseDay"+dayCount ;

	//Creating Attributes For Card Collapse Div
	var ariaLabelledByAttribute=document.createAttribute("aria-labelledby");
	ariaLabelledByAttribute.value = "headingDay"+dayCount ;
	cardCollapseDiv.setAttributeNode(ariaLabelledByAttribute);

	var ariaLabelledByAttribute=document.createAttribute("data-parent");
	ariaLabelledByAttribute.value = "#accordionForUpdateDaysAndSchedules" ;
	cardCollapseDiv.setAttributeNode(ariaLabelledByAttribute);

	var cardBodyDiv=document.createElement("div") ;
	cardBodyDiv.classList.add("card-body");

	if(DBDateArrLenth<NewDateArrLenth){
		cardBodyDiv.appendChild(cardBodyInnerDiv(dayCount,newdateDMY));
		cardCollapseDiv.appendChild(createSchdButton(dayCount,newdateDMY));	
	}
	else{
		cardBodyDiv.appendChild(cardBodyInnerDiv(dayCount,dayData));
		cardCollapseDiv.appendChild(createSchdButton(dayCount,dayData));//update schedule
	}

	return cardCollapseDiv ;
}

function createSchdButton(dayCount,dayData) {
	//var dayDate = formatDateToDMY(dayData.day_date);
	//console.log("createSchdButton");
	var createSchdArray= new Array();
	var createSchdDiv=document.createElement("div");
	//createSchdDiv.innerHTML="some data gose here";
	if (dayCount>NewDateArrLenth) {
		createSchdDiv.className="create-schd-button mt-1 mb-2 text-center";
		createSchdDiv.innerHTML="<strong>These Date And Schedule Will Be Delete !</strong>";
	}
	else{
	createSchdDiv.className="create-schd-button mt-1 mb-2 text-right";
	}
	var hiddeninput=document.createElement("input");
		hiddeninput.type="hidden";
		hiddeninput.id="daydate"+dayCount+"schdquantity";
		hiddeninput.name="daydate"+dayCount+"schdquantity";

	if (DBDateArrLenth<NewDateArrLenth) {
		hiddeninput.value=0;
	}
	else{
		schedulesData=dayData.schd_data;
		hiddeninput.value=schedulesData.length;
	}
	//============================================
//=========================================
	var createSchdBtn=document.createElement("button");
	if (dayCount>NewDateArrLenth) {
		createSchdBtn.className="float-right btn btn-success btn-sm mb-2";
	}
	else{
		createSchdBtn.className=" btn btn-success btn-sm mb-2";
	}
	createSchdBtn.id="createSchdBtn"+dayCount;
	createSchdBtn.type="button";
	if (dayCount>NewDateArrLenth) {
		createSchdBtn.disabled=true;
	}
	else{
		createSchdBtn.disabled=false;
	}

	//createSchdBtn.setAttribute('onclick','createNewSchd();'); // for FF
    createSchdBtn.onclick = 
			    function() {
			   		var schdqty=document.getElementById("daydate"+dayCount+"schdquantity");
			   		var schdCount=schdqty.value ;
			    	createSchdArray[schdCount]=true;
			    	schdCount++ ;
			    	schdqty.value=schdCount ;
			    	collapse1=document.getElementById("collapseDay"+dayCount);
	    			collapse1.appendChild(createSchdOperation(dayCount,schdCount));
			    	//console.log(dayData);
			    	createNewSchd(dayCount,schdCount,dayData) ;
			    	var printsptype="daydate"+dayCount+"schd"+schdCount+"speakertype";
					var printspname="daydate"+dayCount+"schd"+schdCount+"speakernameid";
					speakertype=document.getElementById(printsptype);
					speakername=document.getElementById(printspname);
					updateActiveEventSpeakerList(speakertype,speakername);//gettin dropdown ajax
					//console.log("start");
				    //console.log(createSchdArray);
				    //console.log("end");
			    };

	createSchdBtn.innerHTML=" + Add Schedule";
	createSchdDiv.appendChild(hiddeninput);
	createSchdDiv.appendChild(createSchdBtn);
	return createSchdDiv;

}

//main card Body
function cardBodyInnerDiv(dayCount,schdCount,schdData){
	//console.log(schdData);
	schdInnerDiv=document.createElement("div");
	if (dayCount>NewDateArrLenth) {
		schdInnerDiv.className="schdcardstyle-danger mt-2 mb-2";
	}
	else{
		schdInnerDiv.className="schdcardstyle mt-2 mb-2";
	}
	schdInnerDiv.id="daydate"+dayCount+"schedule"+schdCount ;

	if (DBDateArrLenth<NewDateArrLenth) {
		schdInnerDiv.appendChild(schdHeader(dayCount,schdCount,schdData));	//header
		schdInnerDiv.appendChild(schdBodyRow1(dayCount,schdCount,schdData));//body row1
		schdInnerDiv.appendChild(schdBodyRow2(dayCount,schdCount,schdData));//body row2

	}
	else{
		schdInnerDiv.appendChild(schdHeader(dayCount,schdCount,schdData));	//header
		schdInnerDiv.appendChild(schdBodyRow1(dayCount,schdCount,schdData));//body row1
		schdInnerDiv.appendChild(schdBodyRow2(dayCount,schdCount,schdData));//body row2
	}
	return schdInnerDiv;
}

// Body Header Info----------------
function schdHeader(dayCount,schdCount,schdData) {
	//console.log(schdData);<i class="fas fa-angle-double-up"></i><i class="fab fa-strava"></i>
	var schdheaderDiv=document.createElement("div");
	schdheaderDiv.id="daydate"+dayCount+"schd"+schdCount+"header";
	schdheaderDiv.append(createSchdInsertFlag(dayCount,schdCount)) ;

	if (dayCount>NewDateArrLenth) {
		var rearrangeSchdBtn=document.createElement("button");
		rearrangeSchdBtn.id="daydate"+dayCount+"schd"+schdCount+"removebtn" ;
		rearrangeSchdBtn.title="Rearrange Schedule";
		rearrangeSchdBtn.type="button";
		rearrangeSchdBtn.className="btn btn-info btn-sm float-right sift-btn";
		rearrangeSchdBtn.onclick = function() {rearrangeSchdFunction(dayCount,schdCount,schdData);};
		rearrangeSchdIcon=document.createElement("i");
		rearrangeSchdIcon.className="fa fa-arrow-up";
		rearrangeSchdBtn.appendChild(rearrangeSchdIcon);
		schdheaderDiv.appendChild(rearrangeSchdBtn);
	}
	else{
		var schdCrossBtn=document.createElement("button");
		schdCrossBtn.id="daydate"+dayCount+"schd"+schdCount+"removebtn" ;
		schdCrossBtn.title="Remove Schedule";
		schdCrossBtn.type="button";
		schdCrossBtn.className="btn btn-danger btn-sm float-right cross-btn";
		schdCrossBtn.onclick = function() {removeSchd(dayCount,schdCount);};
		schdCrossIcon=document.createElement("i");
		schdCrossIcon.className="fa fa-times";
		schdCrossBtn.appendChild(schdCrossIcon);
		schdheaderDiv.appendChild(schdCrossBtn);
	}
	
	//insert flag to set status for sending or not sending data
	
	
 return schdheaderDiv;
}

function schdBodyRow1(dayCount,schdCount,schdData)
{
	//console.log(schdData);
	var schdRow1=document.createElement("div");
	schdRow1.className="row";
	schdRow1.id="daydate"+dayCount+"schd"+schdCount+"row1";

	//insert flag to set status for sending or not sending data
	//schdRow1.append(createSchdInsertFlag(dayCount,schdCount)) ;
	//start-time
	schdRow1.appendChild(createSchdStartTime(dayCount,schdCount,schdData));
	//end-time
	schdRow1.appendChild(createSchdEndTime(dayCount,schdCount,schdData));

	//speaker type
	schdRow1.appendChild(createSchdSpeakerType(dayCount,schdCount,schdData));

	//speaker name
	schdRow1.appendChild(createSchdSpeakeName(dayCount,schdCount,schdData));

	return schdRow1;
}

function schdBodyRow2(dayCount,schdCount,schdData){
	//console.log("schdBodyRow2");
	var schdRow2=document.createElement("div");
	schdRow2.className="row mt-3";
	schdRow2.id="daydate"+dayCount+"schd"+schdCount+"row2";

	//schd title
	schdRow2.appendChild(createSchdTitle(dayCount,schdCount,schdData));
	
	//schd description
	schdRow2.appendChild(createSchdDescription(dayCount,schdCount,schdData));

	//schd photo file
	schdRow2.appendChild(createSchdPhotoFile(dayCount,schdCount,schdData));
	
	return schdRow2;
}

function createSchdId(dayCount,schdData)
{
	//console.log("createSchdId");
}


function createSchdInsertFlag(dayCount,schdCount)
{
	//creating Input Hidden Field
	var insertFlag=document.createElement("input");
	insertFlag.type="hidden";
	insertFlag.name="daydate"+dayCount+"schd"+schdCount+"insertflag";
	insertFlag.id="daydate"+dayCount+"schd"+schdCount+"insertflag";
	if (dayCount>NewDateArrLenth) {
		insertFlag.value="0" ;
	}
	else{
		insertFlag.value="1" ;
	}
	return insertFlag;
}

function updateSchdDbId(dayCount,schdCount,schdId) {
	var dbSchdId = document.createElement('input');
	dbSchdId.type = "hidden";
	dbSchdId.name = "daydate"+dayCount+"schd"+schdCount+"dbid";
	dbSchdId.id = "daydate"+dayCount+"schd"+schdCount+"dbid";
	dbSchdId.value=schdId;
	return dbSchdId;
}
function updateSchdOperation(dayCount,schdCount) {
	var schdOperation = document.createElement('input');
	schdOperation.type = "hidden";
	schdOperation.name = "daydate"+dayCount+"schd"+schdCount+"operation";
	schdOperation.id = "daydate"+dayCount+"schd"+schdCount+"operation";
	if (dayCount>NewDateArrLenth) {
		schdOperation.value="remove";
	}
	else{
		schdOperation.value="update";
	}
	return schdOperation;
}
function createSchdOperation(dayCount,schdCount) {
	var schdOperation = document.createElement('input');
	schdOperation.type = "hidden";
	schdOperation.name = "daydate"+dayCount+"schd"+schdCount+"operation";
	schdOperation.id = "daydate"+dayCount+"schd"+schdCount+"operation";
	schdOperation.value="insert";

	return schdOperation;
}



function createSchdStartTime(dayCount,schdCount,schdData)
{
	var start_time=""
	if (typeof schdData !== 'undefined') {
		start_time=schdData.start_time;
	}
	//console.log(schdData.start_time);
	//creating coloumn <div class col-sm-3>
	var schdcolsm3=document.createElement("div");
	schdcolsm3.className="col-sm-3";
	//creating <label>
	var label=document.createElement("label");
	label.innerHTML="Start Time";
	//creating Input Field
	var input=document.createElement("input");
	input.type="time";
	input.value=start_time;
	input.name="daydate"+dayCount+"schd"+schdCount+"schdstarttime";
	input.id="daydate"+dayCount+"schd"+schdCount+"schdstarttime";
	input.onchange=function() {detectedChange(dayCount,schdCount);};
	//input.setAttribute('onchange', detectedChange);
	input.className="form-control";
	input.title="Schedule Start Time";
	input.required = true;


	if (dayCount>NewDateArrLenth) {
		input.disabled="true";
	}
	schdcolsm3.appendChild(label);
	schdcolsm3.appendChild(input);
	return schdcolsm3;
}

function createSchdEndTime(dayCount,schdCount,schdData)
{	
	//console.log("createSchdEndTime");
	var end_time="";
	if (typeof schdData !== 'undefined') {
		end_time=schdData.end_time;
	}
	//creating coloumn <div class col-sm-3>
	var schdcolsm3=document.createElement("div");
	schdcolsm3.className="col-sm-3";
	//creating <label>
	var label=document.createElement("label");
	label.innerHTML="End Time";
	//creating Input Field
	var input=document.createElement("input");
	input.type="time";
	input.value=end_time;
	input.name="daydate"+dayCount+"schd"+schdCount+"schdendttime";
	input.id="daydate"+dayCount+"schd"+schdCount+"schdendtime";
	input.className="form-control";
	input.title="Schedule End Time";
	input.onchange=function() {detectedChange(dayCount,schdCount);};
	input.required = true;
	if (dayCount>NewDateArrLenth) {
		input.disabled="true";
	}
	schdcolsm3.appendChild(label);
	schdcolsm3.appendChild(input);
	return schdcolsm3;	
}

function createSchdTitle(dayCount,schdCount,schdData)
{
	//console.log("createSchdTitle");
	var title="";
	if (typeof schdData !== 'undefined') {
		title=schdData.title;
	}
	//creating coloumn <div class col-sm-3>
	var schdcolsm3=document.createElement("div");
	schdcolsm3.className="col-sm-3";
	//creating <label>
	var label=document.createElement("label");
	label.innerHTML="Title";
	//creating Input Field
	var input=document.createElement("input");
	input.type="text";
	input.value=title;
	input.name="daydate"+dayCount+"schd"+schdCount+"schdtitle";
	input.id="daydate"+dayCount+"schd"+schdCount+"schdtitle";
	input.className="form-control";
	input.title="Schedule Title";
	input.onchange=function() {detectedChange();};
	//input.setAttribute('onchange', detectedChange);
	if (dayCount>NewDateArrLenth) {
		input.disabled="true";
	}
	input.required = true;
	schdcolsm3.appendChild(label);
	schdcolsm3.appendChild(input);
	return schdcolsm3;
}

function createSchdDescription(dayCount,schdCount,schdData)
{
	//console.log("createSchdDescription");
	var description="";
	if (typeof schdData !== 'undefined') {
		description=schdData.description;
	}
	//creating coloumn <div class col-sm-6>
	var schdcolsm3=document.createElement("div");
	schdcolsm3.className="col-sm-6";
	//creating <label>
	var label=document.createElement("label");
	label.innerHTML="Description";
	//creating Input Field
	var textarea=document.createElement("textarea");
	textarea.rows="4";
	textarea.name="daydate"+dayCount+"schd"+schdCount+"schddescription";
	textarea.id="daydate"+dayCount+"schd"+schdCount+"schddescription";
	textarea.value=description;
	textarea.className="form-control";
	textarea.title="Schedule Description";
	textarea.onchange=function() {detectedChange(dayCount,schdCount);};
	if (dayCount>NewDateArrLenth) {
		textarea.disabled="true";
	}
	schdcolsm3.appendChild(label);
	schdcolsm3.appendChild(textarea);
	return schdcolsm3;	
}

function createSchdSpeakerType(dayCount,schdCount,schdData)
{
//console.log("createSchdSpeakerType");
if (typeof schdData !== 'undefined') {
	var speaker_type=schdData.speaker_type;
	//console.log(speaker_type);
}
//creating coloumn <div class col-sm-3>
var schdcolsm3=document.createElement("div");
schdcolsm3.className="col-sm-3";
//creating <label>
var label=document.createElement("label");
label.innerHTML="Speaker Type";

//Create array of options to be added 
var optionTxt = ["employee","guest"];
//Create and append select Tag
var select = document.createElement("select");
select.name="daydate"+dayCount+"schd"+schdCount+"speakertype";
select.id="daydate"+dayCount+"schd"+schdCount+"speakertype";
select.className="form-control";

//Create and append the options of Speaker Type
for (var i = 0; i < optionTxt.length; i++) {
    var option = document.createElement("option");
    option.value = optionTxt[i];
    option.text = optionTxt[i];
	   if(optionTxt[i]==speaker_type){
	   		option.selected=true;
	   }
    //console.log(option);
    select.appendChild(option);
}

select.onchange = function() {
	updateActiveEventSpeakerList(this,
	document.getElementById("daydate"+dayCount+"schd"+schdCount+"speakernameid"))};
	
if (dayCount>NewDateArrLenth) {
	select.disabled="true"
}
schdcolsm3.appendChild(label);
schdcolsm3.appendChild(select);
return schdcolsm3;
}

function createSchdSpeakeName(dayCount,schdCount,schdData)
{

	//console.log("createSchdSpeakeName");
	//creating coloumn <div class col-sm-3>
	var schdcolsm3=document.createElement("div");
	schdcolsm3.className="col-sm-3";
	//creating <label>
	var label=document.createElement("label");
	label.innerHTML="Speaker Name";
	//creating Input Field
	var select=document.createElement("select");
	select.name="daydate"+dayCount+"schd"+schdCount+"speakernameid";
	select.id="daydate"+dayCount+"schd"+schdCount+"speakernameid";
	select.title="Speaker Name";
	select.className="form-control";
	select.onchange=function() {detectedChange(dayCount,schdCount);};
	if (dayCount>NewDateArrLenth) {
		select.disabled="true"
	}
	schdcolsm3.appendChild(label);
	schdcolsm3.appendChild(select);

	return schdcolsm3;
}

function createSchdPhotoFile(dayCount,schdCount,schdData)
{
	//console.log("createSchdPhotoFile");
	//creating coloumn <div class col-sm-3>
	var schdcolsm3=document.createElement("div");
	schdcolsm3.className="col-sm-3";
	//creating <label>
	var label=document.createElement("label");
	label.innerHTML="Schedule Photo File";
	//creating Input Field
	var input=document.createElement("input");
	input.type="file";
	//input.required = false;
	input.name="daydate"+dayCount+"schd"+schdCount+"schdpic";
	input.id="daydate"+dayCount+"schd"+schdCount+"schdpic";
	input.className="form-control";
	input.title="Schedule Photo File";
	if (dayCount>NewDateArrLenth) {
		input.disabled="true"
	}
	schdcolsm3.appendChild(label);
	schdcolsm3.appendChild(input);
	return schdcolsm3;
}
function createNewSchd(dayCount,schdCount,schdData){
	//alert(dayCount);
	//alert(dayDate);
	collapse1=document.getElementById("collapseDay"+dayCount);
	collapse1.appendChild(cardBodyInnerDiv(dayCount,schdCount,schdData));
	//console.log(schdData);
}

function removeSchd(dayCount,schdCount)
{	
	console.log("removed Date Id "+dayCount+" Of "+"Schd "+schdCount);
	var schdDiv=document.getElementById("daydate"+dayCount+"schedule"+schdCount) ;
	schdDiv.style.display = 'none';
	insertFlagId="daydate"+dayCount+"schd"+schdCount+"insertflag" ;
	inputs = schdDiv.getElementsByTagName('input');
	textarea = schdDiv.getElementsByTagName('textarea');
	selects = schdDiv.getElementsByTagName('select');
	var i=0;
	while(inputs.length>i){
		inputs[i].required=false;
		i++;
	}
	j=0;
	while(textarea.length>j){
		//console.log("textarea");
		textarea[j].required=false;
		j++;
	}
	var insertFlag=document.getElementById(insertFlagId) ;
	insertFlag.value=0 ;
	var findChange=document.getElementById("daydate"+dayCount+"schd"+schdCount+"operation");
	//console.log(findChange.value);
	findChange.value="remove";
	//console.log(findChange.value);
	
}



function rearrangeSchdFunction(dayCount,schdCount,schdData)
{	
	$("#rearrangeSchd").modal();   //*** open modal here

	$("#shiftSchd").off('click').on('click', function(){
		removeSchd(dayCount,schdCount);//remove schedule from current date
		detectedChange(dayCount,schdCount);

		selectedDate=document.getElementById("schdDateArrange");//getting select(date) dropdowns.

		appendDateCount=selectedDate.value;//getting value of selected option(date) from  dropdown.
		// getting existing date schd quantity
		appendSchd=document.getElementById('daydate'+appendDateCount+'schdquantity');

		var appendSchdCount=appendSchd.value;
		appendSchdCount++; //increment of selected date schd quantity		
		appendSchd.value=appendSchdCount;//assign  schd quantity into hidden field.

		appendschdId=schdData.schd_id;
		collapse1=document.getElementById("collapseDay"+appendDateCount);
    	collapse1.appendChild(updateSchdDbId(appendDateCount,appendSchdCount,appendschdId));
    	collapse1.appendChild(updateSchdOperation(appendDateCount,appendSchdCount));

		createNewSchd(appendDateCount,appendSchdCount,schdData);// appendSchd inside selected date

		var printsptype="daydate"+appendDateCount+"schd"+appendSchdCount+"speakertype";

		var printspname="daydate"+appendDateCount+"schd"+appendSchdCount+"speakernameid";

		speakertype=document.getElementById(printsptype);

		speakername=document.getElementById(printspname);

		updateActiveEventSpeakerList(speakertype,speakername);//gettin dropdown ajax

		$('#rearrangeSchd').modal('hide');
		//$('#rearrangeSchd').modal('dispose');
	});

 
}


//*** Notes this model will be call befor show of rearrangeSchd modal
$("#rearrangeSchd").on('show.bs.modal', function(e){
	selectDate=document.getElementById("schdDateArrange");
	selectDate.options.length = 0;
	count=0;
	for (var i = 0; i < NewDateArrLenth; i++) {
		count++;
		var activeDate=formatDateToDMY(NewDateArray[i]);
		var option=document.createElement("option");
		option.value=count;
		option.text=activeDate;
		selectDate.appendChild(option);
	}
});

$("#rearrangeSchd").on('hidden.bs.modal', function (e) {
	console.log("hidden:"+true);
	 $(this).removeData();
    //$(this).data('bs.modal', null);
    //$('.modal-body').html('');
});

function populateSchedule(daysData) {
	var dayCount=0;
	for(var i=0; i<daysData.length; i++) {
		var dayData=daysData[i];
		//console.log(dayData)
		var id=dayData.day_id;
	  	var schedulesData=dayData.schd_data;
		dayCount=dayCount+1;
		var schdCount=0;
		for(j=0;j<schedulesData.length; j++){
			schdCount=schdCount+1;
		  	var schdData=schedulesData[j];
		  	schdId=schdData.schd_id;
		  	var schdqty=document.getElementById("daydate"+dayCount+"schdquantity");
		  	//console.log(schdqty.value);
	    	//createSchdArray[schdCount]=true;
	    	schdqty.value=schdCount ;

	    	collapse1=document.getElementById("collapseDay"+dayCount);
	    	collapse1.appendChild(updateSchdDbId(dayCount,schdCount,schdId));
	    	collapse1.appendChild(updateSchdOperation(dayCount,schdCount));

		  	createNewSchd(dayCount,schdCount,schdData);
			var printsptype="daydate"+dayCount+"schd"+schdCount+"speakertype";
			var printspname="daydate"+dayCount+"schd"+schdCount+"speakernameid";
			speakertype=document.getElementById(printsptype);
			speakername=document.getElementById(printspname);
			updateActiveEventSpeakerList(speakertype,speakername,schdData.speaker_id);//gettin dropdown ajax
			//console.log(schdData.speaker_id);
			console.log(schdData);
			//speakername.value=schdData.speaker_id;
			console.log("old value: "+$('#'+printspname).val());
			$('#'+printspname).val(schdData.speaker_id).change();
			console.log("fresh value: "+$('#'+printspname).val());
			// $('#'+printspname).val(schdData.speaker_id);
			// speakertype.value
			console.log(schdData.speaker_type);
			console.log("working");
		}
	}
}





function detectedChange(dayCount,schdCount) {
	//console.log("some changes Apply ");
	var findChange=document.getElementById("daydate"+dayCount+"schd"+schdCount+"operation");
	if (findChange.value!="insert")
	findChange.value="update";
	if (dayCount>NewDateArrLenth) {
		findChange.value="skip";
	}
}



//populateSpeakerDropdown(data,s_type,speaker_list);
//Modal fade effect
/*.modal.fade:not(.in).left .modal-dialog {
	-webkit-transform: translate3d(-25%, 0, 0);
	transform: translate3d(-25%, 0, 0);
}
.modal.fade:not(.in).right .modal-dialog {
	-webkit-transform: translate3d(25%, 0, 0);
	transform: translate3d(25%, 0, 0);
}
.modal.fade:not(.in).bottom .modal-dialog {
	-webkit-transform: translate3d(0, 25%, 0);
	transform: translate3d(0, 25%, 0);
}

/* Alternative Angles 
.modal.fade:not(.in).top-left .modal-dialog {
	-webkit-transform: translate3d(-25%, -25%, 0);
	transform: translate3d(-25%, -25%, 0);
}
.modal.fade:not(.in).top-right .modal-dialog {
	-webkit-transform: translate3d(25%, -25%, 0);
	transform: translate3d(25%, -25%, 0);
}
.modal.fade:not(.in).bottom-left .modal-dialog {
	-webkit-transform: translate3d(-25%, 25%, 0);
	transform: translate3d(-25%, 25%, 0);
}
.modal.fade:not(.in).bottom-right .modal-dialog {
	-webkit-transform: translate3d(25%, 25%, 0);
	transform: translate3d(25%, 25%, 0);
}*/




