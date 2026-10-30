 
 function mainDiv(singleEventData) {

    var tia_featured_event=document.createElement("div");
        tia_featured_event.className="tia-list-post style-1 tia-featured-event";
        tia_featured_event.appendChild(leftContentDiv(singleEventData));
        tia_featured_event.appendChild(rightContentDiv(singleEventData));
        return tia_featured_event;    
  }

// create Element of left Side Start Here=============================
  function leftContentDiv(singleEventData) {
    
     var tia_list_post_left=document.createElement("div");
         tia_list_post_left.className="tia-list-post-left";
         tia_list_post_left.appendChild(imgDiv(singleEventData));
         return tia_list_post_left;
  }

  function imgDiv(singleEventData) {
      var intorImg=singleEventData.intro_image; 
      var tia_list_img=document.createElement("div");
          tia_list_img.className="tia-list-img";
          tia_list_img.style.backgroundImage = "url("+introImgUrl+intorImg+")";
          tia_list_img.backgroundSize="cover";
          tia_list_img.appendChild(dateDiv(singleEventData));
          return tia_list_img;
  }

  function dateDiv(singleEventData) {
      var tia_list_date=document.createElement("div");
          tia_list_date.className="tia-list-date";
          tia_list_date.appendChild(dateAreaDiv(singleEventData));
          return tia_list_date;
  }

  function dateAreaDiv(singleEventData) {
      var tia_date_area=document.createElement("div");
          tia_date_area.className="tia-date-area default-schedule";
          tia_date_area.appendChild(daySpan(singleEventData));
          tia_date_area.appendChild(MonthSpan(singleEventData));
          tia_date_area.appendChild(YearSpan(singleEventData));
          tia_date_area.appendChild(timeSpan(singleEventData));
          return tia_date_area;
  }

  function daySpan(singleEventData) {
       var tia_event_day=document.createElement("span");
          tia_event_day.className="ev-day";
          tia_event_day.innerHTML="";
          return tia_event_day;
  }

  function MonthSpan(singleEventData) {
      var tia_event_month=document.createElement("span");
          tia_event_month.className="ev-mo";
          return tia_event_month;
  }

  function YearSpan(singleEventData) {
      var tia_event_year=document.createElement("span");
          tia_event_year.className="ev-yr";
          return tia_event_year;
  }

  function timeSpan(singleEventData) {
      var tia_event_time=document.createElement("span");
          tia_event_time.className="ev-time";
          tia_event_time.appendChild(clockIcon());
          return tia_event_time;
  }

  function clockIcon(){
      var iconSpan=document.createElement("span");
          iconSpan.className="tia-icon";
      var icon=document.createElement("i");
          icon.className="fa fa-clock-o";
          iconSpan.appendChild(icon);
          return iconSpan;
  }

// create Element of Left Side End Here=============================

// create Element of Right Side Start Here=============================

  function rightContentDiv(singleEventData) {
    
     var tia_list_post_right=document.createElement("div");
         tia_list_post_right.className="tia-list-post-right";
         tia_list_post_right.appendChild(postRightTableDiv(singleEventData));
         return tia_list_post_right;
  }

  function postRightTableDiv(singleEventData) {
      var tia_list_post_right_table=document.createElement("div");
          tia_list_post_right_table.className="tia-list-post-right-table";
          tia_list_post_right_table.appendChild(listDescription(singleEventData));
          tia_list_post_right_table.appendChild(listVenue(singleEventData));
          return tia_list_post_right_table;
  }

