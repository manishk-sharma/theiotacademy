//--mega menu--//
// --------------------show on hover start----------//
// const button = document.querySelector('.allCourseBtn');
// const innerDiv = document.querySelector('.nsh-all-courses-hover');

// button.addEventListener('mouseover', () => {
//     innerDiv.style.display = 'block';
//     if (button.children[0]) {
//     button.children[0].style.transition = 'all .3s'
//     button.children[0].style.transform = 'rotateZ(-180deg)'
//     }
// });

// innerDiv.addEventListener('mouseover', () => {
//     innerDiv.style.display = 'block';
//     if (button.children[0]) {
//     button.children[0].style.transition = 'all .3s'
//     button.children[0].style.transform = 'rotateZ(-180deg)'
//     }
// });

// innerDiv.addEventListener('mouseout', () => {
//     innerDiv.style.display = 'none';
//     if (button.children[0]) {
//     button.children[0].style.transition = 'all .3s'
//     button.children[0].style.transform = 'rotateZ(0deg)'
//     }
// });

// button.addEventListener('mouseout', () => {
//     innerDiv.style.display = 'none';
//     if (button.children[0]) {
//     button.children[0].style.transition = 'all .3s'
//     button.children[0].style.transform = 'rotateZ(0deg)'
//     }
// });


// --------------------show on hover end----------//

// --------------all course change start-------------//

// const nshachleft = document.getElementsByClassName('nsh-ach-left')[0].children
// const nshachright = [...document.getElementsByClassName('nsh-ach-right')]
// const allcourseChange = (e) => {
//     Array.from(nshachleft).forEach((element) => {
//         element.classList.remove('courses-active-tab2');
//         element.children[1].classList.remove('courses-active-icon');
//         element.children[1].style.transform = 'rotateZ(0deg)'
//     });
//     e.target.classList.add('courses-active-tab2')
//     e.target.children[1].classList.add('courses-active-icon')
//     e.target.children[1].style.transform = 'rotateZ(90deg)';

//     nshachright.forEach((element) => {
//         element.classList.remove('d-flex');
//         element.classList.add('d-none');
//     });

//     if (e.target.classList.contains('finanace')) {
//         nshachright.forEach((element) => {
//             // console.log("reached here", element)
//             if (element.classList.contains('finanace')) {
//                 element.classList.add('d-flex');
//                 element.classList.remove('d-none');
//             }
//         })
//     } else if (e.target.classList.contains('generativeaicoursetb'))  {
//         nshachright.forEach((element) => {

//             if (element.classList.contains('generativeaicoursetb')) {
//                 element.classList.add('d-flex');
//                 element.classList.remove('d-none');
//             }
//         })
//     } else if (e.target.classList.contains('newanalyticscourse')) {
//         nshachright.forEach((element) => {
//             if (element.classList.contains('newanalyticscourse')) {
//                 element.classList.add('d-flex');
//                 element.classList.remove('d-none');
//             }
//         })

//     }
//     else if (e.target.classList.contains('damlgenaicoursetb')) {
//         nshachright.forEach((element) => {
//             if (element.classList.contains('damlgenaicoursetb')) {
//                 element.classList.add('d-flex');
//                 element.classList.remove('d-none');
//             }
//         })

//     }

//     else if (e.target.classList.contains('analytics')) {
//         nshachright.forEach((element) => {
//             if (element.classList.contains('analytics')) {
//                 element.classList.add('d-flex');
//                 element.classList.remove('d-none');
//             }
//         })

//     } else if (e.target.classList.contains('technology')) {
//         nshachright.forEach((element) => {
//             if (element.classList.contains('technology')) {
//                 element.classList.add('d-flex');
//                 element.classList.remove('d-none');
//             }
//         })

//     } else if (e.target.classList.contains('newwebdevelopmentcourse')) {
//         nshachright.forEach((element) => {
//             if (element.classList.contains('newwebdevelopmentcourse')) {
//                 element.classList.add('d-flex');
//                 element.classList.remove('d-none');
//             }
//         })
//     } else if (e.target.classList.contains('marketing')) {
//         nshachright.forEach((element) => {

