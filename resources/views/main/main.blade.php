<!doctype html>
<html data-theme="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <link rel="stylesheet" href="./dist/css/app.css"/>
  </head>
  <body>
    <header>
      <nav>
        <nav class="navbar bg-light">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">
              <img src="/images/logo.png" alt="Logo" width="35" height="35" class="d-inline-block align-text-top">
              <strong>TODO</strong>
            </a>
          </div>
        </nav>
      </nav>
    </header>
    <div id="app"></div>
    <main class="mx-5">
        <div aria-live="polite" aria-atomic="true" class="position-relative">
          <div class="toast-container top-0 end-0 p-3">
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
              <div class="toast-header">
              <img src="images/check.png" class="rounded me-2" height="20px" width="20px" alt="checked">
              <strong class="me-auto">Bootstrap</strong>
              <small class="text-muted">just now</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
              <div class="toast-body">
                  <span class="message">See? Just like this.</span>
              </div>
            </div>
          </div>
        </div>
        @yield("content")
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"></script>
    <script src="js/todo.js"></script>
  </body>
</html>