// Array of quiz questions, options, and image URLs
const quizData = [
  {
    question: 'What is your primary motivation for taking a course?',
    options: [
      'Career advancement',
      'Personal development',
      'Exploring new interests',
      "I'm not sure."
    ],
    image: 'https://www.theiotacademy.co/assets/dit/images/quiz/s1.webp'
  },
  {
    question: 'Which of these fields interests you the most?',
    options: [
      'Technology and IT',
      'Business and Entrepreneurship',
      'Arts and Creativity',
      'Science and Research'
    ],
    image: 'https://www.theiotacademy.co/assets/dit/images/quiz/s2.webp'
  },
  {
    question: 'How much time can you commit to the course per week?',
    options: ['Less than 5 hours', '5-10 hours', '10-20 hours', '10-30 hours'],
    image: 'https://www.theiotacademy.co/assets/dit/images/quiz/s3.webp'
  },
  {
    question:
      'Which learning format do you prefer?',
    options: [
      'Self-paced online courses',
      'Instructor-led online courses',
      'In-person classroom setting',
      "I'm not sure."
    ],
    image: 'https://www.theiotacademy.co/assets/dit/images/quiz/s4.webp'
  },
  {
    question: 'Do you like working with other people?',
    options: [
      "Yes! There's nothing better than working with other people to get things done!",
      'Yes! But I sometimes like working alone.',
      'It depends on the situation.',
      "I'm not sure."
    ],
    image: 'https://www.theiotacademy.co/assets/dit/images/quiz/s5.webp'
  },
  {
    question: 'Do you want an international career?',
    options: [
      'The world is mine!',
      'I dream of living somewhere else!',
      "I'd like to work abroad for a time.",
      'I want to stay close to home.'
    ],
    image: 'https://www.theiotacademy.co/assets/dit/images/quiz/s6.webp'
  },
  {
    question:
      'What type of courses are you interested in?',
    options: [
      'Academic courses (e.g., school or university subjects).',
      'Professional development and skill-building courses.',
      'Personal interest or hobby-based courses.',
      'A mix of different course types.'
    ],
    image: 'https://www.theiotacademy.co/assets/dit/images/quiz/s7.webp'
  },
  {
    question: 'What is your budget for a course tool?',
    options: [
      "I'm willing to invest in a premium course with advanced features.",
      'I have a moderate budget and can afford mid-range options.',
      "I'm looking for a low-cost course",
      "I'm not sure."
    ],
    image: 'https://www.theiotacademy.co/assets/dit/images/quiz/s8.webp'
  },
  {
    question: 'What is your preferred course duration?',
    options: [
      'Short and intensive',
      'Semester or academic year.',
      "Flexible, I'm open to different durations.",
      "I'm not sure."
    ],
    image: 'https://www.theiotacademy.co/assets/dit/images/quiz/s9.webp'
  },
  {
    question:
      'How important is hands-on practice and real-world projects in the course?',
    options: [
      'Extremely important - I want practical experience.',
      'Important, but theory is also valuable.',
      'Not a top priority; I prefer theory.',
      "I'm not sure."
    ],
    image: 'https://www.theiotacademy.co/assets/dit/images/quiz/s10.webp'
  }
];

let currentQuestionIndex = 0;
let selectedAnswers = new Array(quizData.length).fill(null);
// console.log(selectedAnswers);
window.onload = loadQuestion;
function loadQuestion() {
  const questionData = quizData[currentQuestionIndex];
  document.getElementById('question').textContent = questionData.question;
  document.getElementById('option0').textContent = questionData.options[0];
  document.getElementById('option1').textContent = questionData.options[1];
  document.getElementById('option2').textContent = questionData.options[2];
  document.getElementById('option3').textContent = questionData.options[3];
  document.getElementById('question-image').src = questionData.image; // Set the image

  // Update the quiz number (e.g., 1/10)
  document.getElementById('quiz-number').textContent = `${
    currentQuestionIndex + 1
  }/${quizData.length}`;

  // Show or hide the "Back" button based on the question index
  if (currentQuestionIndex > 0) {
    document.getElementById('back-btn').style.display = 'inline-block';
  } else {
    document.getElementById('back-btn').style.display = 'none';
  }

  // Automatically select the first option by default
  const radioButtons = document.querySelectorAll('input[name="option"]');
  if (selectedAnswers[currentQuestionIndex] !== null) {
    radioButtons[selectedAnswers[currentQuestionIndex]].checked = true;
  } else {
    radioButtons[0].checked = true; // Always select the first option
  }
}

