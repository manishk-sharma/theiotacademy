 //  change carousal points start------------------

 const nhscustomcircles = [...document.querySelector('.nhs-custom-circles').children]

 const carouselExampleControls = document.querySelector('#carouselExampleControls')
 const carouseLeftCustom = document.querySelector('.carousel-left-custom')
 const carouselRightCustom = document.querySelector('.carousel-right-custom')

 let mouseondiv = 0
 let currentspan = 0
 let intervalId = ''

 // Your setInterval function
 function intervalFunction() {

     if (!mouseondiv) {
         nhscustomcircles.forEach(element => {
             nhscustomcircles[currentspan].classList.remove('nhs-custom-circle-active')
         });
         currentspan++
         if (currentspan === 4) {
             currentspan = 0
         }

         nhscustomcircles[currentspan].classList.add('nhs-custom-circle-active')
     }
 }

 let timeInterval = 3400
 if (window.innerWidth < 800) {

     timeInterval = 1800

     carouselExampleControls.setAttribute('data-interval', 1800);

 }


 carouseLeftCustom.onclick = function() {
     clearInterval(intervalId);
     nhscustomcircles.forEach(element => {
         nhscustomcircles[currentspan].classList.remove('nhs-custom-circle-active')
     });
     currentspan--
     if (currentspan === -1) {
         currentspan = 3
     }

     nhscustomcircles[currentspan].classList.add('nhs-custom-circle-active')
 };

 carouselRightCustom.onclick = function() {
     clearInterval(intervalId);
     nhscustomcircles.forEach(element => {
         nhscustomcircles[currentspan].classList.remove('nhs-custom-circle-active')
     });
     currentspan++

     if (currentspan === 4) {
         currentspan = 0
     }
     nhscustomcircles[currentspan].classList.add('nhs-custom-circle-active')
 };




 const startspanChange = () => {


     intervalId = setInterval(intervalFunction, timeInterval);

     carouselExampleControls.addEventListener('mouseenter', () => {
         mouseondiv = true;
         clearInterval(intervalId);
     });

     carouselExampleControls.addEventListener('mouseleave', () => {
         mouseondiv = false;
         intervalId = setInterval(intervalFunction, timeInterval);
     });


 }



 window.addEventListener('load', startspanChange);

 //  change carousal points end------------------


 // tab functionality start----------------------------
 const tabUpper = document.getElementsByClassName('nhs-7-1')[0].children
 const nhs7ChangeUpper = document.getElementsByClassName('nhs-7-change-upper')[0].children

 const tabChange = (e) => {

     Array.from(tabUpper).forEach((element) => {
         element.classList.remove('career-tab-active');
         element.classList.remove('exr-tab-active');
         element.classList.remove('placement-tab-active');
         element.classList.remove('on-off-tab-active');
     });


     Array.from(nhs7ChangeUpper).forEach((element) => {
         element.classList.remove('d-block');
         element.classList.add('d-none');
     });

     if (e.target.innerHTML === 'Career Assistance') {
         nhs7ChangeUpper[0].classList.add('d-block');
         e.target.classList.add('career-tab-active')

     } else if (e.target.innerHTML === 'Exclusive Resources') {
         nhs7ChangeUpper[1].classList.add('d-block');
         e.target.classList.add('exr-tab-active')
     } else if (e.target.innerHTML === 'Placement Cell') {
         nhs7ChangeUpper[2].classList.add('d-block');
         e.target.classList.add('placement-tab-active')
     } else {
         nhs7ChangeUpper[3].classList.add('d-block');
         e.target.classList.add('on-off-tab-active')
     }

 }

 Array.from(tabUpper).forEach((element) => {
     element.addEventListener("click", (e) => {
         tabChange(e)
     });
 });

 // tab functionality end----------------------------




 // searchSpan.addEventListener("mouseleave", () => {
 //     document.getElementsByClassName('nhs-search-input')[0].style.width = "0"

 // })

 // search hover effect start------------------



 // course change tab start------------------

 const nhs41upper = document.getElementsByClassName('nhs-4-1')[0].children

 const nhs42Each = [...document.getElementsByClassName('nhs-4-2-each')]





 const courseChange = (e) => {




     Array.from(nhs41upper).forEach((element) => {
         element.classList.remove('courses-active-tab');
         element.children[2].classList.remove('courses-active-icon');
         element.children[2].style.transform = 'rotateZ(0deg)'
     });
     e.target.classList.add('courses-active-tab')
     e.target.children[2].classList.add('courses-active-icon')
     e.target.children[2].style.transform = 'rotateZ(90deg)';



     nhs42Each.forEach((element) => {
         element.classList.remove('d-block');
         element.classList.add('d-none');
     });

     if (e.target.classList.contains('nhsds')) {
         nhs42Each.forEach((element) => {
             // console.log("reached here", element)
             if (element.classList.contains('nhsds')) {
                 element.classList.add('d-block')
             }
         })
     } else if (e.target.classList.contains('nhsdm')) {
         nhs42Each.forEach((element) => {

             if (element.classList.contains('nhsdm')) {
                 element.classList.add('d-block')
             }
         })

     }
     else if (e.target.classList.contains('selfdamlgenai')) {
        nhs42Each.forEach((element) => {

            if (element.classList.contains('selfdamlgenai')) {
                element.classList.add('d-block')
            }
        })

    }
     else if (e.target.classList.contains('nhsdas')) {
         nhs42Each.forEach((element) => {

             if (element.classList.contains('nhsdas')) {
                 element.classList.add('d-block')
             }
         })

     }

      else if (e.target.classList.contains('nhspy')) {

         nhs42Each.forEach((element) => {

             if (element.classList.contains('nhspy')) {
                 element.classList.add('d-block')
             }
         })
     } else if (e.target.classList.contains('nhsesiot')) {
         nhs42Each.forEach((element) => {

             if (element.classList.contains('nhsesiot')) {
                 element.classList.add('d-block')
             }
         })
     } else {
         nhs42Each.forEach((element) => {

             if (element.classList.contains('nhsjava')) {
                 element.classList.add('d-block')
             }
         })
     }

 }

 Array.from(nhs41upper).forEach((element) => {


     element.addEventListener("click", (e) => {
         courseChange(e)
     });
 });

 // course change tab end------------------




 //  sliding section start------------------


 const sliderContainer = document.getElementsByClassName('products-container')[0]

 const eachslider = [...document.getElementsByClassName('products')]

 const eachElement = [...document.getElementsByClassName('nhs-3-each')]


 eachElement.forEach((element) => {
     element.addEventListener('mouseenter', (e) => {
         eachslider.forEach((innerelement) => {
             innerelement.style.animationPlayState = 'paused';
         })
     })
     element.addEventListener('mouseleave', (e) => {
         eachslider.forEach((innerelement) => {
             innerelement.style.animationPlayState = 'running';
         })
     })

 })



 //  sliding section end------------------




 //  animate at scroll start------------------


 const nhs111 = document.querySelector('.nhs-11-1');
 const nhs112 = document.querySelector('.nhs-11-2');
 const nhs113 = document.querySelector('.nhs-11-3');
 const nhs114 = document.querySelector('.nhs-11-4');
 const productsContainer = document.querySelector('.products-container');
 const products = document.getElementsByClassName('products');


 window.addEventListener("scroll", (e) => {
     const scrollY = window.scrollY;


     if (scrollY >= 5387) {
         nhs111.style.animation = 'progress1 2s 1 forwards'
         const styleElement1 = document.createElement('style');
         const cssRule1 = `
.nhs-11-1::before {
 animation: progress1 2s 1 forwards;
}
`;
         styleElement1.appendChild(document.createTextNode(cssRule1));
         document.head.appendChild(styleElement1);

         nhs112.style.animation = 'progress2 2s 1 forwards'
         const styleElement2 = document.createElement('style');
         const cssRule2 = `
.nhs-11-2::before {
 animation: progress2 2s 1 forwards;
}
`;
         styleElement2.appendChild(document.createTextNode(cssRule2));
         document.head.appendChild(styleElement2);


         nhs113.style.animation = 'progress3 2s 1 forwards'
         const styleElement3 = document.createElement('style');
         const cssRule3 = `
.nhs-11-3::before {
 animation: progress3 2s 1 forwards;
}
`;
         styleElement3.appendChild(document.createTextNode(cssRule3));
         document.head.appendChild(styleElement3);



         nhs114.style.animation = 'progress4 2s 1 forwards'
         const styleElement4 = document.createElement('style');
         const cssRule4 = `
.nhs-11-4::before {
 animation: progress4 2s 1 forwards;
}
`;
         styleElement4.appendChild(document.createTextNode(cssRule4));
         document.head.appendChild(styleElement4);


     }
 })


 //  animate at scroll end------------------

 //  count increase start------------------


 const nhs6innerlast = [...document.querySelector('.nhs-6-inner').children][4];
 const nhs6inner = [...document.querySelector('.nhs-6-inner').children].slice(0, 4);

 let interid = ''
 let finalnum

 const coutIncrease = (e) => {

     let count = 0;
     // console.log("reached here", +e.target.children[1].innerHTML.split('+')[0])

     let n = +e.target.children[1].innerHTML.split('+')[0]
     finalnum = n
     interid = setInterval(() => {

         if (n < 20) {
             count++
         }
         if (n > 20 && n < 40) {
             count = count + 2
         }
         if (n > 50 && n<600) {
            count = count + 20
        }
        if (n > 1000) {
            count = count + 300
        }


         e.target.children[1].innerHTML = count + '+'

         if (count > n) {
             clearInterval(interid)
             e.target.children[1].innerHTML = finalnum + '+'
         }

     }, 50);

     e.target.children[0].style.transition = 'all 0.5s';
     e.target.children[0].style.transform = 'scale(1.3)';
 }

 Array.from(nhs6inner).forEach((element) => {

     element.addEventListener("mouseenter", (e) => {
         coutIncrease(e)
     });

     element.addEventListener("mouseleave", (e) => {
         let n = +e.target.children[1].innerHTML.split('+')[0]

         clearInterval(interid)
         e.target.children[1].innerHTML = finalnum + '+'
         e.target.children[0].style.transform = 'scale(1)';
     });
 });

 nhs6innerlast.addEventListener("mouseenter", (e) => {

     let count = 0;
     let n = +e.target.children[1].innerHTML.split(' ')[0]
     console.log("reached here", n)
     finalnum = n
     interid = setInterval(() => {

         count++

         e.target.children[1].innerHTML = count + ' LPA'

         if (count === n) {
             clearInterval(interid)
             e.target.children[1].innerHTML = finalnum + ' LPA'
         }
     }, 50);

     e.target.children[0].style.transition = 'all 0.5s';
     e.target.children[0].style.transform = 'scale(1.3)';
 });

 nhs6innerlast.addEventListener("mouseleave", (e) => {
     let n = +e.target.children[1].innerHTML.split('+')[0]

     clearInterval(interid)
     e.target.children[1].innerHTML = finalnum + ' LPA'
     e.target.children[0].style.transform = 'scale(1)';

 });


 //  count increase end------------------

 //  translating hidden start------------------
