document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Simulate a login check (replace with actual authentication logic)
    if (username === 'admin' && password === 'password') {
        localStorage.setItem('loggedIn', 'true');
        window.location.href = 'index.html'; // Redirect to your home page URL
    } else {
        document.getElementById('error-message').textContent = 'Invalid username or password.';
    }
});