function nextQuestion() {
  const selectedOption = document.querySelector('input[name="option"]:checked');
  if (!selectedOption) {
    alert('Please select an option.');
    return;
  }
  // Save the selected answer
  selectedAnswers[currentQuestionIndex] = parseInt(selectedOption.value);
  // Move to the next question
  currentQuestionIndex++;

  // If the last question is reached
  if (currentQuestionIndex === quizData.length) {
    selectedAnswers[currentQuestionIndex - 1] = parseInt(selectedOption.value);

    document.getElementById('submit-btn').style.display = 'block';
    document.getElementById('back-image').style.transform = 'rotate(45deg)';
    if (currentQuestionIndex == 10) {
      document.getElementById('next-btn').style.display = 'none';
      document.getElementById('back-btn').style.display = 'none';
    }
  } else {
    loadQuestion();
  }
}

function previousQuestion() {
  if (currentQuestionIndex > 0) {
    currentQuestionIndex--;
    document.getElementById('submit-btn').style.display = 'none';
    document.getElementById('next-btn').style.display = 'inline-block';
    loadQuestion();
  }
}

let result = [];
function submitQuiz() {
  quizData.forEach((item, index) => {
    const answerIndex = selectedAnswers[index];
    // console.log(answerIndex);
    const selectedAnswer =
      answerIndex !== null ? item.options[answerIndex] : 'No answer selected';

    result.push({
      question: item.question,
      selectedAnswer: selectedAnswer
    });
  });
  document.querySelector('#quiz').classList.add('d-none');
  document.querySelector('#left-side').classList.add('d-none');
  // document.querySelector('#quizform').classList.remove('d-none');
  document.querySelector('#quizform').style.display = 'block';
  document.querySelector('.quiz-container').style.width = '100%';
}

function submitForm(event) {
  event.preventDefault();
  const fullname = document.getElementById('fullname').value;
  const email = document.getElementById('email').value;
  const countrycoden = document.getElementById('selectedCountryEnq').value;
  const mobileno = document.getElementById('mobileno').value;
  const workexperience = document.getElementById('qualification').value;

  // if (!fullname || !email || !countrycoden || !mobileno || !workexperience) {
  //   alert('Please fill in all required fields.');
  //   return;
  // }

  result.push({
    fullname: fullname,
    email: email,
    countrycode: countrycoden,
    mobileno: mobileno,
    workexperience: workexperience
  });

  //console.log('Form data:', result);

  // You can hide the form and show a thank you message as needed.
  // document.querySelector('#quizform').classList.add('d-none');
  // document.querySelector('#thankyou').classList.remove('d-none');
  // setTimeout(function () {
  //     location.reload();
  // }, 4000);

  const baseurly = 'https://www.theiotacademy.co/';
  const formUrl = baseurly + 'LiveLead/quiz_homepage_submit';
  document.getElementById('enqform-overlay').style.display = 'block';

  fetch(formUrl, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(result)
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.message === 'error') {
        alert(removeTags(data.response));
        document.getElementById('enqform-overlay').style.display = 'none';
      } else if (data.message === 'success') {
        document.querySelector('#quizform').classList.add('d-none');
        document.querySelector('#thankyou').classList.remove('d-none');
        document.querySelector('#myFormquiz').reset();

        document.querySelector('#thankyou').classList.add('block');
        setTimeout(function () {
          window.location.reload();
        }, 3000);
        document.getElementById('enqform-overlay').style.display = 'none';
      } else {
        const errorMsg = document.getElementById('sheshulsror-msg');
        errorMsg.style.display = 'block';
        errorMsg.innerHTML = data.response;
        setTimeout(() => {
          errorMsg.style.display = 'none';
        }, 15000);
      }
    });
}

document.querySelector('.Click-here').addEventListener('click', function () {
  document.querySelector('.custom-model-main').classList.add('model-open');
  //form
  // document.querySelector('#quizform').classList.add('d-none');
  // document.querySelector('#quizform').style.display = 'block';
  document.querySelector('#thankyou').classList.add('d-none');
});

document
  .querySelectorAll('.close-btn, .bg-overlay')
  .forEach(function (element) {
    element.addEventListener('click', function () {
      document
        .querySelector('.custom-model-main')
        .classList.remove('model-open');
    });
  });
