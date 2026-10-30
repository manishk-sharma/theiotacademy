
const select_box1 = document.querySelector('#options1');
const search_box1 = document.querySelector('#search-box1');
const input_box1 = document.querySelector('#tel1');
const selected_option1 = document.querySelector('#selected-option1 div');

console.log(select_box1);
let options1 = null;

for (country1 of countries) {
const option1 = `
<li class="option" id="option1">
<div>
    <span class="iconify" id="iconify1" data-icon="flag:${country1.code.toLowerCase()}-4x3"></span>
    <span class="country-name" id="country-nmcd">${country1.name}</span>
</div>
<strong>+${country1.phone}</strong>
</li> `;



select_box1?.querySelector('ol')?.insertAdjacentHTML('beforeend', option1);

options1 = document.querySelectorAll('#option1');
}

function selectOption1() {
console.log(this);
const icon1 = this.querySelector('#iconify1').cloneNode(true),
phone_code1 = this.querySelector('strong').cloneNode(true);

selected_option1.innerHTML = '';
selected_option1.append(icon1, phone_code1);

// input_box1.value = phone_code1.innerText;

select_box1.classList.remove('active');
selected_option1.classList.remove('active');

search_box1.value = '';
select_box1.querySelectorAll('.hide').forEach(el => el.classList.remove('hide'));
}

function searchCountry1() {
let search_query1 = search_box1.value.toLowerCase();
for (option1 of options1) {
let is_matched = option1.querySelector('#country-nmcd').innerText.toLowerCase().includes(search_query1);
option1.classList.toggle('hide', !is_matched)
}
}


selected_option1.addEventListener('click', () => {
select_box1.classList.toggle('active');
selected_option1.classList.toggle('active');
})

options1.forEach(option1 => option1.addEventListener('click', selectOption1));
search_box1.addEventListener('input', searchCountry1);


select_box2 = document.querySelector('#options2'),
search_box2 = document.querySelector('#search-box2'),
input_box2 = document.querySelector('#tel2'),
selected_option2 = document.querySelector('#selected-option2 div');

let options2 = null;

for (country2 of countries) {
const option2 = `
<li class="option" id="option2">
<div>
    <span class="iconify" id="iconify2" data-icon="flag:${country2.code.toLowerCase()}-4x3"></span>
    <span class="country-name" id="country-nmcd2">${country2.name}</span>
</div>
<strong>+${country2.phone}</strong>
</li> `;

select_box2.querySelector('ol').insertAdjacentHTML('beforeend', option2);
options2 = document.querySelectorAll('#option2');
}

function selectOption2() {
console.log(this);
const icon2 = this.querySelector('#iconify2').cloneNode(true),
phone_code2 = this.querySelector('strong').cloneNode(true);

selected_option2.innerHTML = '';
selected_option2.append(icon2, phone_code2);

// input_box1.value = phone_code1.innerText;

select_box2.classList.remove('active');
selected_option2.classList.remove('active');

search_box2.value = '';
select_box2.querySelectorAll('.hide').forEach(el => el.classList.remove('hide'));
}

function searchCountry2() {
let search_query2 = search_box2.value.toLowerCase();
for (option2 of options2) {
let is_matched = option2.querySelector('#country-nmcd2').innerText.toLowerCase().includes(search_query2);
option2.classList.toggle('hide', !is_matched)
}
}

selected_option2.addEventListener('click', () => {
select_box2.classList.toggle('active');
selected_option2.classList.toggle('active');
})

options2.forEach(option2 => option2.addEventListener('click', selectOption2));
search_box2.addEventListener('input', searchCountry2);