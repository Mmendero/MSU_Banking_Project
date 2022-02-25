<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
      integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../styles/styles.css" />

    <!-- FontAwesome Icons -->
    <script
      src="https://kit.fontawesome.com/2727c3ff62.js"
      crossorigin="anonymous"
    ></script>

    <title>Admin Front Page</title>
  </head>

  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="user_homepage.html#">Admin Front Page</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="user_search.html#">Search User</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="withdraw.php#">View Transaction Histories</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="manage_users.php#">Manage Users</a>
          </li>
        </ul>

        
      </div>
      <form class="logout-form" action="" method="POST">
        <button name="logout" class="btn btn-info form-inline my-2 my-lg-0">
          Logout
        </button>
      </form>
    </nav>

    <h1>Admin Frontpage</h1>


    <p>Here We can probably put some buttons to do certain admin things</p>
  </body>
</html>
