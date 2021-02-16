$(function() {
  'use strict';

    const likeIcons = document.querySelectorAll('.like-icon');
    likeIcons.forEach((likeIcon) => likeIcon.addEventListener('click', (e) => {
      e.preventDefault();
      const likeId = likeIcon.getAttribute('id');
      const likeForm = document.getElementById(`like-${likeId}`)
      likeForm.submit();
    }))
})