//  var newElement = document.createElement('div');
//  newElement.textContent = '';
//  newElement.classList.add('body--after')
//  document.body.insertAdjacentElement('afterend', newElement);

//  const hideSection = () => {

//      newElement.style.display = "none";
//      document.querySelector('.nhs-13-2-top-upper').style.transform = "translateY(50%)";
//      document.querySelector('.nhs-13').style.overflow = "hidden";

//      // document.querySelector('html').style.overflow = 'scroll'
//  }

//  newElement.addEventListener('click', hideSection);
//  const showSection = () => {
//      newElement.style.display = "block";
//      // document.querySelector('html').style.overflow = 'hidden'
//      document.querySelector('.nhs-13-2-top-upper').style.transform = "translateY(-108%)";
//      document.querySelector('.nhs-13').style.overflow = "visible";

//  }

//   document.querySelector('.nhs-13-button').addEventListener('click', showSection);

 //  translating hidden end------------------

 //  section 13 animation start------------------//


//  const backbutton = document.querySelector('.nhs-13-radio-form-bbtn')
//  const nextbutton = document.querySelector('.nhs-13-radio-form-nbtn')
//  const innerform = document.querySelector('.nhs-13-opf-inner')
//  const nhs132rinner = document.querySelector('.nhs-13-2-r-inner')
//  const nhs132rinner1 = [...document.getElementsByClassName('nhs-13-2-r-inner-1')]
//  const innerformtop = [...document.getElementsByClassName('nhs-13-op-form')]
//   const rightTop = [...document.getElementsByClassName('nhs-13-2-r-ii-top')[0].children]



