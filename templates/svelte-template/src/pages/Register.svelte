<style>
  h2 {
    color: #363636 !important;
  }

  #register {
    padding-top: 30px;
    text-align: center !important;
  }
</style>

<section class="hero is-fullheight is-medium is-info is-bold">
  <div class="hero-body">
    <div class="container">
      <div class="columns is-centered">
        <article class="card is-rounded">
          <div class="card-content">
            <h2 class="title is-dark">Crie uma conta!</h2>
            <div class="field">
              <p class="control">
                <input class="input" type="text" placeholder="Nome" required />
              </p>
            </div>
            <div class="field">
              <p class="control">
                <input
                  class="input"
                  type="email"
                  placeholder="Email"
                  required />
              </p>
            </div>
            <div class="field">
              <p class="control">
                <input
                  class="input"
                  type="password"
                  placeholder="Senha"
                  required />
              </p>
            </div>
            <p class="control">
              <button class="button is-info is-medium is-fullwidth">
                Login
              </button>
            </p>
            <p class="control is-centered" id="register">
              <a href="#/login">Entre em sua conta</a>
            </p>
          </div>
        </article>
      </div>
    </div>
  </div>
</section>
