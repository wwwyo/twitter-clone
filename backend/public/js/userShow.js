$(function() {
  'use strict';

  const logout = document.getElementById('logout');

  logout.addEventListener('click', (e) => {
    e.preventDefault();
    const logoutForm = document.getElementById('logout-form');
    logoutForm.submit();
  });
})