//  const imageCollection = ['section13img1', 'section13img2', 'section13img3', 'section13img4', 'section13img5', 'section13img6', 'section13img7', 'section13img8', 'section13img9', 'section13img10']



//  let imageIndex = 0
//  let degreeByRotate = 0
//  let nextbuttonClicked = 0
//  let backbuttonClicked = 0
//  let optionSelected = 0
//  let buttonClickCount = 0;
//  const form = document.querySelector('.nhs-13-opf-inner');
// const radioButtons = form.querySelectorAll('input[type="radio"]');



//  for (const radioButton of radioButtons) {


//      radioButton.addEventListener("change", function() {
//          optionSelected = 1
//      });


//  }


//  const ShowButtonEffect = (e) => {


//      console.log("reached here optionSelected", optionSelected)

//      if (optionSelected === 1) {

//          startAnimation()


//      }

//  }



//  const startAnimation = () => {

//      optionSelected = 0
//      if (imageIndex < 9) {
//          const form = document.querySelectorAll('.nhs-13-opf-inner')[imageIndex + 1];

//          const radioButtons = form.querySelectorAll('input[type="radio"]');


//          for (const radioButton of radioButtons) {
//              radioButton.addEventListener("change", function() {
//                  optionSelected = 1
//              });

//              if (radioButton.checked) {
//                  optionSelected = 1
//              }

