import './style.css';

// Логіка вибору реєстрації чи авторизації

document.addEventListener("DOMContentLoaded", function() {
  const registrationBtn = document.getElementById('registrationBtn');
  const loginBtn = document.getElementById('loginBtn');
  const registrationForm = document.getElementById('registrationForm');
  const loginForm = document.getElementById('loginForm');

  if (registrationBtn && loginBtn && registrationForm && loginForm) {
    registrationBtn.addEventListener('click', () => {
      showForm(registrationForm);
    });

    loginBtn.addEventListener('click', () => {
      showForm(loginForm);
    });
  }

  if (document.getElementById('myTweetList')) {
    loadMyTweets();
  }

  if (document.getElementById('allTweetList')) {
    loadAllTweets();
  }
});

function showForm(formToShow) {
  if (registrationForm && loginForm) {
    registrationForm.style.display = 'none';
    loginForm.style.display = 'none';
    formToShow.style.display = 'flex';
  }
}


// Запит для отримання твітів користувача

function loadMyTweets() {
  const myTweetList = document.getElementById('myTweetList');

  fetch('/backend/showMyTweets.php')
      .then(response => response.json())
      .then(data => {
          data.forEach(tweet => {
            const tweetDiv = document.createElement('div');
            tweetDiv.classList.add('tweet');
  
            const tweetContent = document.createElement('span');
            tweetContent.classList.add('tweetContent');
            tweetContent.textContent = tweet.content;
  
            const editButton = document.createElement('button');
            editButton.classList.add('editButton');
            editButton.textContent = 'Edit';
  
            editButton.addEventListener('click', () => {
              const newContent = prompt('Enter the new content:', tweet.content);
              const tweetId = tweet.id;

              if (newContent !== null && newContent.trim() !== '') {
                fetch('/backend/editTweet.php', {
                  method: 'POST',
                  headers: {
                    'Content-Type': 'application/json',
                  },
                  body: JSON.stringify({
                    tweetId: tweetId,
                    newContent: newContent,
                  }),
                })
                .then(response => response.json())
                .then(data => {
                  console.log(data);
                  tweetContent.textContent = newContent;
                })
                .catch(error => console.error('Помилка:', error));
              }
            });
            tweetDiv.appendChild(tweetContent);
            tweetDiv.appendChild(editButton);
            myTweetList.appendChild(tweetDiv);
          });
      })
      .catch(error => console.error('Помилка:', error));
}


// Запит для отримання всіх твітів
function loadAllTweets() {
  const allTweetList = document.getElementById('allTweetList');

  fetch('/backend/showAllTweets.php')
      .then(response => response.json())
      .then(data => {
          data.forEach(tweet => {
            const tweetDiv = document.createElement('div');
            tweetDiv.classList.add('tweet');
  
            const tweetContent = document.createElement('span');
            tweetContent.classList.add('tweetContent');
            tweetContent.textContent = tweet.content;
  
            tweetDiv.appendChild(tweetContent);
            allTweetList.appendChild(tweetDiv);
          });
      })
      .catch(error => console.error('Помилка:', error));
}
