var accordionForCards=document.getElementById("accordionForDaysAndSchedules") ;

function generateEventLayout(datesArray,countDays){
	//console.log("generateEventLayout");
	//console.log(countDays);
	accordionForCards.innerHTML="" ;
	var i=1;
	datesArray.forEach(function(date) {
      var dateDMY=formatDateToDMY(date); //getting date in DD/MM/YYYY Format
      var dateYMD=formatDateToYMD(date); //getting date in YYYY-MM-DD Format
      accordionForCards.appendChild(createDayDateHiddenField(i,dateYMD)) ;
	  accordionForCards.appendChild(createCardDiv(i,dateDMY)) ;
	  createSchedule(i,dateDMY);
	  i++;
    }); 
}

//---------------For Dates of Event-----------------------------------------

function createDayDateHiddenField(id,dayDate){
	//console.log("createDayDateHiddenField");
	var dayDateHiddenField=document.createElement("input") ;
	dayDateHiddenField.type="hidden" ;
	dayDateHiddenField.id="daydate"+id ;
	dayDateHiddenField.name="daydate"+id ;
	dayDateHiddenField.value=dayDate ;
	return dayDateHiddenField ;
}

function createCardDiv(id,dayDate){
	//console.log("createCardDiv");
	var event_type=document.getElementById("eventtypeid").value;
	var cardDiv=document.createElement("div") ;
	cardDiv.id="day"+id ;
	cardDiv.className="card mt-1";

	var cardHeader=createCardHeader(id,dayDate) ;
	var cardBody=createCardCollapse(id,dayDate) ;
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
function createCardHeader(id,dayDate){
	//console.log("createCardHeader");
	var cardHeaderDiv=document.createElement("div") ;
	cardHeaderDiv.className="card-header date-card-header header-grad" ;
	cardHeaderDiv.id="headingDay"+id ;

	var h2tag=document.createElement("h2") ;
	h2tag.className="ml-4 mb-0";

	var cButton=document.createElement("button");
	cButton.type="button" ;
	//Creating Attributes For Button
	var dataToggleAttribute=document.createAttribute("data-toggle");
	dataToggleAttribute.value = "collapse"; 
	cButton.setAttributeNode(dataToggleAttribute);

	var dataTargetAttribute=document.createAttribute("data-target");
	dataTargetAttribute.value = "#collapseDay"+id;
	cButton.setAttributeNode(dataTargetAttribute) ;

	var ariaExpandedAttribute=document.createAttribute("aria-expanded");
	ariaExpandedAttribute.value = "false";
	cButton.setAttributeNode(ariaExpandedAttribute) ;

	var ariaControlsAttribute=document.createAttribute("aria-controls");
	ariaControlsAttribute.value = "collapseDay"+id ;
	cButton.setAttributeNode(ariaControlsAttribute) ;

	cButton.innerHTML="Date: "+dayDate ;
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
function createCardCollapse(id,dayDate){
	//console.log("createCardCollapse");
	var cardCollapseDiv=document.createElement("div") ;
	cardCollapseDiv.className="collapse show card-inner" ;
	cardCollapseDiv.id="collapseDay"+id ;

	//Creating Attributes For Card Collapse Div
	var ariaLabelledByAttribute=document.createAttribute("aria-labelledby");
	ariaLabelledByAttribute.value = "headingDay"+id ;
	cardCollapseDiv.setAttributeNode(ariaLabelledByAttribute);

	var ariaLabelledByAttribute=document.createAttribute("data-parent");
	ariaLabelledByAttribute.value = "#accordionForDaysAndSchedules" ;
	cardCollapseDiv.setAttributeNode(ariaLabelledByAttribute);

	var cardBodyDiv=document.createElement("div") ;
	cardBodyDiv.classList.add("card-body");
	//cardBodyDiv.innerHTML="Card Body---"+id+", Date: "+dayDate ;

	cardBodyDiv.appendChild(cardBodyInnerDiv(id,dayDate));
	cardCollapseDiv.appendChild(createSchdButton(id,dayDate));//update schedule
	//Adding button to h2 tag
	//cardCollapseDiv.appendChild(cardBodyDiv);

	return cardCollapseDiv ;
}

function createSchdButton(id,dayDate) {
	//console.log("createSchdButton");
	//var createSchdArray= new Array();
	var createSchdDiv=document.createElement("div");
	createSchdDiv.className="text-right";

	var validateSchd=document.createElement("input");
		validateSchd.type="hidden";
		validateSchd.id="daydate"+id+"vldtschdquantity";
		validateSchd.name="daydate"+id+"vldtschdquantity";
		validateSchd.value=0;

	var hiddeninput=document.createElement("input");
		hiddeninput.type="hidden";
		hiddeninput.id="daydate"+id+"schdquantity";
		hiddeninput.name="daydate"+id+"schdquantity";
		hiddeninput.value=0;

	var createSchdBtn=document.createElement("button");
	createSchdBtn.className="btn btn-success btn-sm m-2";
	createSchdBtn.id="createSchdBtn"+id;
	createSchdBtn.type="button";
	//createSchdBtn.setAttribute('onclick','createNewSchd();'); // for FF
    createSchdBtn.onclick = function() {createSchedule(id,dayDate);};

	createSchdBtn.innerHTML=" + Add Schedule";
	createSchdDiv.appendChild(validateSchd);
	createSchdDiv.appendChild(hiddeninput);
	createSchdDiv.appendChild(createSchdBtn);
	return createSchdDiv;

}

//main card Body
function cardBodyInnerDiv(id,schdid,dayDate){
	//alert(dayDate);
	//console.log("cardBodyInnerDiv");
	schdInnerDiv=document.createElement("div");
	schdInnerDiv.className="schdcardstyle mb-2";
	schdInnerDiv.id="daydate"+id+"schedule"+schdid ;
	schdInnerDiv.appendChild(schdHeader(id,schdid,dayDate));	//header
	schdInnerDiv.appendChild(schdBodyRow1(id,schdid,dayDate));//body row1
	schdInnerDiv.appendChild(schdBodyRow2(id,schdid,dayDate));//body row2
	return schdInnerDiv;
}

// Body Header Info----------------
function schdHeader(id,schdid,dayDate) {
	//console.log("schdHeader");
	var schdheaderDiv=document.createElement("div");
	var schdCrossBtn=document.createElement("button");
	schdCrossBtn.id="daydate"+id+"schd"+schdid+"removebtn" ;
	schdCrossBtn.title="Remove Schedule";
	schdCrossBtn.type="button";
	schdCrossBtn.className="btn btn-danger btn-sm float-right cross-btn";
	schdCrossBtn.onclick = function() {removeSchd(id,schdid);};
	schdCrossIcon=document.createElement("i");
	schdCrossIcon.className="fa fa-times";

	schdCrossBtn.appendChild(schdCrossIcon);
	schdheaderDiv.appendChild(schdCrossBtn);
 return schdheaderDiv;
}


function schdBodyRow1(id,schdid,dayDate)
{
	//console.log("schdBodyRow1");
	var schdRow1=document.createElement("div");
	schdRow1.className="row";
	schdRow1.id="daydate"+id+"schd"+schdid+"row1";

	//insert flag to set status for sending or not sending data
	schdRow1.append(createSchdInsertFlag(id,schdid)) ;
	//start-time
	schdRow1.appendChild(createSchdStartTime(id,schdid,dayDate));
	//end-time
	schdRow1.appendChild(createSchdEndTime(id,schdid,dayDate));

	//speaker type
	schdRow1.appendChild(createSchdSpeakerType(id,schdid,dayDate));

	//speaker name
	schdRow1.appendChild(createSchdSpeakeName(id,schdid,dayDate));

	return schdRow1;
}

function schdBodyRow2(id,schdid,dayDate){
	//console.log("schdBodyRow2");
	var schdRow2=document.createElement("div");
	schdRow2.className="row mt-3";
	schdRow2.id="daydate"+id+"schd"+schdid+"row2";

	//schd title
	schdRow2.appendChild(createSchdTitle(id,schdid,dayDate));
	
	//schd description
	schdRow2.appendChild(createSchdDescription(id,schdid,dayDate));

	//schd photo file
	schdRow2.appendChild(createSchdPhotoFile(id,schdid,dayDate));
	
	return schdRow2;
}

function createSchdId(id,dayDate)
{
	//console.log("createSchdId");
}

function createSchdInsertFlag(id,schdid)
{
	//creating Input Hidden Field
	var insertFlag=document.createElement("input");
	insertFlag.type="hidden";
	insertFlag.name="daydate"+id+"schd"+schdid+"insertflag";
	insertFlag.id="daydate"+id+"schd"+schdid+"insertflag";
	insertFlag.value="1" ;
	return insertFlag;
}

function createSchdStartTime(id,schdid,dayDate)
{
	//console.log("createSchdStartTime");
	//creating coloumn <div class col-sm-3>
	var schdcolsm3=document.createElement("div");
	schdcolsm3.className="col-sm-3";
	//creating <label>
	var label=document.createElement("label");
	label.innerHTML="Start Time";
	//creating Input Field
	var input=document.createElement("input");
	input.type="time";
	input.name="daydate"+id+"schd"+schdid+"schdstarttime";
	input.id="daydate"+id+"schd"+schdid+"schdstarttime";
	input.className="form-control";
	input.title="Schedule Start Time";
	input.required = true;
	schdcolsm3.appendChild(label);
	schdcolsm3.appendChild(input);
	return schdcolsm3;
}

function createSchdEndTime(id,schdid,dayDate)
{	
	//console.log("createSchdEndTime");
	//creating coloumn <div class col-sm-3>
	var schdcolsm3=document.createElement("div");
	schdcolsm3.className="col-sm-3";
	//creating <label>
	var label=document.createElement("label");
	label.innerHTML="End Time";
	//creating Input Field
	var input=document.createElement("input");
	input.type="time";
	input.name="daydate"+id+"schd"+schdid+"schdendttime";
	input.id="daydate"+id+"schd"+schdid+"schdendtime";
	input.className="form-control";
	input.title="Schedule End Time";
	input.required = true;
	schdcolsm3.appendChild(label);
	schdcolsm3.appendChild(input);
	return schdcolsm3;	
}

function createSchdTitle(id,schdid,dayDate)
{
	//console.log("createSchdTitle");
	//creating coloumn <div class col-sm-3>
	var schdcolsm3=document.createElement("div");
	schdcolsm3.className="col-sm-3";
	//creating <label>
	var label=document.createElement("label");
	label.innerHTML="Title";
	//creating Input Field
	var input=document.createElement("input");
	input.type="text";
	input.name="daydate"+id+"schd"+schdid+"schdtitle";
	input.id="daydate"+id+"schd"+schdid+"schdtitle";
	input.className="form-control";
	input.title="Schedule Title";
	input.required = true;
	schdcolsm3.appendChild(label);
	schdcolsm3.appendChild(input);
	return schdcolsm3;
}

function createSchdDescription(id,schdid,dayDate)
{
	//console.log("createSchdDescription");
	//creating coloumn <div class col-sm-6>
	var schdcolsm3=document.createElement("div");
	schdcolsm3.className="col-sm-6";
	//creating <label>
	var label=document.createElement("label");
	label.innerHTML="Description";
	//creating Input Field
	var textarea=document.createElement("textarea");
	textarea.rows="4";
	textarea.name="daydate"+id+"schd"+schdid+"schddescription";
	textarea.id="daydate"+id+"schd"+schdid+"schddescription";
	textarea.className="form-control";
	textarea.title="Schedule Description";
	schdcolsm3.appendChild(label);
	schdcolsm3.appendChild(textarea);
	return schdcolsm3;	
}

function createSchdSpeakerType(id,schdid,dayDate)
{
//console.log("createSchdSpeakerType");
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
select.name="daydate"+id+"schd"+schdid+"speakertype";
select.id="daydate"+id+"schd"+schdid+"speakertype";

select.className="form-control";
select.onchange = function() {
				updateActiveEventSpeakerList(this,
					document.getElementById("daydate"+id+"schd"+schdid+"speakernameid"))
				()};
schdcolsm3.appendChild(select);

//Create and append the options of Speaker Type
for (var i = 0; i < optionTxt.length; i++) {
    var option = document.createElement("option");
    option.value = optionTxt[i];
	    if(optionTxt[i]=='employee'){
	    	optionTxt[i]='Employee';
	    }
	    else{
	    	optionTxt[i]='Guest';
	    }
    option.text = optionTxt[i];
    select.appendChild(option);
}
schdcolsm3.appendChild(label);
schdcolsm3.appendChild(select);
return schdcolsm3;
}

function createSchdSpeakeName(id,schdid,dayDate)
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
	select.name="daydate"+id+"schd"+schdid+"speakernameid";
	select.id="daydate"+id+"schd"+schdid+"speakernameid";
	select.title="Speaker Name";
	select.className="form-control";
	schdcolsm3.appendChild(label);
	schdcolsm3.appendChild(select);
	return schdcolsm3;
}

function createSchdPhotoFile(id,schdid,dayDate)
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
	input.name="daydate"+id+"schd"+schdid+"schdpic";
	input.id="daydate"+id+"schd"+schdid+"schdpic";
	input.className="form-control";
	input.title="Schedule Photo File";
	schdcolsm3.appendChild(label);
	schdcolsm3.appendChild(input);
	return schdcolsm3;
}
function createNewSchd(id,schdid,dayDate){
	//alert(id);
	//alert(dayDate);
	collapse1=document.getElementById("collapseDay"+id);
	collapse1.appendChild(cardBodyInnerDiv(id,schdid,dayDate));
}