//          }
//      }




//      nextbuttonClicked = 1;
//      buttonClickCount++;

//      const rotatingImage = document.querySelector('.nhs-13-rotating')
//      const nhs13fimg = document.querySelector('.nhs-13-f-img')


//      nhs13fimg.style.opacity = 0;




//      setTimeout(function() {



//          imageIndex++;
//          nhs13fimg.src = `<?php echo aws_asset_url() ?>newHomePage/${imageCollection[imageIndex]}.webp`
//          nhs13fimg.style.opacity = 1;

//          nhs132rinner1.forEach(element => {

//              element.style.opacity = '0'
//              element.classList.add('height-zero')

//          });

//          if (imageIndex === 10) {

//              document.querySelector('.nhs-13-2-top').style.display = 'none'
//              document.querySelector('.nhs-13-2-1').style.display = 'block'


//              imageIndex = 0;
//          } else {
//              nhs132rinner1[imageIndex].classList.remove('height-zero')
//              nhs132rinner1[imageIndex].style.opacity = '1'
//              nhs132rinner1[imageIndex].style.position = 'absolute'
//              nhs132rinner1[imageIndex].style.zIndex = '100'
//              nhs132rinner1[imageIndex - 1].style.zIndex = '1'
//              nhs132rinner.style.animation = 'nhs13animation 1s ease-in-out forwards'
//              setTimeout(() => {
//                  nhs132rinner.style.animation = ''
//              }, 1000);
//          }

//      }, 250);

//      if (buttonClickCount !== 0) {
//          nextbutton.style.left = '20px'
//          backbutton.style.display = 'inline'
//          backbutton.style.opacity = 1
//      }
//      degreeByRotate = degreeByRotate + 40;

//      rotatingImage.style.transform = `rotate(${degreeByRotate}deg)`

//  }

//  const reverseAnimation = () => {
//      buttonClickCount--;
//      backbuttonClicked = 1
//      optionSelected = 1



//      const rotatingImage = document.querySelector('.nhs-13-rotating')
//      const nhs13fimg = document.querySelector('.nhs-13-f-img')


//      nhs13fimg.style.opacity = 0;


//      setTimeout(function() {



