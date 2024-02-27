<script>
import {router} from "@inertiajs/vue3";
import {useVuelidate} from "@vuelidate/core";
import {helpers, maxLength, required} from "@vuelidate/validators";
import LoadingComponent from "@/components/Uteis/LoadingComponent.vue";
import NotificacaoComponent from "@/components/Uteis/NotificacaoComponent.vue";
import NavbarSistemaComponent from "@/components/Navbar/NavbarSistemaComponent.vue";

export default {
  components: {
    LoadingComponent,
    NotificacaoComponent,
    NavbarSistemaComponent
  },
  methods: {
    async editar() {
      this.loading = true
      if (await this.v$.subgrupo.$validate()) {
        router.put(`/${this.$page.url.substring(1, 15)}/estoque/subgrupo/editar/${this.subgrupo.subgrupo_produto_id}`, this.subgrupo)
      }
      this.loading = false
    }
  },
  data() {
    return {
      loading: false,
      subgrupo: {
        subgrupo_produto_nome: ''
      }
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
    subgrupoBanco: {
      type: Object,
      required: true
    }
  },
  mounted() {
    this.subgrupo = {...this.subgrupoBanco}
  },
  setup() {
    return {
      v$: useVuelidate()
    }
  },
  validations() {
    return {
      subgrupo: {
        subgrupo_produto_nome: {
          required: helpers.withMessage(
              'Esse campo é obrigatório, por favor, informe-o.',
              required
          ),
          maxLength: helpers.withMessage(
              'Esse campo tem que conter no máximo 30 caracteres.',
              maxLength(30)
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
      <div class="container-cadastro-subgrupo">
        <h2>Aqui você poderá editar seus sub grupos de produtos!</h2>
        <form class="form-cadastro-subgrupo" @submit.prevent="editar">
          <v-row>
            <v-col cols="6">
              <v-text-field
                  type="text"
                  v-model="subgrupo.subgrupo_produto_nome"
                  :error-messages="v$.subgrupo.subgrupo_produto_nome.$errors.map((e) => e.$message)"
                  counter="30"
                  label="Insira o nome do subgrupo"
                  @input="v$.subgrupo.subgrupo_produto_nome.$touch"
                  @blur="v$.subgrupo.subgrupo_produto_nome.$touch"
              ></v-text-field
              ></v-col>
            <v-col cols="6"></v-col>
          </v-row>
          <v-row>
            <v-col cols="12" class="botoes">
              <v-btn
                  variant="tonal"
                  @click="$router.go(-1)"
                  color="var(--vermilion)"
              >Voltar</v-btn
              >
              <v-btn
                  variant="tonal"
                  type="submit"
                  color="var(--green-confirm)"
              >Salvar</v-btn
              >
            </v-col>
          </v-row>
        </form>
      </div>
    </v-main>
  </v-layout>
</template>

<style scoped>
.container-cadastro-subgrupo {
  padding: 4rem;
  font-family: 'Poppins', sans-serif;
  width: 90%;
}

.form-cadastro-subgrupo {
  padding: 3rem;
}

.botoes {
  display: flex;
  gap: 1rem;
  justify-content: end;
}
</style>