//             if (element.classList.contains('marketing')) {
//                 element.classList.add('d-flex');
//                 element.classList.remove('d-none');
//             }
//         })
//     } else if (e.target.classList.contains('management')) {
//         nshachright.forEach((element) => {

//             if (element.classList.contains('management')) {
//                 element.classList.add('d-flex');
//                 element.classList.remove('d-none');
//             }
//         })
//     } else {
//         nshachright.forEach((element) => {

//             if (element.classList.contains('sorttermcoursetb')) {
//                 element.classList.add('d-flex');
//                 element.classList.remove('d-none');
//             }
//         })
//     }

// }

// Array.from(nshachleft).forEach((element) => {


//     element.addEventListener("mouseover", (e) => {
//         allcourseChange(e)
//     });
// });

//--for mobile--//

// const allCourseBtnf = document.getElementsByClassName('allCourseBtnfp')[0]
//     const zeynep2 = document.getElementById('zeynep2')
//     const custumClose = document.getElementById('custum-close')
//     const zeynepOverlay2 = document.getElementsByClassName('zeynep-overlay2')[0]
//     const hasSubmenu = [...zeynep2.getElementsByClassName('has-submenu')]
//     const submenuHeader = [...zeynep2.getElementsByClassName('submenu-header-phone')]
    
//     allCourseBtnf.addEventListener("click", (e) => {
//         zeynep2.classList.add('opened')
//         zeynepOverlay2.style.display = 'block';
//     });
    
//     zeynepOverlay2.addEventListener("click", (e) => {
//         zeynep2.classList.remove('opened')
//         zeynepOverlay2.style.display = 'none';
//     });

//     hasSubmenu.forEach((element) => {
    
//         element.addEventListener("click", (e) => {
//             e.stopPropagation();
//             e.target.children[1].classList.add('opened')
//             e.target.children[1].classList.add('current')
//         });
//     })


//     submenuHeader.forEach((element) => {
//         element.addEventListener("click", (e) => {
//             e.stopPropagation();
//             e.target.parentNode.classList.remove("opened");
//             e.target.parentNode.classList.remove("current");
//         });
//     })

//     custumClose.addEventListener("click", () => {
//         zeynep2.classList.remove('opened')
//         zeynepOverlay2.style.display = 'none';
//     });
    
    // Cache DOM elements
//    const zeynep = document.getElementById('zeynep');
//     const zeynepOverlay = document.querySelector('.zeynep-overlay');
//     const hasSubmenus = Array.from(zeynep.querySelectorAll('.has-submenu'));
//     const submenuCloseButtons = Array.from(zeynep.querySelectorAll('[data-submenu-close]'));

    // Function to open the submenu
    // function openSubmenu(menuId) {
    //     const submenu = document.getElementById(menuId);
    //     if (submenu) {
    //         submenu.classList.add('opened', 'current');
    //     }
    // }

    // Function to close the submenu
    // function closeSubmenu(menuId) {
    //     const submenu = document.getElementById(menuId);
    //     if (submenu) {
    //         submenu.classList.remove('opened', 'current');
    //     }
    // }

    // Open submenu on click based on the data-submenu attribute
    // hasSubmenus.forEach(element => {
    //     const submenuLink = element.querySelector('[data-submenu]');
    //     if (submenuLink) {
    //         submenuLink.addEventListener('click', (e) => {
    //             e.preventDefault(); // Prevent the default anchor behavior
    //             e.stopPropagation();
    //             const menuId = submenuLink.getAttribute('data-submenu');
    //             openSubmenu(menuId);
    //         });
    //     }
    // });

    // Close submenu on click based on the data-submenu-close attribute
    // submenuCloseButtons.forEach(button => {
    //     button.addEventListener('click', (e) => {
    //         e.preventDefault(); // Prevent the default anchor behavior
    //         e.stopPropagation();
    //         const menuId = button.getAttribute('data-submenu-close');
    //         closeSubmenu(menuId);
    //     });
    // });

    // Close menu on overlay click
    // zeynepOverlay.addEventListener('click', (e) => {
    //     document.querySelectorAll('.submenu.opened').forEach(submenu => {
    //         submenu.classList.remove('opened', 'current');
    //     });
    //     zeynepOverlay.style.display = 'none';
    //     zeynep.classList.remove('opened');
    // });

    // Function to open the main menu (optional if you're using a button to open the main menu)
    // function openMainMenu() {
    //     zeynep.classList.add('opened');
    //     zeynepOverlay.style.display = 'block';
    // }

    // Function to close the main menu
    // function closeMainMenu() {
    //     zeynep.classList.remove('opened');
    //     zeynepOverlay.style.display = 'none';
    // }

    // Example: If you have a button to open the main menu
    // const btnOpen = document.querySelector('.btn-open');
    // if (btnOpen) {
    //     btnOpen.addEventListener('click', openMainMenu);
    // }

    // Example: Close the main menu when clicking a close button (optional)
    // const btnClose = document.querySelector('.btn-close');
    // if (btnClose) {
    //     btnClose.addEventListener('click', closeMainMenu);
    // }
