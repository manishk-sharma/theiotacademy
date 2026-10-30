//--mega menu--//
// --------------------show on hover start----------//
const button = document.querySelector('.allCourseBtn');
const innerDiv = document.querySelector('.nsh-all-courses-hover');

button.addEventListener('mouseover', () => {
    innerDiv.style.display = 'block';
    button.children[0].style.transition = 'all .3s'
    button.children[0].style.transform = 'rotateZ(-180deg)'

});

innerDiv.addEventListener('mouseover', () => {
    innerDiv.style.display = 'block';
    button.children[0].style.transition = 'all .3s'
    button.children[0].style.transform = 'rotateZ(-180deg)'
});

innerDiv.addEventListener('mouseout', () => {
    innerDiv.style.display = 'none';
    button.children[0].style.transition = 'all .3s'
    button.children[0].style.transform = 'rotateZ(0deg)'
});

button.addEventListener('mouseout', () => {
    innerDiv.style.display = 'none';
    button.children[0].style.transition = 'all .3s'
    button.children[0].style.transform = 'rotateZ(0deg)'
});


// --------------------show on hover end----------//

// --------------all course change start-------------//

const nshachleft = document.getElementsByClassName('nsh-ach-left')[0].children
const nshachright = [...document.getElementsByClassName('nsh-ach-right')]
const allcourseChange = (e) => {
    Array.from(nshachleft).forEach((element) => {
        element.classList.remove('courses-active-tab2');
        element.children[1].classList.remove('courses-active-icon');
        element.children[1].style.transform = 'rotateZ(0deg)'
    });
    e.target.classList.add('courses-active-tab2')
    e.target.children[1].classList.add('courses-active-icon')
    e.target.children[1].style.transform = 'rotateZ(90deg)';

    nshachright.forEach((element) => {
        element.classList.remove('d-flex');
        element.classList.add('d-none');
    });

    if (e.target.classList.contains('finanace')) {
        nshachright.forEach((element) => {
            // console.log("reached here", element)
            if (element.classList.contains('finanace')) {
                element.classList.add('d-flex');
                element.classList.remove('d-none');
            }
        })
    } else if (e.target.classList.contains('newanalyticscourse')) {
        nshachright.forEach((element) => {
            if (element.classList.contains('newanalyticscourse')) {
                element.classList.add('d-flex');
                element.classList.remove('d-none');
            }
        })

    } else if (e.target.classList.contains('analytics')) {
        nshachright.forEach((element) => {
            if (element.classList.contains('analytics')) {
                element.classList.add('d-flex');
                element.classList.remove('d-none');
            }
        })

    } else if (e.target.classList.contains('technology')) {
        nshachright.forEach((element) => {
            if (element.classList.contains('technology')) {
                element.classList.add('d-flex');
                element.classList.remove('d-none');
            }
        })

    } else if (e.target.classList.contains('newwebdevelopmentcourse')) {
        nshachright.forEach((element) => {
            if (element.classList.contains('newwebdevelopmentcourse')) {
                element.classList.add('d-flex');
                element.classList.remove('d-none');
            }
        })
    } else if (e.target.classList.contains('marketing')) {
        nshachright.forEach((element) => {

            if (element.classList.contains('marketing')) {
                element.classList.add('d-flex');
                element.classList.remove('d-none');
            }
        })
    } else {
        nshachright.forEach((element) => {

            if (element.classList.contains('management')) {
                element.classList.add('d-flex');
                element.classList.remove('d-none');
            }
        })
    }

}

Array.from(nshachleft).forEach((element) => {


    element.addEventListener("mouseover", (e) => {
        allcourseChange(e)
    });
});

//--for mobile--//

const button2 = document.querySelector('.allCourseBtnfp');
const buttonclose = document.querySelector('.allCourseBtnclose');
const innerDiv2 = document.querySelector('.nsh-all-courses-hover');

button2.addEventListener('click', () => {
    innerDiv2.style.display = 'block';
    buttonclose.style.display = 'block';
    button2.style.display = 'none';
    button2.children[0].style.transition = 'all .3s'
    button2.children[0].style.transform = 'rotateZ(-180deg)'

});
buttonclose.addEventListener('click', () => {
    innerDiv2.style.display = 'none';
    buttonclose.style.display = 'none';
    button2.style.display = 'block';
    button2.children[0].style.transition = 'all .3s'
    button2.children[0].style.transform = 'rotateZ(-180deg)'
});
// --------------all course change end-------------//

//--navbar serach data--/
function SearchDataForm(keyData) {
    var keyValue = (keyData.value).trim();

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'SearchData/searchfunction', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                populateDataSearch(JSON.parse(xhr.responseText));
            } else {
                console.log('An error occurred.');
            }
        }
    };

    xhr.send('keyValue=' + encodeURIComponent(keyValue));

    function populateDataSearch(data) {
        console.log(data);
        var searchMenu = document.getElementById('search-menu');
        searchMenu.innerHTML = '';

        var searchData = document.querySelector('.searchData');
        if (data.length > 0) {
            searchData.style.display = 'block';
            data.forEach(function(item) {
                var elem = document.createElement('a');
                elem.href = 'https://www.theiotacademy.co/' + item.route;
                elem.className = 'tiamenuitem';

                var listItem = document.createElement('li');
                listItem.className = 's-course-items';
                listItem.textContent = item.title;

                elem.appendChild(listItem);
                searchMenu.appendChild(elem);
            });
        } else {
            searchData.style.display = 'none';
        }
    }
}

document.addEventListener('click', function(e) {
    var searchMenu = document.getElementById('search-menu');
    var searchData = document.querySelector('.searchData');

    if (!(e.target.id === 'search-menu' || e.target.classList.contains('s-course-items'))) {
        searchData.style.display = 'none';
    } else {
        searchData.style.display = 'block';
    }
});

//--scroll up btn --//
document.addEventListener('DOMContentLoaded', function() {
    var totop = document.getElementById('scrollUp');

    if (totop) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 150) {
                totop.style.display = 'block';
            } else {
                totop.style.display = 'none';
            }
        });

        totop.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});