function createSchedule(id,dayDate) {
	console.log("i'm inside createSchedule function ");
	var schdqty=document.getElementById("daydate"+id+"schdquantity");
	if (schdqty) {
	var schdid=schdqty.value ;
	var validateschd=document.getElementById("daydate"+id+"vldtschdquantity");
	var vldtschdcount=validateschd.value;
	//createSchdArray[schdid]=true;
	schdid++ ;
	vldtschdcount++;
	createNewSchd(id,schdid,dayDate) ;
	schdqty.value=schdid ;
	validateschd.value=vldtschdcount;
	var printsptype="daydate"+id+"schd"+schdid+"speakertype";
	var printspname="daydate"+id+"schd"+schdid+"speakernameid";
	speakertype=document.getElementById(printsptype);
	speakername=document.getElementById(printspname);
	updateActiveEventSpeakerList(speakertype,speakername);
	}//gettin dropdown ajax
	//console.log("start");
    //console.log(createSchdArray);
    //console.log("end");
}
//schdCrossBtn.id="daydate"+id+"schd"+schdid+"removebtn" ;
function removeSchd(id,schdid)
{	
	var validateschd=document.getElementById("daydate"+id+"vldtschdquantity");
	var vldtschdcount=validateschd.value;
	var schdDiv=document.getElementById("daydate"+id+"schedule"+schdid) ;
	schdDiv.style.display = 'none';
	insertFlagId="daydate"+id+"schd"+schdid+"insertflag" ;
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
	vldtschdcount=vldtschdcount-1;
	validateschd.value=vldtschdcount;
}





//------------For Schedules of Dates Ends----------------------------------------