//          imageIndex--;
//          console.log("reached here reverse not zero", imageIndex)
//          nhs13fimg.src = `<?php echo asset_url() ?>images/newHomePage/${imageCollection[imageIndex]}.webp`
//          nhs13fimg.style.opacity = 1;




//          nhs132rinner1.forEach(element => {

//              element.style.opacity = '0'
//              element.classList.add('height-zero')

//          });
//          nhs132rinner1[imageIndex].style.opacity = '1'
//          nhs132rinner1[imageIndex].style.position = 'absolute'
//          nhs132rinner1[imageIndex].style.zIndex = '100'
//          nhs132rinner1[imageIndex + 1].style.zIndex = '1'
//          nhs132rinner1[imageIndex].classList.remove('height-zero')
//          nhs132rinner.style.animation = 'nhs13animation 1s ease-in-out forwards'

//          setTimeout(() => {
//              nhs132rinner.style.animation = ''
//          }, 1000);


//          if (imageIndex === 10) {

//              imageIndex = 0;
//          }
//      }, 250);


//      if (buttonClickCount === 0) {
//          nextbutton.style.left = '-115px'
//          backbutton.style.display = 'inline'
//          backbutton.style.opacity = 1
//      }
//      degreeByRotate = degreeByRotate - 40;


//      rotatingImage.style.transform = `rotate(${degreeByRotate}deg)`

//  }

//  nextbutton.addEventListener('click', ShowButtonEffect);
//  backbutton.addEventListener('click', reverseAnimation);
 //  section 13 animation end------------------//



 //  section 8 counting start------------------//


 const nhs8h4 = [...document.querySelectorAll(".nhs-8-h4")];
 let clrinterid = "";
 let alreadyRun = 0;
 // let finalnum
 
 const coutIncreasefornhs8 = (e) => {
     let count = 0;
     alreadyRun = 1;
 
     clrinterid = setInterval(() => {
         nhs8h4[0].innerHTML = count.toFixed(1);
         nhs8h4[1].innerHTML = count.toFixed(1);
         nhs8h4[2].innerHTML = count.toFixed(1);
         nhs8h4[3].innerHTML = count.toFixed(1);
 
         if (count > 4.8) {
             nhs8h4[0].innerHTML = 4.9;
             clearInterval(clrinterid);
         }
         if (count > 4.7) {
             nhs8h4[1].innerHTML = 4.8;
         }
 
         if (count > 4.6) {
             nhs8h4[2].innerHTML = 4.7;
         }
 
         if (count > 4.2) {
             nhs8h4[3].innerHTML = 4.3;
         }
 
         if (count < 4) {
             count = count + 1;
         } else {
             count = count + 0.1;
         }
     }, 250);
 };
 
 window.addEventListener("scroll", (e) => {
     const scrollY = window.scrollY;
     if (scrollY >= 3300 && alreadyRun == 0) {
         coutIncreasefornhs8(e);
     }
 });

 //  section 8 counting start------------------//

 //   ------------------nhs-4 phone start------------------

 const nhs41upperphone = [...document.getElementsByClassName('card-header2')]
 const nhsbuttonEachPhone = [...document.getElementsByClassName('nhs-4-1-each-1-ph')]



 const courseChangePhone = (e) => {

     nhs41upperphone.forEach((element) => {
         element.classList.remove('courses-active-tab-phone');
     });

     nhsbuttonEachPhone.forEach((element) => {
         element.children[1].style.color = 'black'
         element.children[2].classList.remove('courses-active-icon');
         element.children[2].style.transform = 'rotateZ(0deg)'
     })

     e.target.parentNode.parentNode.classList.add('courses-active-tab-phone')
     e.target.children[0].children[1].style.color = 'white'
     console.log("reached here", )
     e.target.children[0].children[2].classList.add('courses-active-icon')
     e.target.children[0].children[2].style.transform = 'rotateZ(90deg)';

 }

 nhs41upperphone.forEach((element) => {
     element.addEventListener("click", (e) => {
         // console.log("reached here", e.target.parentNode.parentNode)
         console.log("reached here card clicked", e.target.children[0].children[1].style.color = 'white')
         courseChangePhone(e)
     });
 });



 //   ------------------nhs-4 phone end------------------
