// js/scripts.js
document.addEventListener('DOMContentLoaded', function(){
  // simple client-side validation for register form
  const registerForm = document.getElementById('registerForm');
  if(registerForm){
    registerForm.addEventListener('submit', function(e){
      const pass = registerForm.querySelector('input[name="password"]').value;
      if(pass.length < 6){
        e.preventDefault();
        alert('Password must be at least 6 characters.');
      }
    });
  }
});