//== List description div start here==
  function listDescription(singleEventData) {
      var tia_list_description=document.createElement("div");
          tia_list_description.className="tia-list-description";
          tia_list_description.appendChild(tiaListTitle(singleEventData));
          tia_list_description.appendChild(tiaListContent(singleEventData));
          tia_list_description.appendChild(tiaListCost(singleEventData));
          return tia_list_description; 
  }

  function tiaListTitle(singleEventData) {
      var tia_list_title=document.createElement("h2");
          tia_list_title.className="tia-list-title";
          return tia_list_title; 
  }

  function tiaListContent(singleEventData) {
      var tia_list_content=document.createElement("h2");
          tia_list_content.className="tia-event-content";
          tia_list_content.appendChild(tiaListParagraph(singleEventData));
          tia_list_content.appendChild(tiaListReadMoreBtn(singleEventData))

          return tia_list_content; 
  }

  function tiaListParagraph(singleEventData) {
      var paragraph=document.createElement("p");
          //paragraph.innerHTML="";
          return paragraph;
  }

  function tiaListReadMoreBtn(singleEventData) {
      var readmorebtn=document.createElement("a");
          readmorebtn.innerHTML="Read More &raquo;";
          readmorebtn.href="#";
          return readmorebtn;
  }

  function tiaListCost(singleEventData) {
      var tia_list_cost=document.createElement("h2");
          tia_list_cost.className="tia-list-cost";
          tia_list_cost.appendChild(tiaListRateArea(singleEventData));

          return tia_list_cost; 
  }

  function tiaListRateArea(singleEventData) {
      var tia_list_price=document.createElement("div");
          tia_list_price.className="tia-rate-area";
          tia_list_price.appendChild(tiaIcon(singleEventData));
          tia_list_price.appendChild(tiaPrice(singleEventData));
          return tia_list_price;
  }

  function tiaIcon(singleEventData) {
    var iconSpan=document.createElement("span");
        iconSpan.className="tia-icon";
    var icon=document.createElement("i");
        icon.className="fa fa-ticket";    
        iconSpan.appendChild(icon);
        return iconSpan;    
  }

  function tiaPrice(singleEventData) {
    var price=document.createElement("span");
        price.className="tia-rate";
        return price;
  }

    //== List description div end here=== 

    //== List Location div start here==
function listVenue(singleEventData) {
    
    var tia_list_venue=document.createElement("div");
        tia_list_venue.className="tia-list-venue default-venue";
        tia_list_venue.appendChild(tiaLocationIcon(singleEventData));
        tia_list_venue.appendChild(tiaLocationDetails(singleEventData));
        return tia_list_venue;

}

function tiaLocationIcon(singleEventData) {
    var iconSpan=document.createElement("span");
        iconSpan.className="tia-icon";
    var icon=document.createElement("i");
        icon.className="fa fa-map-marker fa-2x";   
        iconSpan.appendChild(icon);
        return iconSpan; 
}

function tiaLocationDetails(singleEventData) {
    var tia_venue_details=document.createElement("span");
        tia_venue_details.className="tia-venue-details tia-address";
        tia_venue_details.appendChild(tiaAddress(singleEventData));
        tia_venue_details.appendChild(tiaGoogleMap(singleEventData));
        return tia_venue_details;

}

function tiaAddress(singleEventData) {
    var address=document.createElement("span");
        address.className="tribe-address";
        address.appendChild(tiaLocality(singleEventData));
        address.appendChild(tiaRegion(singleEventData));
        address.appendChild(tiacountry(singleEventData));
        return address;
           
}

function tiaLocality(singleEventData) {
    var locality=document.createElement("span");
        locality.className="tribe-locality";
        return locality;
}

function tiaRegion(singleEventData) {
    var region=document.createElement("abbr");
        region.className="tribe-region tribe-events-abbr";
        return region;
}

function tiacountry(singleEventData) {
    var country=document.createElement("span");
        country.className="tribe-country-name";
        return country;
}

function tiaGoogleMap(singleEventData) {
    var tia_map=document.createElement("span");
        tia_map.className="tia-google";
        tia_map.appendChild(tiaLink(singleEventData));
        return tia_map;
}

function tiaLink(singleEventData) {
    var map_link=document.createElement("a");
        map_link.className="tribe-events-gmap btn btn-sm ";
        map_link.title="Click To Visit Map";
        map_link.target="_blank";

        var icon=document.createElement("i");
            icon.className="fa fa-location-arrow";
        var boldText=document.createElement("b");
            boldText.innerHTML="+ Google Map";
        map_link.appendChild(icon);
        map_link.appendChild(boldText);
        return map_link;                
}
//============== List Location div end here================ 


