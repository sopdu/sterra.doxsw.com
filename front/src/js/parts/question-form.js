(() => {
  // PARTS.QUESTION_FORM
  const $questionModal = document.getElementById('question');
  if (!$questionModal) return;

  const modal = components.modal($questionModal);
  const triggers = document.querySelectorAll('[data-ask-question]');
  triggers.forEach((el) => {
    el.addEventListener('click', () => modal.show());
  });

  const questionForm = document.getElementById('ask-question-form');


  if (questionForm) {
    let $submit = questionForm.querySelector('[type="submit"]');

    let validator = utils.validator(
      questionForm,
      {
        name: {
          required: {
            message: 'Обязательное поле'
          }
        },
        company: {
          required: {
            message: 'Обязательное поле'
          }
        },
        email: {
          required: {
            message: 'Обязательное поле'
          },
          email: {
            message: 'Некорректный формат'
          }
        },
        phone: {
          mask: {
            re: /^\+7 \(\d{3}\) \d{3}\-\d{2}\-\d{2}$/,
            message: 'Некорректный формат'
          }
        },
        agreement: {
          required: {
            message: 'Согласие на обработку своих персональных данных обязательно для обратной связи'
          }
        }
      },
      {
        parent: '.form-field',
        submit: () => {
          questionForm.classList.add('pending');
          if ($submit) $submit.disabled = true;
          utils.submitForm(questionForm, (response) => {
            if ($submit) $submit.disabled = false;
            questionForm.classList.remove('pending');
            if (response.success) {
              if (parts.successModal) {
                parts.successModal.show();
              }
            } else {
              console.error(response);
            }
          });
        }
      }
    );
  }

  window.parts = window.parts || {};
  window.parts.questionModal = modal;
})();
