<x-guest-layout>

<div class="wrapper" id="formWrapper">

  <!-- Login Form -->
  <div class="form-container login">
    <h2>Login</h2>

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <input type="email" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="Password" required />

      <div class="forgot-password" tabindex="0">Forgot password?</div>

      <button type="submit" class="submit-btn">Login</button>

      <!-- <div class="social-login">
        
      </div> -->
    </form>
  </div>

  <!-- Signup Form -->
  <div class="form-container signin">
    <h2>Sign Up</h2>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <input type="text" name="name" placeholder="Username" required />
      <input type="email" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="Password" required />
      <input type="password" name="password_confirmation" placeholder="Confirmed Password" required />

      <label class="accept-terms">
        <input type="checkbox" required /> I accept the terms & conditions
      </label>

      <button type="submit" class="submit-btn">Sign Up</button>

      <!-- <div class="social-login">
        
      </div> -->
    </form>
  </div>

  
  <div class="toggle-container">
    <h2 id="toggleHeading">Don't have an account?</h2>
    <p id="toggleText">Sign up to get started!</p>
    <button class="switch-btn" id="toggleBtn" type="button">Sign Up</button>
  </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const wrapper = document.getElementById('formWrapper');
  const toggleBtn = document.getElementById('toggleBtn');
  const toggleHeading = document.getElementById('toggleHeading');
  const toggleText = document.getElementById('toggleText');

  toggleBtn.addEventListener('click', () => {
    wrapper.classList.toggle('active');

    if(wrapper.classList.contains('active')){
      toggleHeading.textContent = "Already have an account?";
      toggleText.textContent = "Login to your account!";
      toggleBtn.textContent = "Login";
    } else {
      toggleHeading.textContent = "Don't have an account?";
      toggleText.textContent = "Sign up to get started!";
      toggleBtn.textContent = "Sign Up";
    }
  });
});
</script>

</x-guest-layout>
