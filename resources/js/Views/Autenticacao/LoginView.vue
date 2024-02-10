<script>
import useVuelidate from "@vuelidate/core";

import LoadingComponent from "@/components/Uteis/LoadingComponent.vue";
import NavbarComponent from "@/components/Navbar/NavbarComponent.vue";
import NotificacaoComponent from "@/components/Uteis/NotificacaoComponent.vue";
import {email, helpers, maxLength, required} from "@vuelidate/validators";
import {router} from "@inertiajs/vue3";

export default {
  setup() {
    return {
      v$: useVuelidate()
    }
  },

  components: {
    LoadingComponent,
    NavbarComponent,
    NotificacaoComponent
  },

  props: {
    links: {
      type: Object,
      required: true
    }
  },

  data() {
    return {
      loading: false,
      login: {
        email: '',
        password: '',
        manterLogado: false
      }
    }
  },
  methods: {
    async logar() {
      if (await this.v$.login.$validate()) {
        router.post('/login/usuario', this.login)
      }
    }
  },
  validations() {
    return {
      login: {
        email: {
          required: helpers.withMessage('O campo de email é obrigatório.', required),
          maxLength: helpers.withMessage('O email deve conter até 255 caracteres.', maxLength(255)),
          email: helpers.withMessage('O email é inválido.', email)
        },
        password: {
          required: helpers.withMessage('O campo de senha é obrigatório.', required),
          maxLength: helpers.withMessage('A senha deve conter até 255 caracteres.', maxLength(255))
        }
      }
    }
  }
}
</script>

<template>
  <NavbarComponent :links="links"/>
  <main>
    <LoadingComponent :loading="loading"/>
    <NotificacaoComponent
        :notificacao="this.$page.props.flash.backendFlashMessage"
        v-if="this.$page.props.flash.backendFlashMessage"
    />
    <div class="container-login">
      <form @submit.prevent="logar" class="form-login">
        <h1 class="text-center titulo">Entre no sistema</h1>
        <v-row>
          <v-col cols="12">
            <v-text-field
                type="email"
                v-model="login.email"
                :error-messages="v$.login.email.$errors.map((e) => e.$message)"
                counter="255"
                label="Insira seu email"
                @input="v$.login.email.$touch"
                @blur="v$.login.email.$touch"
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <v-text-field
                type="password"
                v-model="login.password"
                :error-messages="v$.login.password.$errors.map((e) => e.$message)"
                counter="255"
                label="Insira sua password"
                @input="v$.login.password.$touch"
                @blur="v$.login.password.$touch"
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="6">
            <label for="manter-logado">
              <input
                  type="checkbox"
                  name="manter-logado"
                  id="manter-logado"
                  v-model="login.manterLogado"
              />
              <span> Manter conectado?</span>
            </label>
          </v-col>
          <v-col cols="6">
            <v-btn block size="large" type="submit">Cadastro</v-btn>
          </v-col>
        </v-row>
      </form>
    </div>
  </main>
</template>

<style scoped>
main {
  height: 80vh;
}

.container-login {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
}

.form-login {
  width: 30%;
  background-color: var(--platinum);
  padding: 2rem;
  border-radius: 10px;
}

.titulo {
  font-family: 'Poppins', sans-serif;
  padding-bottom: 1.5rem;
}
</style>