// --------------all course change end-------------//

//--navbar serach data--/
// function SearchDataForm(keyData) {
//     var keyValue = (keyData.value).trim();

//     var xhr = new XMLHttpRequest();
//     xhr.open('POST', 'https://www.theiotacademy.co/SearchData/searchfunction', true);
//     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

//     xhr.onreadystatechange = function() {
//         if (xhr.readyState === XMLHttpRequest.DONE) {
//             if (xhr.status === 200) {
//                 populateDataSearch(JSON.parse(xhr.responseText));
//             } else {
//                 console.log('An error occurred.');
//             }
//         }
//     };

//     xhr.send('keyValue=' + encodeURIComponent(keyValue));

//     function populateDataSearch(data) {
//         console.log(data);
//         var searchMenu = document.getElementById('search-menu');
//         searchMenu.innerHTML = '';

//         var searchData = document.querySelector('.searchData');
//         if (data.length > 0) {
//             searchData.style.display = 'block';
//             data.forEach(function (item) {
//               var listItem = document.createElement('li');
//               listItem.className = 's-course-items';
//               var elem = document.createElement('a');
//               elem.href = 'https://www.theiotacademy.co/' + item.route;
//               elem.className = 'tiamenuitem';
//               elem.textContent = item.title;
//               listItem.appendChild(elem);
//               searchMenu.appendChild(listItem);
//             });
//           } else {
//             searchData.style.display = 'none';
//         }
//     }
// }

// document.addEventListener('click', function(e) {
//     var searchMenu = document.getElementById('search-menu');
//     var searchData = document.querySelector('.searchData');

//     if (!(e.target.id === 'search-menu' || e.target.classList.contains('s-course-items'))) {
//         searchData.style.display = 'none';
//     } else {
//         searchData.style.display = 'block';
//     }
// });

//--scroll up btn --//
// document.addEventListener('DOMContentLoaded', function() {
//     var totop = document.getElementById('scrollUp');

//     if (totop) {
//         window.addEventListener('scroll', function() {
//             if (window.scrollY > 150) {
//                 totop.style.display = 'block';
//             } else {
//                 totop.style.display = 'none';
//             }
//         });

//         totop.addEventListener('click', function() {
//             window.scrollTo({
//                 top: 0,
//                 behavior: 'smooth'
//             });
//         });
//     }
// });

