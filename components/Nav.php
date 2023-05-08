<nav class="navbar is-primary" style="position: sticky;" role="navigation" aria-label="main navigation">
  <div class="container">
    <div class="navbar-brand">
      <a class="navbar-item" href="/">
        <img height="200px" src="/assets/images/zoo-1.png" alt="logo">
      </a>
      <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>
    <div class="navbar-menu" id="navbarBasicExample">
      <div class="navbar-start">
        <a href="/" class="navbar-item is-tab <?php echo $uri === '/' ? "is-active" : '' ?> ">Home</a>
        <a href="/tentang" class="navbar-item is-tab <?php echo $uri === '/tentang' || $uri === '/tentang/' ? "is-active" : '' ?> ">Tentang</a>
        <div class="navbar-item has-dropdown  is-hoverable">
          <a class="navbar-link is-tab <?= str_contains($uri, 'hewan') ? "is-active" : '' ?>">Hewan</a>
          <div class="navbar-dropdown" style="width: max-content;">
            <a href="/hewan" class="navbar-item ">
              <span class="icon-text">
                <span class="icon">
                  <i class="fa-solid fa-otter"></i>
                </span>
                <span>Daftar Hewan</span>
              </span>
            </a>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'user') : ?>
              <a href="/hewan?filter=fav" class="navbar-item ">
                <span class="icon-text">
                  <span class="icon">
                    <i class="fa-solid fa-heart"></i>
                  </span>
                  <span>Hewan Favorit</span>
                </span>
              </a>
            <?php endif ?>
            <?php if (isset($_SESSION['role']) &&  ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'owner')) : ?>
              <a href="/hewan/tambah" class="navbar-item">
                <span class="icon-text">
                  <span class="icon">
                    <i class="fa-solid fa-plus"></i>
                  </span>
                  <span>Tambah Hewan</span>
                </span>
              </a>
            <?php endif ?>
          </div>
        </div>
        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link is-tab <?= str_contains($uri, 'tiket') ? "is-active" : '' ?>">Tiket</a>
          <div class="navbar-dropdown" style="width: max-content;">
            <a href="/tiket" class="navbar-item">
              <span class="icon-text">
                <span class="icon">
                  <i class="fa-solid fa-ticket"></i>
                </span>
                <span>List Tiket</span>
              </span>
            </a>
            <?php if (isset($_SESSION['role']) &&  ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'owner')) : ?>
              <a href="/tiket/tambah" class="navbar-item">
                <span class="icon-text">
                  <span class="icon">
                    <i class="fa-solid fa-plus"></i>
                  </span>
                  <span>Tambah Tiket</span>
                </span>
              </a>
            <?php endif ?>
          </div>
        </div>
        <?php if (isset($_SESSION['id'])) : ?>
          <a href="/pesanan" class="navbar-item is-tab <?= strpos($uri, 'pesanan') ? "is-active" : '' ?> ">Pesanan</a>
        <?php endif ?>
        <?php if (isset($_SESSION['role'])) : ?>
          <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link is-tab <?= str_contains($uri, 'profil') ? "is-active" : '' ?>"><?= $_SESSION['name'] ?></a>
            <div class="navbar-dropdown" style="width: max-content;">
              <a href="/profil" class="navbar-item">
                <span class="icon-text">
                  <span class="icon">
                    <i class="fa-solid fa-user"></i>
                  </span>
                  <span>Profile</span>
                </span>
              </a>
              
            </div>
          </div>
        <?php endif ?>

      </div>
      <div class="navbar-end">
        <div class="navbar-item">
          <?php if (isset($_SESSION['name'])) : ?>
            <form action="" class="buttons" method="POST">
              <button name="logout" type="submit" class="button is-danger">Log out</button>
            </form>
          <?php else : ?>
            <a href="/auth" class="button is-light">Log In</a>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
</nav>