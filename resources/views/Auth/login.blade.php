<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{url ('assets/css/syncoauthentication.css')}}" />
    <title>Welcome | Sync-o</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="{{url('login')}}" class="sign-in-form" method="POST">
          {{csrf_field()}}
          @include ('message')
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="text" placeholder="Email" name="email" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" required/>
            </div>
            <div class="remember-forgot">
              <label>
                <input type="checkbox" name="remember" />
                Remember me
              </label>
              <a href="{{url('forgot-password')}}">Forgot password?</a>
            </div>
            <input type="submit" value="Login" class="btn solid" />
          </form>
        </div>
      </div>
      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
          <img src="uploads\project/image.png" alt="Your Logo" class="logo" />
            <h3>New here ?</h3>
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
              ex ratione. Aliquid!
            </p>
            <a href="{{url('registration')}}">
              <button class="btn transparent" id="sign-up-btn">
                Sign up
              </button>
            </a>
          </div>
          <img src="#" class="image" alt="" />
        </div>
      </div>
    </div>
  </body>
</html>