const countries = [
  { name: "India", code: "IN", phone: 91 },
  { name: "Afghanistan", code: "AF", phone: 93 },
  { name: "Albania", code: "AL", phone: 355 },
  { name: "Algeria", code: "DZ", phone: 213 },
  { name: "Andorra", code: "AD", phone: 376 },
  { name: "Angola", code: "AO", phone: 244 },
  { name: "Antigua and Barbuda", code: "AG", phone: 1 },
  { name: "Argentina", code: "AR", phone: 54 },
  { name: "Armenia", code: "AM", phone: 374 },
  { name: "Australia", code: "AU", phone: 61 },
  { name: "Austria", code: "AT", phone: 43 },
  { name: "Azerbaijan", code: "AZ", phone: 994 },
  { name: "Bahamas", code: "BS", phone: 1 },
  { name: "Bahrain", code: "BH", phone: 973 },
  { name: "Bangladesh", code: "BD", phone: 880 },
  { name: "Barbados", code: "BB", phone: 1 },
  { name: "Belarus", code: "BY", phone: 375 },
  { name: "Belgium", code: "BE", phone: 32 },
  { name: "Belize", code: "BZ", phone: 501 },
  { name: "Benin", code: "BJ", phone: 229 },
  { name: "Bhutan", code: "BT", phone: 975 },
  { name: "Bolivia", code: "BO", phone: 591 },
  { name: "Bosnia and Herzegovina", code: "BA", phone: 387 },
  { name: "Botswana", code: "BW", phone: 267 },
  { name: "Brazil", code: "BR", phone: 55 },
  { name: "Brunei", code: "BN", phone: 673 },
  { name: "Bulgaria", code: "BG", phone: 359 },
  { name: "Burkina Faso", code: "BF", phone: 226 },
  { name: "Burundi", code: "BI", phone: 257 },
  { name: "Cabo Verde", code: "CV", phone: 238 },
  { name: "Cambodia", code: "KH", phone: 855 },
  { name: "Cameroon", code: "CM", phone: 237 },
  { name: "Canada", code: "CA", phone: 1 },
  { name: "Central African Republic", code: "CF", phone: 236 },
  { name: "Chad", code: "TD", phone: 235 },
  { name: "Chile", code: "CL", phone: 56 },
  { name: "China", code: "CN", phone: 86 },
  { name: "Colombia", code: "CO", phone: 57 },
  { name: "Comoros", code: "KM", phone: 269 },
  { name: "Congo (Congo-Brazzaville)", code: "CG", phone: 242 },
  { name: "Costa Rica", code: "CR", phone: 506 },
  { name: "Croatia", code: "HR", phone: 385 },
  { name: "Cuba", code: "CU", phone: 53 },
  { name: "Cyprus", code: "CY", phone: 357 },
  { name: "Czech Republic", code: "CZ", phone: 420 },
  { name: "Denmark", code: "DK", phone: 45 },
  { name: "Djibouti", code: "DJ", phone: 253 },
  { name: "Dominica", code: "DM", phone: 1 },
  { name: "Dominican Republic", code: "DO", phone: 1 },
  { name: "Ecuador", code: "EC", phone: 593 },
  { name: "Egypt", code: "EG", phone: 20 },
  { name: "El Salvador", code: "SV", phone: 503 },
  { name: "Equatorial Guinea", code: "GQ", phone: 240 },
  { name: "Eritrea", code: "ER", phone: 291 },
  { name: "Estonia", code: "EE", phone: 372 },
  { name: "Eswatini", code: "SZ", phone: 268 },
  { name: "Ethiopia", code: "ET", phone: 251 },
  { name: "Fiji", code: "FJ", phone: 679 },
  { name: "Finland", code: "FI", phone: 358 },
  { name: "France", code: "FR", phone: 33 },
  { name: "Gabon", code: "GA", phone: 241 },
  { name: "Gambia", code: "GM", phone: 220 },
  { name: "Georgia", code: "GE", phone: 995 },
  { name: "Germany", code: "DE", phone: 49 },
  { name: "Ghana", code: "GH", phone: 233 },
  { name: "Greece", code: "GR", phone: 30 },
  { name: "Grenada", code: "GD", phone: 1 },
  { name: "Guatemala", code: "GT", phone: 502 },
  { name: "Guinea", code: "GN", phone: 224 },
  { name: "Guinea-Bissau", code: "GW", phone: 245 },
  { name: "Guyana", code: "GY", phone: 592 },
  { name: "Haiti", code: "HT", phone: 509 },
  { name: "Honduras", code: "HN", phone: 504 },
  { name: "Hungary", code: "HU", phone: 36 },
  { name: "Iceland", code: "IS", phone: 354 },
  { name: "Indonesia", code: "ID", phone: 62 },
  { name: "Iran", code: "IR", phone: 98 },
  { name: "Iraq", code: "IQ", phone: 964 },
  { name: "Ireland", code: "IE", phone: 353 },
  { name: "Israel", code: "IL", phone: 972 },
  { name: "Italy", code: "IT", phone: 39 },
  { name: "Jamaica", code: "JM", phone: 1 },
  { name: "Japan", code: "JP", phone: 81 },
  { name: "Jordan", code: "JO", phone: 962 },
  { name: "Kazakhstan", code: "KZ", phone: 7 },
  { name: "Kenya", code: "KE", phone: 254 },
  { name: "Kiribati", code: "KI", phone: 686 },
  { name: "Kuwait", code: "KW", phone: 965 },
  { name: "Kyrgyzstan", code: "KG", phone: 996 },
  { name: "Laos", code: "LA", phone: 856 },
  { name: "Latvia", code: "LV", phone: 371 },
  { name: "Lebanon", code: "LB", phone: 961 },
  { name: "Lesotho", code: "LS", phone: 266 },
  { name: "Liberia", code: "LR", phone: 231 },
  { name: "Libya", code: "LY", phone: 218 },
  { name: "Liechtenstein", code: "LI", phone: 423 },
  { name: "Lithuania", code: "LT", phone: 370 },
  { name: "Luxembourg", code: "LU", phone: 352 },
  { name: "Madagascar", code: "MG", phone: 261 },
  { name: "Malawi", code: "MW", phone: 265 },
  { name: "Malaysia", code: "MY", phone: 60 },
  { name: "Maldives", code: "MV", phone: 960 },
  { name: "Mali", code: "ML", phone: 223 },
  { name: "Malta", code: "MT", phone: 356 },
  { name: "Marshall Islands", code: "MH", phone: 692 },
  { name: "Mauritania", code: "MR", phone: 222 },
  { name: "Mauritius", code: "MU", phone: 230 },
  { name: "Mexico", code: "MX", phone: 52 },
  { name: "Micronesia", code: "FM", phone: 691 },
  { name: "Moldova", code: "MD", phone: 373 },
  { name: "Monaco", code: "MC", phone: 377 },
  { name: "Mongolia", code: "MN", phone: 976 },
  { name: "Montenegro", code: "ME", phone: 382 },
  { name: "Morocco", code: "MA", phone: 212 },
  { name: "Mozambique", code: "MZ", phone: 258 },
  { name: "Myanmar (Burma)", code: "MM", phone: 95 },
  { name: "Namibia", code: "NA", phone: 264 },
  { name: "Nauru", code: "NR", phone: 674 },
  { name: "Nepal", code: "NP", phone: 977 },
  { name: "Netherlands", code: "NL", phone: 31 },
  { name: "New Zealand", code: "NZ", phone: 64 },
  { name: "Nicaragua", code: "NI", phone: 505 },
  { name: "Niger", code: "NE", phone: 227 },
  { name: "Nigeria", code: "NG", phone: 234 },
  { name: "North Korea", code: "KP", phone: 850 },
  { name: "North Macedonia", code: "MK", phone: 389 },
  { name: "Norway", code: "NO", phone: 47 },
  { name: "Oman", code: "OM", phone: 968 },
  { name: "Pakistan", code: "PK", phone: 92 },
  { name: "Palau", code: "PW", phone: 680 },
  { name: "Palestine", code: "PS", phone: 970 },
  { name: "Panama", code: "PA", phone: 507 },
  { name: "Papua New Guinea", code: "PG", phone: 675 },
  { name: "Paraguay", code: "PY", phone: 595 },
  { name: "Peru", code: "PE", phone: 51 },
  { name: "Philippines", code: "PH", phone: 63 },
  { name: "Poland", code: "PL", phone: 48 },
  { name: "Portugal", code: "PT", phone: 351 },
  { name: "Qatar", code: "QA", phone: 974 },
  { name: "Romania", code: "RO", phone: 40 },
  { name: "Russia", code: "RU", phone: 7 },
  { name: "Rwanda", code: "RW", phone: 250 },
  { name: "Saint Kitts and Nevis", code: "KN", phone: 1 },
  { name: "Saint Lucia", code: "LC", phone: 1 },
  { name: "Saint Vincent and the Grenadines", code: "VC", phone: 1 },
  { name: "Samoa", code: "WS", phone: 685 },
  { name: "San Marino", code: "SM", phone: 378 },
  { name: "Sao Tome and Principe", code: "ST", phone: 239 },
  { name: "Saudi Arabia", code: "SA", phone: 966 },
  { name: "Senegal", code: "SN", phone: 221 },
  { name: "Serbia", code: "RS", phone: 381 },
  { name: "Seychelles", code: "SC", phone: 248 },
  { name: "Sierra Leone", code: "SL", phone: 232 },
  { name: "Singapore", code: "SG", phone: 65 },
  { name: "Slovakia", code: "SK", phone: 421 },
  { name: "Slovenia", code: "SI", phone: 386 },
  { name: "Solomon Islands", code: "SB", phone: 677 },
  { name: "Somalia", code: "SO", phone: 252 },
  { name: "South Africa", code: "ZA", phone: 27 },
  { name: "South Korea", code: "KR", phone: 82 },
  { name: "South Sudan", code: "SS", phone: 211 },
  { name: "Spain", code: "ES", phone: 34 },
  { name: "Sri Lanka", code: "LK", phone: 94 },
  { name: "Sudan", code: "SD", phone: 249 },
  { name: "Suriname", code: "SR", phone: 597 },
  { name: "Sweden", code: "SE", phone: 46 },
  { name: "Switzerland", code: "CH", phone: 41 },
  { name: "Syria", code: "SY", phone: 963 },
  { name: "Taiwan", code: "TW", phone: 886 },
  { name: "Tajikistan", code: "TJ", phone: 992 },
  { name: "Tanzania", code: "TZ", phone: 255 },
  { name: "Thailand", code: "TH", phone: 66 },
  { name: "Timor-Leste", code: "TL", phone: 670 },
  { name: "Togo", code: "TG", phone: 228 },
  { name: "Tonga", code: "TO", phone: 676 },
  { name: "Trinidad and Tobago", code: "TT", phone: 1 },
  { name: "Tunisia", code: "TN", phone: 216 },
  { name: "Turkey", code: "TR", phone: 90 },
  { name: "Turkmenistan", code: "TM", phone: 993 },
  { name: "Tuvalu", code: "TV", phone: 688 },
  { name: "Uganda", code: "UG", phone: 256 },
  { name: "Ukraine", code: "UA", phone: 380 },
  { name: "United Arab Emirates", code: "AE", phone: 971 },
  { name: "United Kingdom", code: "GB", phone: 44 },
  { name: "United States", code: "US", phone: 1 },
  { name: "Uruguay", code: "UY", phone: 598 },
  { name: "Uzbekistan", code: "UZ", phone: 998 },
  { name: "Vanuatu", code: "VU", phone: 678 },
  { name: "Vatican City", code: "VA", phone: 379 },
  { name: "Venezuela", code: "VE", phone: 58 },
  { name: "Vietnam", code: "VN", phone: 84 },
  { name: "Yemen", code: "YE", phone: 967 },
  { name: "Zambia", code: "ZM", phone: 260 },
  { name: "Zimbabwe", code: "ZW", phone: 263 },
];

