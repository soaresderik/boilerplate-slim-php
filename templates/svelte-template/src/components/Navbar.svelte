<script>
  import { link, push } from "svelte-spa-router";
  import { wrap } from "svelte-spa-router";
  let active = null;

  function handleBurguer(e) {
    active = !active ? "is-active" : null;
  }

  function logout() {
    delete localStorage.token;
    push("/login");
  }
</script>

<nav class="navbar is-info">
  <div class="navbar-brand">
    <a use:link class="navbar-item" href="/">

      <img
        src="https://bulma.io/images/bulma-logo-white.png"
        alt="Bulma: a modern CSS framework based on Flexbox"
        width="112"
        height="28" />

    </a>
    <div class="navbar-burger burger" on:click={handleBurguer}>
      <span />
      <span />
      <span />
    </div>
  </div>

  <div class="navbar-menu {active}">
    <div class="navbar-end">
      <a use:link class="navbar-item" href="/">Home</a>
      <div class="navbar-item has-dropdown is-hoverable">
        <a
          class="navbar-link"
          href="https://bulma.io/documentation/overview/start/">
          Conta
        </a>
        <div class="navbar-dropdown">
          <a use:link class="navbar-item" href="/login">Perfil</a>
          <span class="navbar-item" on:click={logout}>Sair</span>
        </div>
      </div>
    </div>
  </div>
</nav>
