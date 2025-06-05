
$(function () {
  const form = $('#detailsForm'), step1 = $('.step_1'), step2 = $('.step_2'),
        nextBtn = $('#nextbtn'), errorBox1 = $('#errorMessage1'), errorBox2 = $('#errorMessage'),
        password = $('#password'), confirmPassword = $('#confirm_password'), passwordError = $('#password_error');

  // ✅ Global tag arrays
 let professionTags = [],
  skillsTags = [],
  interestsTags = [];

  confirmPassword.on('input', () => passwordError.toggleClass('hidden', password.val() === confirmPassword.val()));

  nextBtn.on('click', e => {
    e.preventDefault();
    const name = form.find('[name="name"]').val().trim(),
          email = form.find('[name="email"]').val().trim(),
          pwd = password.val(), confirmPwd = confirmPassword.val(),
          agreed = $('#termsCheckbox').is(':checked');

    if (!name) return showError(errorBox1, 'Full name is required.');
    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) return showError(errorBox1, 'A valid email is required.');
    if (pwd.length < 6) return showError(errorBox1, 'Password must be at least 6 characters.');
    if (pwd !== confirmPwd) return showError(errorBox1, 'Passwords do not match.');
    if (!agreed) return showError(errorBox1, 'You must agree to the Terms of Service.');

    errorBox1.addClass('hidden');
    step1.addClass('hidden');
    step2.removeClass('hidden');
  });

  $('#prevbtn').on('click', () => {
    step2.addClass('hidden');
    step1.removeClass('hidden');
  });

  form.on('submit', e => {
    if (!professionTags.length) return stopSubmit(e, 'Please enter at least one profession.');
    if (!skillsTags.length) return stopSubmit(e, 'Please enter at least one skill.');
    if (!interestsTags.length) return stopSubmit(e, 'Please enter at least one interest.');
    if (!$('[name="availability"]').val()) return stopSubmit(e, 'Please select your availability.');
    errorBox2.addClass('hidden');
  });

  function stopSubmit(e, msg) {
    e.preventDefault();
    showError(errorBox2, msg);
  }

  function setupTagInput(inputId, addBtnId, containerId, hiddenId, tagArray, color, name) {
    const input = $(inputId), addBtn = $(addBtnId), tagsBox = $(containerId), hiddenBox = $(hiddenId);

    input.on('keypress', e => {
      if (e.which === 13 || e.which === 44) {
        e.preventDefault();
        addTag();
      }
    });

    addBtn.on('click', addTag);

    function addTag() {
      const val = input.val().trim();
      if (val && !tagArray.includes(val)) {
        tagArray.push(val);
        updateTags();
        input.val('');
      }
    }

    function updateTags() {
      tagsBox.empty(); hiddenBox.empty();
      tagArray.forEach((tag, i) => {
        tagsBox.append(`
          <span class="tag inline-flex items-center px-2 py-1 mr-1 mb-1 text-xs font-medium rounded bg-${color}-100 text-${color}-800">
            ${tag}
            <button type="button" class="ml-1 text-${color}-500 hover:text-${color}-700 remove-tag" data-index="${i}" data-type="${name}">
              <i class="fas fa-times"></i>
            </button>
          </span>`);
        hiddenBox.append(`<input type="hidden" name="${name}[]" value="${tag}">`);
      });
    }

    return { updateTags };
  }

  // ✅ Store handlers globally so suggestion click can call `prof.updateTags()`
  let prof = setupTagInput('#professionInput', '#addProfession', '#professionTags', '#professionHiddenInputs', professionTags, 'blue', 'profession');
  let skills = setupTagInput('#skillsInput', '#addSkill', '#skillsTags', '#skillsHiddenInputs', skillsTags, 'indigo', 'skills');
  let interests = setupTagInput('#interestsInput', '#addInterest', '#interestsTags', '#interestsHiddenInputs', interestsTags, 'purple', 'interests');

  $(document).on('click', '.remove-tag', function () {
    const index = $(this).data('index'), type = $(this).data('type');
    if (type === 'profession') { professionTags.splice(index, 1); prof.updateTags(); }
    else if (type === 'skills') { skillsTags.splice(index, 1); skills.updateTags(); }
    else if (type === 'interests') { interestsTags.splice(index, 1); interests.updateTags(); }
  });

  function showError(box, msg) {
    box.text(msg).removeClass('hidden');
  }

    /// handles profession suggession
  $('#professionInput').on('input', () => {
    const query = $('#professionInput').val().trim();
    const list = $('#profession_suggession');
    list.empty();
    if (query.length === 0) return;

    fetch(`/profession/search?q=${query}`)
      .then(res =>  res.json())
      .then(data => {
        if (data.length === 0) {list.append('<li class="p-2 text-gray-500">No matches found</li>'); return;}
        data.forEach(profession => {
          list.append(`<li class="p-2 hover:bg-gray-100 cursor-pointer" data-profession="${profession}">${profession}</li>`);
        });
      })
      .catch(err => console.error('Fetch error:', err));
  });
  
  $(document).on('click', '#profession_suggession li', function () {
    const selected = $(this).data('profession');
    if (selected && !professionTags.includes(selected)) {
      professionTags.push(selected);
      prof.updateTags();
    }
    $('#professionInput').val('');
    $('#profession_suggession').empty();
  });

});