let countryCodeValue = "";
for (let i = 0; i < countries.length; i++) {
  if (countries[i].phone) {
    countryCodeValue += `
        <option value="+${countries[i].phone}">+${countries[i].phone} ${countries[i].code}</option>
      `;
  }
}

const elementsToUpdate = [
  "selectedCountryEnq",
  "selectedCountryDemo",
  "selectedCountryDemoo",
  "selectedCountry",
  "CountryDwnlCurriculum",
  "CountryDownloadBr",
  "CountryDownloadBr1",
  "CountryDownloadBr2",
  "commselectedCountryEnq",
];

elementsToUpdate.forEach((id) => {
  const element = document.getElementById(id);
  if (element) {
    element.innerHTML = countryCodeValue;
  }
});

document.addEventListener("DOMContentLoaded", function () {
  setTimeout(function () {
    const modalEl = document.getElementById("OfferpopupmdModal");
    if (modalEl) {
      // Ensure no manual aria-hidden remains
      modalEl.removeAttribute("aria-hidden");
      const myModal = new bootstrap.Modal(modalEl);
      myModal.show();
    }
  }, 40000);
  // setTimeout(function () {
  //   var myModal = new bootstrap.Modal(
  //     document.getElementById('OfferpopupmdModal')
  //   );
  //   myModal.show();
  // }, 40000);

  function reOpenPopup() {
    const baseUrl = "https://www.theiotacademy.co/";
    const currentUrl = window.location.href;
    const modalConfig = {
      [baseUrl]: "OfferpopupmdModal",
    };

    // Check if the current URL starts with the base URL
    const modalId = currentUrl.startsWith(baseUrl)
      ? modalConfig[baseUrl]
      : null;
    if (!modalId) return;

    let modalDisplayed = false;

    function onScroll() {
      if (modalDisplayed) return;

      const sections = document.querySelectorAll(".comonListActive");
      let currentSectionId = "";

      sections.forEach((section) => {
        const sectionTop = section.offsetTop;

        if (window.pageYOffset >= sectionTop - 450) {
          currentSectionId = section.getAttribute("id");
        }
      });

      // Show modal if scrolled to the target section
      if (currentSectionId === "rs-footer") {
        const modalElement = document.getElementById(modalId);
        if (modalElement) {
          const myModal = new bootstrap.Modal(modalElement);
          myModal.show();
          modalDisplayed = true;
        } else {
          console.error(`Modal with ID ${modalId} not found`);
        }
      }
    }

    window.addEventListener("scroll", onScroll);
  }

  reOpenPopup();
});
//darkmode
document.addEventListener('DOMContentLoaded', function() {
	var icon = document.getElementById("dark-mode-icon");
	var icon2 = document.getElementById("dark-mode-icon2");
	var navlogo = document.getElementById("navlogo");
	if (localStorage.getItem('dark-theme') === 'enabled') {
		document.body.classList.add('dark-theme');
		icon.src = "https://www.theiotacademy.co/blog/wp-content/uploads/2024/12/sun.webp";
		navlogo.src = "https://www.theiotacademy.co/assets/dit/images/navbar/logo-white.svg";
		icon2.src = "https://www.theiotacademy.co/blog/wp-content/uploads/2024/12/sun.webp";
	}
	icon.onclick = function(){
		document.body.classList.toggle("dark-theme");
		if(document.body.classList.contains("dark-theme")){
			localStorage.setItem('dark-theme', 'enabled');
			icon.src = "https://www.theiotacademy.co/blog/wp-content/uploads/2024/12/sun.webp";
			navlogo.src = "https://www.theiotacademy.co/assets/dit/images/navbar/logo-white.svg";
		}else{
			localStorage.removeItem('dark-theme');
			icon.src = "https://www.theiotacademy.co/blog/wp-content/uploads/2024/12/moon.webp";
			navlogo.src = "https://www.theiotacademy.co/assets/dit/images/navbar/logo.svg";
		}
	}
	//mobile
	icon2.onclick = function(){
		document.body.classList.toggle("dark-theme");
		if(document.body.classList.contains("dark-theme")){
			localStorage.setItem('dark-theme', 'enabled');
			icon2.src = "https://www.theiotacademy.co/blog/wp-content/uploads/2024/12/sun.webp";
			navlogo.src = "https://www.theiotacademy.co/assets/dit/images/navbar/logo-white.svg";
		}else{
			localStorage.removeItem('dark-theme');
			icon2.src = "https://www.theiotacademy.co/blog/wp-content/uploads/2024/12/moon.webp";
			navlogo.src = "https://www.theiotacademy.co/assets/dit/images/navbar/logo.svg";
		}
	}
});

