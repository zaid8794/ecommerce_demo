<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="index.php">E-commerce</a>
        <button class="navbar-toggler d-lg-none shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php" aria-current="page">Home
                        <span class="visually-hidden">(current)</span>
                    </a>
                </li>
                <?php
                if (isset($_SESSION['user'])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="add_product.php">Add Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_category.php">Add Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_sub_category.php">Add Sub Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="change_password.php">Change Password</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                <?php
                }
                ?>
            </ul>
            <form class="d-flex my-2 my-lg-0">
                <input class="form-control me-sm-2 shadow-none" type="text" placeholder="Search" />
                <button class="btn btn-outline-success my-2 my-sm-0 shadow-none" type="submit">
                    Search
                </button>
            </form>
        </div>
    </div>
</nav>