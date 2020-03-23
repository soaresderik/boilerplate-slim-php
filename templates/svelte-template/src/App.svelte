<script>
  import Router from "svelte-spa-router";
  import { wrap, push } from "svelte-spa-router";

  import Navbar from "./components/Navbar.svelte";
  import Home from "./pages/Home.svelte";
  import Login from "./pages/Login.svelte";
  import Register from "./pages/Register.svelte";

  function checkAuth() {
    const token = localStorage.getItem("token");

    if (token) return true;

    return push("/login");
  }

  const publicRoutes = {
    "/login": Login,
    "/register": Register,
    "*": Login
  };

  const authRoutes = {
    "/": wrap(Home, details => checkAuth())
  };

  let loggedIn = false;

  const routes = !loggedIn ? publicRoutes : authRoutes;
</script>

<svelte:head>
  <style>
    * {
      box-sizing: border-box;
      padding: 0;
      margin: 0;
    }

    #main {
      max-width: 1000px;
      margin: 0 auto;
      padding: 0 15px;
      height: 100vh;
    }
  </style>
</svelte:head>

{#if !loggedIn}
  <Router {routes} />
{:else}
  <div class="bd-content is-fluid is-paddingless" id="main">
    <Navbar />
    <Router {routes} />
  </div>
{/if}
