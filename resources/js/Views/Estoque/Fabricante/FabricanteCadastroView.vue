<script>
import NavbarSistemaComponent from "@/components/Navbar/NavbarSistemaComponent.vue";
import NotificacaoComponent from "@/components/Uteis/NotificacaoComponent.vue";
import LoadingComponent from "@/components/Uteis/LoadingComponent.vue";
import {helpers, maxLength, required} from "@vuelidate/validators";
import {useVuelidate} from "@vuelidate/core";
import {router} from "@inertiajs/vue3";

export default {
  setup() {
    return {
      v$: useVuelidate()
    }
  },
  props: {
    menus: {
      type: Array,
      required: true
    },
    subMenus: {
      type: Array,
      required: true
    },
  },
  components: {
    NavbarSistemaComponent,
    NotificacaoComponent,
    LoadingComponent
  },
  data() {
    return {
      loading: false,
      fabricante: {
        fabricante_produto_nome: ''
      }
    }
  },
  methods: {
    voltar() {
      return window.history.back();
    },
    async cadastrar() {
      if (await this.v$.fabricante.$validate()) {
        this.loading = true
        router.post('cadastrar', this.fabricante)
        this.loading = false
      }
    }
  },
  validations() {
    return {
      fabricante: {
        fabricante_produto_nome: {
          required: helpers.withMessage(
              'Esse campo é obrigatório, por favor, informe-o.',
              required
          ),
          maxLength: helpers.withMessage(
              'Esse campo tem que conter no máximo 90 caracteres.',
              maxLength(90)
          )
        }
      }
    }
  }
}
</script>

<template>
  <v-layout>
    <NavbarSistemaComponent :menus="menus" :subMenus="subMenus" />
    <NotificacaoComponent
        :notificacao="this.$page.props.flash.backendFlashMessage"
        v-if="this.$page.props.flash.backendFlashMessage"
    />
    <LoadingComponent :loading="loading" />
    <v-main>
      <div class="container-cadastro-fabricante">
        <h2>Aqui você poderá cadastrar novos fabricantes de produtos!</h2>
        <form class="form-cadastro-fabricante" @submit.prevent="cadastrar">
          <v-row>
            <v-col cols="6">
              <v-text-field
                  type="text"
                  v-model="fabricante.fabricante_produto_nome"
                  :error-messages="
                  v$.fabricante.fabricante_produto_nome.$errors.map((e) => e.$message)
                "
                  counter="90"
                  label="Insira o nome do fabricante"
                  @input="v$.fabricante.fabricante_produto_nome.$touch"
                  @blur="v$.fabricante.fabricante_produto_nome.$touch"
              ></v-text-field
              ></v-col>
            <v-col cols="6"></v-col>
          </v-row>
          <v-row>
            <v-col cols="12" class="botoes">
              <v-btn variant="tonal" @click="voltar" color="var(--vermilion)">Voltar</v-btn>
              <v-btn variant="tonal" type="submit" color="var(--green-confirm)">Salvar</v-btn>
            </v-col>
          </v-row>
        </form>
      </div>
    </v-main>
  </v-layout>
</template>
<style scoped>
.container-cadastro-fabricante {
  padding: 4rem;
  font-family: 'Poppins', sans-serif;
  width: 90%;
}

.form-cadastro-fabricante {
  padding: 3rem;
}

.botoes {
  display: flex;
  gap: 1rem;
  justify-content: end;
}
</style>