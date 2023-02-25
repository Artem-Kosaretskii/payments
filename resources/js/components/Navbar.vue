<template>
<!--<nav class="navbar navbar-expand-sm navbar-dark bg-info mb-2">-->
<!--  <div class="container">-->
<!--    <a href="#" class="navbar-brand">-->
<!--      <router-link to="/payments">Payments</router-link>-->
<!--    </a>-->
<!--    <a href="#" class="navbar-brand">-->
<!--      <router-link to="/users">Users</router-link>-->
<!--    </a>-->
<!--    <a href="#" class="navbar-brand">-->
<!--      <router-link to="/products">Products</router-link>-->
<!--    </a>-->

<!--  </div>-->
<!--</nav>-->

  <nav class="navbar navbar-expand-lg navbar-dark bg-info mb-2">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <router-link class="nav-link active" to="/">Home</router-link>
          </li>
<!--          <li class="nav-item">-->
<!--            <a class="nav-link" href="#">Link</a>-->
<!--          </li>-->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Menu
            </a>
            <ul class="dropdown-menu">
              <li><router-link class="dropdown-item" to="/payments">Payments</router-link></li>
              <li><router-link class="dropdown-item" to="/users">Users</router-link></li>
            </ul>
          </li>
        </ul>
<!--        <form class="d-flex" role="search">-->
<!--          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">-->
<!--          <button class="btn btn-outline-success" type="submit">Search</button>-->
<!--        </form>-->
      </div>
    </div>
  </nav>

</template>