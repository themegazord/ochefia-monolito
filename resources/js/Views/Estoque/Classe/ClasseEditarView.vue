<script>
import NavbarSistemaComponent from "@/components/Navbar/NavbarSistemaComponent.vue";
import LoadingComponent from "@/components/Uteis/LoadingComponent.vue";
import NotificacaoComponent from "@/components/Uteis/NotificacaoComponent.vue";
import useVuelidate from "@vuelidate/core";
import {helpers, maxLength, required, url} from '@vuelidate/validators'
import {router} from "@inertiajs/vue3";

export default {
  components: {
    NavbarSistemaComponent,
    LoadingComponent,
    NotificacaoComponent
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
    classeBanco: {
      type: Object,
      required: true
    }
  },
  mounted() {
    this.classe = Object.assign({}, this.classeBanco)
  },
  data() {
    return {
      loading: false,
      classe: {
        classe_produto_nome: ''
      }
    }
  },
  methods: {
    voltar() {
      return window.history.back();
    },
    async editar() {
      if (await this.v$.classe.$validate()) {
        this.loading = true
        router.put(`/${this.$page.url.substring(1, 15)}/estoque/classe/editar/${this.classe.classe_produto_id}`, this.classe);
        this.loading = false
      }
    },

  },
  setup() {
    return {
      v$: useVuelidate()
    }
  },
  validations() {
    return {
      classe: {
        classe_produto_nome: {
          required: helpers.withMessage('Esse campo é obrigatório, por favor, informe-o.', required),
          maxLength: helpers.withMessage('Esse campo tem que conter no máximo 50 caracteres.', maxLength(50))
        }
      }
    }
  }
}
</script>

<template>
  <v-layout>
    <NavbarSistemaComponent :menus="menus" :subMenus="subMenus"/>
    <LoadingComponent :loading="loading"/>
    <NotificacaoComponent
        :notificacao="this.$page.props.flash.backendFlashMessage"
        v-if="this.$page.props.flash.backendFlashMessage"
    />
    <v-main>
      <div class="container-cadastro-classe">
        <h2>Aqui você poderá editar novas classes de produtos!</h2>
        <form class="form-cadastro-classe" @submit.prevent="editar">
          <v-row>
            <v-col cols="6">
              <v-text-field
                  type="text"
                  v-model="classe.classe_produto_nome"
                  :error-messages="v$.classe.classe_produto_nome.$errors.map((e) => e.$message)"
                  counter="30"
                  label="Insira o nome da classe"
                  @input="v$.classe.classe_produto_nome.$touch"
                  @blur="v$.classe.classe_produto_nome.$touch"
              ></v-text-field
              >
            </v-col>
            <v-col cols="6"></v-col>
          </v-row>
          <v-row>
            <v-col cols="12" class="botoes">
              <v-btn variant="tonal" @click="voltar" color="var(--vermilion)"
              >Voltar
              </v-btn
              >
              <v-btn variant="tonal" type="submit" color="var(--green-confirm)"
              >Salvar
              </v-btn
              >
            </v-col>
          </v-row>
        </form>
      </div>
    </v-main>
  </v-layout>
</template>

<style scoped>
.container-cadastro-classe {
  padding: 4rem;
  font-family: 'Poppins', sans-serif;
  width: 90%;
}

.form-cadastro-classe {
  padding: 3rem;
}

.botoes {
  display: flex;
  gap: 1rem;
  justify-content: end;
}
</style>